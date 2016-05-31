<?php

namespace MicroStore\Domain;

class TelephoneMobile{
    private $idTel;
    private $libelleTel;
    private $idFabricantTel;
    private $OS;
    private $prixUnitaire;
    private $stock;
    private $imageTel;
    /**
     * @return mixed
     */
    public function getIdTel()
    {
        return $this->idTel;
    }
    /**
     * @param mixed $idTel
     */
    public function setIdTel($idTel)
    {
        $this->idTel = $idTel;
    }
    /**
     * @return mixed
     */
    public function getLibelleTel()
    {
        return $this->libelleTel;
    }
    /**
     * @param mixed $libelleTel
     */
    public function setLibelleTel($libelleTel)
    {
        $this->libelleTel = $libelleTel;
    }
    /**
     * @return mixed
     */
    public function getIdFabricantTel()
    {
        return $this->idFabricantTel;
    }
    /**
     * @param mixed $idFabricantTel
     */
    public function setIdFabricantTel($idFabricantTel)
    {
        $this->idFabricantTel = $idFabricantTel;
    }
    /**
     * @return mixed
     */
    public function getOS()
    {
        return $this->OS;
    }
    /**
     * @param mixed $OS
     */
    public function setOS($OS)
    {
        $this->OS = $OS;
    }
    /**
     * @return mixed
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }
    /**
     * @param mixed $prixUnitaire
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    }
    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }
    /**
     * @param mixed $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getImageTel()
    {
        return $this->imageTel;
    }

    /**
     * @param mixed $image
     */
    public function setImageTel($image)
    {
        $this->imageTel = $image;
    }



}
