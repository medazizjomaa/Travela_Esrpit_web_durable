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

    // idresdev
    public function getIdResDev() { return $this->idresdev; }
    public function setIdResDev($idresdev) { $this->idresdev = $idresdev; }

    // idclient
    public function getIdClient() { return $this->idclient; }
    public function setIdClient($idclient) { $this->idclient = $idclient; }

    // mailclient
    public function getMailClient() { return $this->mailclient; }
    public function setMailClient($mailclient) { $this->mailclient = $mailclient; }

    // phonenumber
    public function getPhoneNumber() { return $this->phonenumber; }
    public function setPhoneNumber($phonenumber) { $this->phonenumber = $phonenumber; }

    // placename
    public function getPlaceName() { return $this->placename; }
    public function setPlaceName($placename) { $this->placename = $placename; }

    // persons
    public function getPersons() { return $this->persons; }
    public function setPersons($persons) { $this->persons = $persons; }

    // nbrpersons
    public function getNbrPersons() { return $this->nbrpersons; }
    public function setNbrPersons($nbrpersons) { $this->nbrpersons = $nbrpersons; }

    // price
    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price; }

    // datereservation
    public function getDateReservation() { return $this->datereservation; }
    public function setDateReservation($datereservation) { $this->datereservation = $datereservation; }

    // statut
    public function getStatut() { return $this->statut; }
    public function setStatut($statut) { $this->statut = $statut; }
}
?>
