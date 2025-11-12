<?php
class ImpactEcologique {
    private $transport;
    private $distance;
    private $voyageurs;
    private $hebergement;
    private $co2_total;
    private $date_calcul;

    // Constructeur
    public function __construct($transport, $distance, $voyageurs, $hebergement) {
        $this->transport = $transport;
        $this->distance = $distance;
        $this->voyageurs = $voyageurs;
        $this->hebergement = $hebergement;
    }

    // -------------------- GETTERS --------------------
    public function getTransport() { return $this->transport; }
    public function getDistance() { return $this->distance; }
    public function getVoyageurs() { return $this->voyageurs; }
    public function getHebergement() { return $this->hebergement; }
    public function getCO2Total() { return $this->co2_total; }
    public function getDateCalcul() { return $this->date_calcul; }

    // -------------------- SETTERS --------------------
    public function setTransport($transport) { $this->transport = $transport; }
    public function setDistance($distance) { $this->distance = $distance; }
    public function setVoyageurs($voyageurs) { $this->voyageurs = $voyageurs; }
    public function setHebergement($hebergement) { $this->hebergement = $hebergement; }
    public function setCO2Total($co2_total) { $this->co2_total = $co2_total; }
    public function setDateCalcul($date_calcul) { $this->date_calcul = $date_calcul; }
}
?>
