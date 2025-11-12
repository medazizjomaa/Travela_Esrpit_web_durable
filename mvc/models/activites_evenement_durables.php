<?php
class ActiviteEvenementDurable {
    private $id;
    private $nom;
    private $description;
    private $type;
    private $lieu;
    private $date_debut;
    private $date_fin;
    private $responsable;
    private $image_url;
    private $video_url;

    
    public function __construct($id = null, $nom = '', $description = '', $type = '', $lieu = '', $date_debut = null, $date_fin = null, $responsable = '', $image_url = null, $video_url = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->type = $type;
        $this->lieu = $lieu;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->responsable = $responsable;
        $this->image_url = $image_url;
        $this->video_url = $video_url;
    }

    
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getDescription() { return $this->description; }
    public function getType() { return $this->type; }
    public function getLieu() { return $this->lieu; }
    public function getDateDebut() { return $this->date_debut; }
    public function getDateFin() { return $this->date_fin; }
    public function getResponsable() { return $this->responsable; }
    public function getImageUrl() { return $this->image_url; }
    public function getVideoUrl() { return $this->video_url; }

   
    public function setId($id) { $this->id = $id; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setDescription($description) { $this->description = $description; }
    public function setType($type) { $this->type = $type; }
    public function setLieu($lieu) { $this->lieu = $lieu; }
    public function setDateDebut($date_debut) { $this->date_debut = $date_debut; }
    public function setDateFin($date_fin) { $this->date_fin = $date_fin; }
    public function setResponsable($responsable) { $this->responsable = $responsable; }
    public function setImageUrl($image_url) { $this->image_url = $image_url; }
    public function setVideoUrl($video_url) { $this->video_url = $video_url; }
}
?>