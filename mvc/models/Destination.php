<?php
class Destination {
    private $idresdev;
    private $idclient;
    private $mailclient;
    private $phonenumber;
    private $placename;
    private $persons;
    private $nbrpersons;
    private $price;
    private $datereservation;
    private $statut;

    
    public function getIdResDev() { return $this->idresdev; }
    public function setIdResDev($idresdev) { $this->idresdev = $idresdev; }

    
    public function getIdClient() { return $this->idclient; }
    public function setIdClient($idclient) { $this->idclient = $idclient; }

    
    public function getMailClient() { return $this->mailclient; }
    public function setMailClient($mailclient) { $this->mailclient = $mailclient; }

    
    public function getPhoneNumber() { return $this->phonenumber; }
    public function setPhoneNumber($phonenumber) { $this->phonenumber = $phonenumber; }

    
    public function getPlaceName() { return $this->placename; }
    public function setPlaceName($placename) { $this->placename = $placename; }

    
    public function getPersons() { return $this->persons; }
    public function setPersons($persons) { $this->persons = $persons; }

    
    public function getNbrPersons() { return $this->nbrpersons; }
    public function setNbrPersons($nbrpersons) { $this->nbrpersons = $nbrpersons; }

    
    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price; }

    
    public function getDateReservation() { return $this->datereservation; }
    public function setDateReservation($datereservation) { $this->datereservation = $datereservation; }

   
    public function getStatut() { return $this->statut; }
    public function setStatut($statut) { $this->statut = $statut; }
}
?>
