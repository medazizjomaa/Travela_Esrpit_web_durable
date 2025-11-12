<?php
require_once __DIR__ . '/../DBConnection.php';
require_once __DIR__ .'/../models/destinationModel.php';

class DestinationController
{
    private $db;

    public function __construct() {
        $database = new DBConnection();
        $this->db = $database->getConnection();
    }
    public function addDestination(Destination $dest)
    {
        $query = "INSERT INTO destination (nom_dest, prix, imageD)
                  VALUES (:nom_dest, :prix, :imageD)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nom_dest', $dest->getNomDest());
        $stmt->bindValue(':prix', $dest->getPrix());
        $stmt->bindValue(':imageD', $dest->getImage());
        return $stmt->execute();
    }
    public function getAllDestinations()
    {
        $stmt = $this->db->prepare("SELECT * FROM destination");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getDestinationById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM destination WHERE id_dest = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function deleteDestination($id)
    {
        $stmt = $this->db->prepare("DELETE FROM destination WHERE id_dest = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }


    public function updateDestination(Destination $dest)
    {
        $query = "UPDATE destination SET nom_dest=:nom_dest, prix=:prix, imageD=:imageD WHERE id_dest=:id_dest";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_dest', $dest->getIdDest());
        $stmt->bindValue(':nom_dest', $dest->getNomDest());
        $stmt->bindValue(':prix', $dest->getPrix());
        $stmt->bindValue(':imageD', $dest->getImage());
        return $stmt->execute();
    }

public function updateDestinationById($id_dest, $nom_dest, $prix, $imageD)
{
    $query = "UPDATE destination SET nom_dest=:nom_dest, prix=:prix, imageD=:imageD WHERE id_dest=:id_dest";
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id_dest', $id_dest);
    $stmt->bindValue(':nom_dest', $nom_dest);
    $stmt->bindValue(':prix', $prix);
    $stmt->bindValue(':imageD', $imageD);
    return $stmt->execute();
}
}
$controller = new DestinationController();
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $dest = new Destination();
        $dest->setNomDest($_POST['nom_dest']);
        $dest->setPrix($_POST['prix']);
        $dest->setImage($_POST['imageD']);
        if ($controller->addDestination($dest)) {
            echo "<script>alert('✅ Destination ajoutée !'); window.location='lDest.php';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de l\'ajout.');</script>";
        }
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        if ($controller->deleteDestination($_GET['id'])) {
            echo "<script>alert('✅ Destination supprimée !'); window.location='lDest.php';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la suppression.');</script>";
        }
    } elseif ($_GET['action'] === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_dest = $_POST['id_dest'];
        $nom_dest = $_POST['nom_dest'];
        $prix = $_POST['prix'];
        $imageD = $_POST['imageD'];
        if ($controller->updateDestinationById($id_dest, $nom_dest, $prix, $imageD)) {
            echo "<script>alert('✅ Destination mise à jour !'); window.location='lDest.php';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la mise à jour.');</script>";
        }
    }
}
?>
