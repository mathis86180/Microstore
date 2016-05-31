<?php

use Symfony\Component\HttpFoundation\Request;
use MicroStore\Domain\User;
use MicroStore\Domain\Panier;
use MicroStore\Form\Type\UserType;
use MicroStore\Other\Tableau;
use MicroStore\Form\Type\ArticleType;
use MicroStore\Domain\TelephoneMobile;


// Home page
$app->get('/', function () use ($app) {
    $articles = $app['dao.telephoneMobile']->findAll();
    return $app['twig']->render('index.html.twig', array('articles' => $articles));
})->bind('home');

// Login form
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        'tableau' => Tableau::getTableau()
    ));
})->bind('login');

// Add a user
$app->match('/user/add', function(Request $request) use ($app) {
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);


    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);

        if(!$app['dao.user']->find($user->getUsername())){
            $app['dao.user']->save($user);
            $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
        }else{
            $app['session']->getFlashBag()->add('error', 'Ce nom d\'utilisateur est déjà pris.');
        }
    }else{
        $app['session']->getFlashBag()->add('errors',$userForm->getErrors());

    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Inscription',
        'userForm' => $userForm->createView(),
        'errorsee'    => $userForm->getErrors()));
})->bind('user_add');

//acc�s gestion du compte
$app->get('/gestion-du-compte', function() use ($app){
    return $app['twig']->render('gestionCompte.html.twig');
})->bind('gestion-du-compte');

//acces au panier

$app->match('/panier', function() use ($app){
   // $paniers = $app['dao.panier']->find($app["dao.user"]->find($app["session"]->getId()));
    $paniers = $app['dao.panier']->find($app["dao.pers"]->getId());
     var_dump($app['user']->getId());
    var_dump($app['user']->getUsername());
    //$prixTotal = $app['dao.commande']->calculPrixTotal($app['user']->getId());
    return $app['twig']->render('panier.html.twig',array('paniers' => $paniers));
})->bind('panier');

$app->post('/addpanier', function(Request $request) use($app){

    $panier = new Panier();
    $panier->setIdClient($request->get('idClient'));
    $panier->setPrixTTC($request->get('prixUnitairePanier'));
    $panier->setIdTelCo($request->get('idTelPanier'));

    $app['dao.panier']->savePanier($panier);
return $app->redirect('panier');
})->bind('addpanier');


// Admin home page
$app->get('/admin', function() use ($app) {
    $articles = $app['dao.telephoneMobile']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('backoffice.html.twig', array(
        'articles' => $articles,
        'users' => $users));
})->bind('admin');


// Add a new article
$app->match('/admin/telephone/add', function(Request $request) use ($app) {
    $article = new TelephoneMobile();
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.telephoneMobile']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was successfully created.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'New article',
        'articleForm' => $articleForm->createView()));
})->bind('admin_telephone_add');

// Edit an existing article
$app->match('/admin/telephone/{id}/edit', function($id, Request $request) use ($app) {
    $article = $app['dao.telephoneMobile']->find($id);
    $articleForm = $app['form.factory']->create(new ArticleType(), $article);
    $articleForm->handleRequest($request);
    if ($articleForm->isSubmitted() && $articleForm->isValid()) {
        $app['dao.telephoneMobile']->save($article);
        $app['session']->getFlashBag()->add('success', 'The article was succesfully updated.');
    }
    return $app['twig']->render('article_form.html.twig', array(
        'title' => 'Edit article',
        'articleForm' => $articleForm->createView()));
})->bind('admin_article_edit');

// Remove an article
$app->get('/admin/article/{id}/delete', function($id, Request $request) use ($app) {
    // Delete the article
    $app['dao.telephoneMobile']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The article was succesfully removed.');
    // Redirect to admin home page
    return $app->redirect($app['url_generator']->generate('admin'));
})->bind('admin_article_delete');