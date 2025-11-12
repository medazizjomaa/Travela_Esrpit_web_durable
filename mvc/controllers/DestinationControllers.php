<?php
require_once __DIR__ . '/../DBConnection.php';
require_once __DIR__ . '/../models/Destination.php';

class DestinationController {
    private $db;

    public function __construct() {
        $database = new DBConnection();
        $this->db = $database->getConnection();
    }

    /* -------------------- FRONT OFFICE -------------------- */

    // Show front office page
    public function showFrontPage() {
        require_once("../views/frontOffice/destination.php");
    }

    // Add reservation from front office
    public function addReservation() {
        if (isset($_POST['nomclient'], $_POST['mailclient'], $_POST['phonenumber'], $_POST['placename'], $_POST['nbrpersons'], $_POST['price'])) {
            $nomclient = $_POST['nomclient'];
            $mailclient = $_POST['mailclient'];
            $phonenumber = $_POST['phonenumber'];
            $placename = $_POST['placename'];
            $nbrpersons = intval($_POST['nbrpersons']);
            $price = floatval($_POST['price']);

            $sql = "INSERT INTO desrev (idclient, mailclient, phonenumber, placename, persons, nbrpersons, price) 
                    VALUES (:idclient, :mailclient, :phonenumber, :placename, :persons, :nbrpersons, :price)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':idclient' => 1, // default, or replace with logged-in user
                ':mailclient' => $mailclient,
                ':phonenumber' => $phonenumber,
                ':placename' => $placename,
                ':persons' => $nomclient,
                ':nbrpersons' => $nbrpersons,
                ':price' => $price
            ]);

            header("Location: ../views/frontOffice/destination.php?success=1");
            exit();
        }
    }

    /* -------------------- BACK OFFICE -------------------- */

    // List all reservations for back office
    public function listeDestinations() {
        $sql = "SELECT * FROM desrev ORDER BY idresdev DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read reservation by ID
    public function lireParId($idresdev) {
        $sql = "SELECT * FROM desrev WHERE idresdev = :idresdev";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':idresdev' => $idresdev]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete reservation
    public function supprimer() {
        if (isset($_POST['idresdev'])) {
            $id = $_POST['idresdev'];
            try {
                $sql = "DELETE FROM desrev WHERE idresdev = :idresdev";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':idresdev' => $id]);

                header("Location: ../views/backOffice/listeDEST.php?success=1");
                exit();
            } catch (PDOException $e) {
                error_log("Erreur suppression: " . $e->getMessage());
                header("Location: ../views/backOffice/listeDEST.php?error=1");
                exit();
            }
        }
    }

    // Modify reservation
    public function modifier() {
        if (isset($_POST['idresdev'], $_POST['nomclient'], $_POST['mailclient'], $_POST['phonenumber'], $_POST['placename'], $_POST['nbrpersons'], $_POST['price'])) {
            $id = $_POST['idresdev'];
            $nomclient = $_POST['nomclient'];
            $mailclient = $_POST['mailclient'];
            $phonenumber = $_POST['phonenumber'];
            $placename = $_POST['placename'];
            $nbrpersons = intval($_POST['nbrpersons']);
            $price = floatval($_POST['price']);

            try {
                $sql = "UPDATE desrev 
                        SET persons = :nomclient, mailclient = :mailclient, phonenumber = :phonenumber, 
                            placename = :placename, nbrpersons = :nbrpersons, price = :price
                        WHERE idresdev = :idresdev";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':nomclient' => $nomclient,
                    ':mailclient' => $mailclient,
                    ':phonenumber' => $phonenumber,
                    ':placename' => $placename,
                    ':nbrpersons' => $nbrpersons,
                    ':price' => $price,
                    ':idresdev' => $id
                ]);

                header("Location: ../views/backOffice/listeDEST.php?success=1");
                exit();
            } catch (PDOException $e) {
                error_log("Erreur modification: " . $e->getMessage());
                header("Location: ../views/backOffice/listeDEST.php?error=1");
                exit();
            }
        }
    }

    // Handle POST actions (add, modify, delete)
    public function handleActions() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            switch($action) {
                case 'supprimer':
                    $this->supprimer();
                    break;
                case 'modifier':
                    $this->modifier();
                    break;
                case 'ajouter':
                    $this->addReservation();
                    break;
            }
        }
    }
}
?>
