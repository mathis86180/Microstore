<?php

namespace MicroStore\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text',array(
                'max_length'    => 200))
            ->add('password', 'repeated', array(
                'type'              => 'password',
                'invalid_message'   => 'Les mots de passe saisis doivent être identiques',
                'error_bubbling'    => true,
                'constraints'     => array(
                    new Length(array(
                        'min' => 3,
                        'max' => 10,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le mot de passe ne peut contenir plus de {{ limit }} caractères')),
                    new Regex(array(
                        'pattern' => '/\d/',
                        'match'   => true,
                        'message' => 'Le mot de passe doit être uniquement composé de chiffres')))))
            ->add('mail', 'email', array(
                'max_length'    => 200))
            ->add('nom', 'text', array(
                /*'constraints'    => array(
                    new Regex(array(
                        'pattern' => '/abcdefghijklmnopqrstuvwxyz-/',
                        'match'   => true,
                        'message' => 'Le format du nom fourni est incorrect'))
                )*/
            ))
            ->add('prenom', 'text')
            ->add('adresse', 'text')
            ->add('ville', 'text')
            ->add('CodePostal', 'number');

    }

    public function getName()
    {
        return 'user';
    }
}
