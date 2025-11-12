<?php
class Destination
{
    private $id_dest;
    private $nom_dest;
    private $prix;
    private $imageD;

    public function __construct($id_dest = null, $nom_dest = null, $prix = null, $imageD = null)
    {
        $this->id_dest = $id_dest;
        $this->nom_dest = $nom_dest;
        $this->prix = $prix;
        $this->imageD = $imageD;
    }

    
    public function getIdDest() { return $this->id_dest; }
    public function getNomDest() { return $this->nom_dest; }
    public function getPrix() { return $this->prix; }
    public function getImage() { return $this->imageD; }

    
    public function setIdDest($id_dest) { $this->id_dest = $id_dest; }
    public function setNomDest($nom_dest) { $this->nom_dest = $nom_dest; }
    public function setPrix($prix) { $this->prix = $prix; }
    public function setImage($imageD) { $this->imageD = $imageD; }
}
?>
