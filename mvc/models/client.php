<?php
class Client {
    
    private $idclient;
    private $nomclient;
    private $prenomclient;
    private $mailclient;
    private $motdepasse;
    private $db; // connexion à la base

    
    public function __construct($db, $nomclient = null, $prenomclient = null, $mailclient = null, $motdepasse = null) {
        $this->db = $db;
        
        if ($nomclient !== null) {
            $this->nomclient = $nomclient;
        }
        if ($prenomclient !== null) {
            $this->prenomclient = $prenomclient;
        }
        if ($mailclient !== null) {
            $this->mailclient = $mailclient;
        }
        if ($motdepasse !== null && !empty($motdepasse)) {
            $this->motdepasse = password_hash($motdepasse, PASSWORD_BCRYPT);
        }
    }

    
    public function getIdClient() {
        return $this->idclient;
    }

    public function getNomClient() {
        return $this->nomclient;
    }

    public function getPrenomClient() {
        return $this->prenomclient;
    }

    public function getMailClient() {
        return $this->mailclient;
    }

    public function getMotDePasse() {
        return $this->motdepasse;
    }

    
    public function setIdClient($id) {
        $this->idclient = $id;
    }

    public function setNomClient($nom) {
        $this->nomclient = $nom;
    }

    public function setPrenomClient($prenom) {
        $this->prenomclient = $prenom;
    }

    public function setMailClient($mail) {
        $this->mailclient = $mail;
    }

    public function setMotDePasse($motdepasse) {
        if (!empty($motdepasse)) {
            $this->motdepasse = password_hash($motdepasse, PASSWORD_BCRYPT);
        }
    }
}
?>