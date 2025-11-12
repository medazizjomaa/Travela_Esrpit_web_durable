<?php
require_once __DIR__ . '/Avis.php';
require_once __DIR__ . '/../../Database.php';

class AvisDAO {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS avis_clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom_client VARCHAR(100),
            email VARCHAR(100),
            note INT,
            commentaire TEXT,
            date_avis DATETIME DEFAULT CURRENT_TIMESTAMP,
            avis_parent INT DEFAULT NULL
        )";
        
        return $this->conn->query($sql);
    }

    public function ajouterAvis(Avis $avis) {
        if ($avis->getAvisParent() === null) {
            $sql = "INSERT INTO avis_clients (nom_client, email, note, commentaire) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if ($stmt) {
               
                $nom = $avis->getNomClient();
                $email = $avis->getEmail();
                $note = $avis->getNote();
                $commentaire = $avis->getCommentaire();

                $stmt->bind_param("ssis", $nom, $email, $note, $commentaire);
                return $stmt->execute();
            }
        } else {
            $sql = "INSERT INTO avis_clients (nom_client, email, commentaire, avis_parent) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            if ($stmt) {
               
                $nom = $avis->getNomClient();
                $email = $avis->getEmail();
                $commentaire = $avis->getCommentaire();
                $avis_parent = $avis->getAvisParent();

                $stmt->bind_param("sssi", $nom, $email, $commentaire, $avis_parent);
                return $stmt->execute();
            }
        }
        return false;
    }

    public function getAvisPrincipaux() {
        $sql = "SELECT * FROM avis_clients WHERE avis_parent IS NULL ORDER BY date_avis DESC";
        $result = $this->conn->query($sql);
        
        $avis_list = array();
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $avis = new Avis();
                $avis->setId($row['id'])
                     ->setNomClient($row['nom_client'])
                     ->setEmail($row['email'])
                     ->setNote($row['note'])
                     ->setCommentaire($row['commentaire'])
                     ->setDateAvis($row['date_avis'])
                     ->setAvisParent($row['avis_parent']);
                $avis_list[] = $avis;
            }
        }
        return $avis_list;
    }

    public function getReponsesByAvisId($avis_id) {
        $sql = "SELECT * FROM avis_clients WHERE avis_parent = ? ORDER BY date_avis ASC";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $avis_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $reponses = array();
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $avis = new Avis();
                    $avis->setId($row['id'])
                         ->setNomClient($row['nom_client'])
                         ->setEmail($row['email'])
                         ->setCommentaire($row['commentaire'])
                         ->setDateAvis($row['date_avis'])
                         ->setAvisParent($row['avis_parent']);
                    $reponses[] = $avis;
                }
            }
            return $reponses;
        }
        return array();
    }
}
?>
