<?php
class FacteursEmission {
    public static function getTransport() {
        return [
            "avion" => 250,
            "train" => 40,
            "bus" => 80,
            "voiture" => 120,
            "velo" => 0
        ];
    }

    public static function getHebergement() {
        return [
            "hotel_classique" => 30,
            "auberge_eco" => 10,
            "camping" => 5
        ];
    }
}
?>
