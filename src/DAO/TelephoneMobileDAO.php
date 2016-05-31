<?php
 namespace MicroStore\DAO;

 use MicroStore\Domain\TelephoneMobile;

 class TelephoneMobileDAO extends DAO{

     public function findAll() {
         $sql = "select * from telephoneMobile order by idTel";
         $result = $this->getDb()->fetchAll($sql);

         // Convert query result to an array of domain objects
         $articles = array();
         foreach ($result as $row) {
             $articleId = $row['idTel'];
             $articles[$articleId] = $this->buildDomainObject($row);
         }
         return $articles;
     }

     public function find($id) {
         $sql = "select * from telephoneMobile where idTel=?";
         $row = $this->getDb()->fetchAssoc($sql, array($id));

         if ($row)
             return $this->buildDomainObject($row);
         else
             throw new \Exception("No article matching id " . $id);
     }

     public function save(TelephoneMobile $article) {
         $articleData = array(
             'libelleTel' => $article->getLibelleTel(),
             'idFabricantTel' => $article->getIdFabricantTel(),
             'OS' => $article->getOS(),
             'prixUnitaire' => $article->getPrixUnitaire(),
             'stock' => $article->getStock(),
             'imageTel' => $article->getImageTel()
         );

         if ($article->getIdTel()) {
             // The article has already been saved : update it
             $this->getDb()->update('telephoneMobile', $articleData, array('idTel' => $article->getId()));
         } else {
             // The article has never been saved : insert it
             $this->getDb()->insert('idTel', $articleData);
             // Get the id of the newly created article and set it on the entity.
             $id = $this->getDb()->lastInsertId();
             $article->setIdTel($id);
         }
     }

     public function delete($id) {
         // Delete the article
         $this->getDb()->delete('idTel', array('idTel' => $id));
     }

     protected function buildDomainObject($row) {
         $article = new TelephoneMobile();
         $article->setIdTel($row['idTel']);
         $article->setIdFabricantTel($row['idFabricantTel']);
         $article->setLibelleTel($row['libelleTel']);
         $article->setOS($row['OS']);
         $article->setPrixUnitaire($row['prixUnitaire']);
         $article->setStock($row['stock']);
         $article->setImageTel($row['imageTel']);
         return $article;
     }
 }