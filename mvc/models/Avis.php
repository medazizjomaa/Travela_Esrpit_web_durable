<?php
class Avis {
    private $id;
    private $nom_client;
    private $email;
    private $note;
    private $commentaire;
    private $date_avis;
    private $avis_parent;
    private $likes;
    private $userId;

    
    public function __construct($id = null, $nom_client = '', $email = '', $note = null, $commentaire = '', $date_avis = null, $avis_parent = null, $likes = 0, $userId = null) {
        $this->id = $id;
        $this->nom_client = $nom_client;
        $this->email = $email;
        $this->note = $note;
        $this->commentaire = $commentaire;
        $this->date_avis = $date_avis;
        $this->avis_parent = $avis_parent;
        $this->likes = $likes;
        $this->userId = $userId;
    }

    
    public function getId() { return $this->id; }
    public function getUserId() { return $this->userId; }
    public function getLikes() { return $this->likes; }
    public function getNomClient() { return $this->nom_client; }
    public function getEmail() { return $this->email; }
    public function getNote() { return $this->note; }
    public function getCommentaire() { return $this->commentaire; }
    public function getDateAvis() { return $this->date_avis; }
    public function getAvisParent() { return $this->avis_parent; }

    
    public function setId($id) { $this->id = $id; }
    public function setUserId($userId) { $this->userId = $userId; }
    public function setLikes($likes) { $this->likes=$likes;}
    public function setNomClient($nom_client) { $this->nom_client = $nom_client; }
    public function setEmail($email) { $this->email = $email; }
    public function setNote($note) { $this->note = $note; }
    public function setCommentaire($commentaire) { $this->commentaire = $commentaire; }
    public function setDateAvis($date_avis) { $this->date_avis = $date_avis; }
    public function setAvisParent($avis_parent) { $this->avis_parent = $avis_parent; }
}