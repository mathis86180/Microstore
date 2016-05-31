<?php
namespace MicroStore\Domain;

Class Panier{
    private $idTelCo;
    private $idCommandeLi;
    private $qte;
    private $prixTTC;
    private $idClient;
    private $nomTel;
    /**
     * @return mixed
     */
    public function getIdCommandeLi()
    {
        return $this->idCommandeLi;
    }
    /**
     * @param mixed $idCommandeLi
     */
    public function setIdCommandeLi($idCommandeLi)
    {
        $this->idCommandeLi = $idCommandeLi;
    }
    /**
     * @return mixed
     */
    public function getQte()
    {
        return $this->qte;
    }
    /**
     * @param mixed $qte
     */
    public function setQte($qte)
    {
        $this->qte = $qte;
    }
    /**
     * @return mixed
     */
    public function getPrixTTC()
    {
        return $this->prixTTC;
    }
    /**
     * @param mixed $prixTTC
     */
    public function setPrixTTC($prixTTC)
    {
        $this->prixTTC = $prixTTC;
    }

    public function getIdTelCo(){
        return $this->idTelCo;
    }

    public function setIdTelCo($idTelCo){
        $this->idTelCo = $idTelCo;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @param mixed $idClient
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    /**
     * @return mixed
     */
    public function getNomTel()
    {
        return $this->nomTel;
    }

    /**
     * @param mixed $nomTel
     */
    public function setNomTel($nomTel)
    {
        $this->nomTel = $nomTel;
    }




}