<?php

namespace MicroStore\DAO;
use MicroStore\Domain\Panier;

class PanierDAO extends DAO{
    public function savePanier(Panier $panier)
    {
        $panierData = array(
            'idTelCo' => $panier->getIdTelCo(),
            'qte' => 1,
            'prixTTC' => $panier->getPrixTTC(),
            'idClient' => $panier->getIdClient(),
            'nomTel' => $panier->getNomTel()
        );
            $this->getDb()->insert('lignepanier', $panierData);
    }

    public function find($idClient)
    {
        $sql = "SELECT * FROM lignepanier WHERE idClient=?";
        $result = $this->getDb()->fetchAssoc($sql, array($idClient));

        if ($result) {
            $panier = array();
            foreach ($result as $row) {
                $panierId = $row['idCommandeLi'];
                $panier[$panierId] = $this->buildDomainObject($row);
            }
            return $panier;
        }
    }

    public function findAll() {
        $sql = "select * from lignepanier order by idCommandeLi";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $panierId = $row['idCommandeLi'];
            $articles[$panierId] = $this->buildDomainObject($row);
        }
        return $articles;
    }

    protected function buildDomainObject($row) {
        $panier = new Panier();
        $panier->setIdTelCo($row['idTelCo']);
        $panier->setIdClient($row['idClient']);
        $panier->setIdCommandeLi($row['idCommandeLi']);
        $panier->setPrixTTC($row['prixTTC']);
        $panier->setQte($row['qte']);
        $panier->setNomTel($row['nomTel']);
        return $panier;
    }


}