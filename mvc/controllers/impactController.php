<?php
require_once __DIR__ . '/../DBConnection.php';
require_once __DIR__ . '/../models/ImpactEcologique.php';


class ImpactController {
    private $db;

    public function __construct() {
        $database = new DBConnection();
        $this->db = $database->getConnection();
    }

    

    
    public function afficherFormulaire() {
        require_once("../views/frontOffice/impactEco.php");
    }

    
    public function calculer() {
        if (isset($_POST['transport'], $_POST['distance'], $_POST['voyageurs'], $_POST['hebergement'])) {
            $transport = $_POST['transport'];
            $distance = floatval($_POST['distance']);
            $voyageurs = intval($_POST['voyageurs']);
            $hebergement = $_POST['hebergement'];

            $impact = new ImpactEcologique($transport, $distance, $voyageurs, $hebergement);

            $co2_total = $this->calculerImpact($impact);

            $this->ajouter($impact, $co2_total); 

            
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'transport' => $transport,
                'distance' => $distance,
                'voyageurs' => $voyageurs,
                'hebergement' => $hebergement,
                'co2_total' => $co2_total,
                'co2_transport' => ($impact->getDistance() * $this->getEmissionTransport($transport) * $impact->getVoyageurs() / 1000),
                'co2_hebergement' => $this->getEmissionHebergement($hebergement)
            ]);
            exit();
        } else {
            header("Location: index.php?action=formulaire");
            exit();
        }
    }

    
    private function getEmissionTransport($transport) {
        $emissions = [
            "avion" => 250,
            "train" => 40,
            "bus" => 80,
            "voiture" => 120,
            "velo" => 0
        ];
        return $emissions[$transport] ?? 0;
    }

    private function getEmissionHebergement($hebergement) {
        $emissions = [
            "hotel_classique" => 30,
            "auberge_eco" => 10,
            "camping" => 5
        ];
        return $emissions[$hebergement] ?? 0;
    }

    public function getAllImpacts() {
        $query = "SELECT * FROM impact_ecologique ORDER BY date_calcul DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function calculerImpact($impact) {
        $transport_emission = $this->getEmissionTransport($impact->getTransport());
        $hebergement_emission = $this->getEmissionHebergement($impact->getHebergement());

        $co2_total = ($impact->getDistance() * $transport_emission * $impact->getVoyageurs() / 1000) + $hebergement_emission;

        $impact->setCO2Total($co2_total);
        $impact->setDateCalcul(date("Y-m-d"));

        return $co2_total;
    }

    

    
    public function ajouter($impact, $co2_total) {
        $sql = "INSERT INTO IMPACT_ECOLOGIQUE 
                (TRANSPORT, DISTANCE, VOYAGEURS, HEBERGEMENT, CO2_TOTAL, DATE_CALCUL)
                VALUES (:transport, :distance, :voyageurs, :hebergement, :co2_total, :date_calcul)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':transport' => $impact->getTransport(),
            ':distance' => $impact->getDistance(),
            ':voyageurs' => $impact->getVoyageurs(),
            ':hebergement' => $impact->getHebergement(),
            ':co2_total' => $co2_total,
            ':date_calcul' => date("Y-m-d")
        ]);
    }

    
    public function historique() {
        $sql = "SELECT * FROM IMPACT_ECOLOGIQUE ORDER BY DATE_CALCUL DESC";
        $stmt = $this->db->query($sql);
        $historique = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require("../views/frontOffice/historique_impact.php");
    }

    
    public function lireParId($id) {
        $sql = "SELECT * FROM IMPACT_ECOLOGIQUE WHERE ID = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function handleActions() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            switch($action) {
                case 'supprimer':
                    $this->deleteImpact();
                    break;
                case 'modifier':
                    $this->modifier();
                    break;
            }
        }
    }

    
public function updateImpact($id, $transport, $distance, $voyageurs, $hebergement)
{
    try {
        
        $impact = new ImpactEcologique($transport, $distance, $voyageurs, $hebergement);
        $co2_total = $this->calculerImpact($impact);

        
        $sql = "UPDATE IMPACT_ECOLOGIQUE 
                SET TRANSPORT = :transport, DISTANCE = :distance, VOYAGEURS = :voyageurs, 
                    HEBERGEMENT = :hebergement, CO2_TOTAL = :co2_total, DATE_CALCUL = :date_calcul
                WHERE ID = :id";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':transport' => $transport,
            ':distance' => $distance,
            ':voyageurs' => $voyageurs,
            ':hebergement' => $hebergement,
            ':co2_total' => $co2_total,
            ':date_calcul' => date("Y-m-d"), 
            ':id' => $id
        ]);
    } catch (PDOException $e) {
        
        error_log("Erreur de mise à jour de l'impact: " . $e->getMessage());
        return false;
    }
}
    
    public function deleteImpact() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            try {
                $sql = "DELETE FROM IMPACT_ECOLOGIQUE WHERE ID = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':id' => $id]);

                
                header("Location: ../views/backOffice/listeIMP.php?success=1");
                exit();
            } catch (PDOException $e) {
                error_log("Erreur suppression: " . $e->getMessage());
                header("Location: ../views/backOffice/listeIMP.php?error=1");
                exit();
            }
        }
    }

    
    public function modifier() {
        if (isset($_POST['id'], $_POST['transport'], $_POST['distance'], $_POST['voyageurs'], $_POST['hebergement'])) {
            $id = $_POST['id'];
            $transport = $_POST['transport'];
            $distance = floatval($_POST['distance']);
            $voyageurs = intval($_POST['voyageurs']);
            $hebergement = $_POST['hebergement'];

            try {
                
                $impact = new ImpactEcologique($transport, $distance, $voyageurs, $hebergement);
                $co2_total = $this->calculerImpact($impact);

                $sql = "UPDATE IMPACT_ECOLOGIQUE 
                        SET TRANSPORT = :transport, DISTANCE = :distance, VOYAGEURS = :voyageurs, 
                            HEBERGEMENT = :hebergement, CO2_TOTAL = :co2_total, DATE_CALCUL = :date_calcul
                        WHERE ID = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':transport' => $transport,
                    ':distance' => $distance,
                    ':voyageurs' => $voyageurs,
                    ':hebergement' => $hebergement,
                    ':co2_total' => $co2_total,
                    ':date_calcul' => date("Y-m-d"),
                    ':id' => $id
                ]);

                
                header("Location: ../views/backOffice/listeIMP.php?success=1");
                exit();
            } catch (PDOException $e) {
                error_log("Erreur modification: " . $e->getMessage());
                header("Location: ../views/backOffice/ listeIMP.php?error=1");
                exit();
            }
        }
    }
}

$controller = new ImpactController();


$impacts = $controller->getAllImpacts();
$transports = ['avion', 'train', 'bus', 'voiture', 'velo']; 
$hebergements = ['hotel_classique', 'auberge_eco', 'camping']; 


if (isset($_GET['action'])) {
    if ($_GET['action'] === 'calculer' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $controller->calculer();
    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        
        if ($controller->deleteImpact($_GET['id'])) { // Renommez votre méthode supprimer() en deleteImpact() pour la cohérence
            echo "<script>alert('✅ Impact supprimé !'); window.location='../views/backOffice/lImp.php';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la suppression.'); window.location='../views/backOffice/lImp.php';</script>";
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
   
    $id = $_POST['id'];
    $transport = $_POST['transport'];
    $distance = floatval($_POST['distance']);
    $voyageurs = intval($_POST['voyageurs']);
    $hebergement = $_POST['hebergement'];
    
    
    if ($controller->updateImpact($id, $transport, $distance, $voyageurs, $hebergement)) {
        echo "<script>alert('✅ Impact mis à jour !'); window.location='../views/backOffice/lImp.php';</script>";
    } else {
        echo "<script>alert('❌ Erreur lors de la mise à jour.'); window.location='../views/backOffice/lImp.php';</script>";
    }
}


?>
