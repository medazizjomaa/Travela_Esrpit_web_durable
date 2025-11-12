<?php
require_once __DIR__ . '/../models/activites_evenement_durables.php';
require_once __DIR__ . '/../DBConnection.php';

class ActiviteEvenementDurableController {
    private $db;
    private $table = 'activites_evenement_durables';

    public function __construct() {
        $database = new DBConnection();
        $this->db = $database->getConnection();
    }

   
    public function create($data) {
        try {
            $query = "INSERT INTO " . $this->table . " 
                     (nom, description, type, lieu, date_debut, date_fin, responsable, image_url, video_url) 
                     VALUES (:nom, :description, :type, :lieu, :date_debut, :date_fin, :responsable, :image_url, :video_url)";
            
            $stmt = $this->db->prepare($query);
            
            
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':type', $data['type']);
            $stmt->bindParam(':lieu', $data['lieu']);
            
            $stmt->bindParam(':date_debut', $data['date_debut']);
            $stmt->bindParam(':date_fin', $data['date_fin']);
            $stmt->bindParam(':responsable', $data['responsable']);
            $stmt->bindParam(':image_url', $data['image_url']);
            $stmt->bindParam(':video_url', $data['video_url']);
            
            if ($stmt->execute()) {
                return [
                    'success' => true,
                    'message' => 'Activité/événement créé avec succès',
                    'id' => $this->db->lastInsertId()
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur lors de la création: ' . $e->getMessage()
            ];
        }
    }

    
    public function getAll() {
        try {
            $query = "SELECT * FROM " . $this->table . " ORDER BY date_debut DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération: " . $e->getMessage());
            return [];
        }
    }

    
    public function getById($id) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                return new ActiviteEvenementDurable(
                    $row['id'],
                    $row['nom'],
                    $row['description'],
                    $row['type'],
                    $row['lieu'],
                    $row['date_debut'],
                    $row['date_fin'],
                    $row['responsable'],
                    $row['image_url'],
                    $row['video_url']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération par ID: " . $e->getMessage());
            return null;
        }
    }

    
    public function getByType($type) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE type = :type ORDER BY date_debut DESC";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':type', $type);
            $stmt->execute();
            
            $activites = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $activites[] = new ActiviteEvenementDurable(
                    $row['id'],
                    $row['nom'],
                    $row['description'],
                    $row['type'],
                    $row['lieu'],
                    $row['date_debut'],
                    $row['date_fin'],
                    $row['responsable'],
                    $row['image_url'],
                    $row['video_url']
                );
            }
            
            return $activites;
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération par type: " . $e->getMessage());
            return [];
        }
    }

   
    public function update($id, $data) {
        try {
            $query = "UPDATE " . $this->table . " 
                     SET nom = :nom, description = :description, type = :type, lieu = :lieu, 
                         date_debut = :date_debut, date_fin = :date_fin, responsable = :responsable,
                         image_url = :image_url, video_url = :video_url 
                     WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nom', $data['nom']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':type', $data['type']);
            $stmt->bindParam(':lieu', $data['lieu']);
            $stmt->bindParam(':date_debut', $data['date_debut']);
            $stmt->bindParam(':date_fin', $data['date_fin']);
            $stmt->bindParam(':responsable', $data['responsable']);
            $stmt->bindParam(':image_url', $data['image_url']);
            $stmt->bindParam(':video_url', $data['video_url']);
            
            if ($stmt->execute()) {
                return [
                    'success' => true,
                    'message' => 'Activité/événement mis à jour avec succès'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()
            ];
        }
    }

    
    public function delete($id) {
        try {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                return [
                    'success' => true,
                    'message' => 'Activité/événement supprimé avec succès'
                ];
            }
        } catch (PDOException $e) {
            return [
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ];
        }
    }

    
    public function getUpcoming() {
        try {
            $query = "SELECT * FROM " . $this->table . " 
                     WHERE date_debut >= NOW() 
                     ORDER BY date_debut ASC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            $activites = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $activites[] = new ActiviteEvenementDurable(
                    $row['id'],
                    $row['nom'],
                    $row['description'],
                    $row['type'],
                    $row['lieu'],
                    $row['date_debut'],
                    $row['date_fin'],
                    $row['responsable'],
                    $row['image_url'],
                    $row['video_url']
                );
            }
            
            return $activites;
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des activités à venir: " . $e->getMessage());
            return [];
        }
    }
    
    
    public function addFromForm($data) {
        return $this->create($data);
    }

    
    public function updateFromForm($id, $data) {
        return $this->update($id, $data);
    }

    
    public function deleteFromForm($id) {
        return $this->delete($id);
    }
}


$filename = 'lEvt.php'; 

// Gestion des actions en bas du fichier
$controller = new ActiviteEvenementDurableController();

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {

        $data = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'type' => $_POST['type'],
            'lieu' => $_POST['lieu'],
            'date_debut' => $_POST['date_debut'],
            'date_fin' => $_POST['date_fin'],
            'responsable' => $_POST['responsable'],
            'image_url' => $_POST['image_url'],
            'video_url' => $_POST['video_url']
        ];
        $result = $controller->addFromForm($data);
        
        
        if ($result['success']) {
            echo "<script>alert('✅ Activité/événement créé !'); window.location='{$filename}';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la création: " . addslashes($result['message']) . "'); window.location='{$filename}';</script>";
        }
        exit();

    } elseif ($_GET['action'] === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $data = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'type' => $_POST['type'],
            'lieu' => $_POST['lieu'],
            'date_debut' => $_POST['date_debut'],
            'date_fin' => $_POST['date_fin'],
            'responsable' => $_POST['responsable'],
            'image_url' => $_POST['image_url'],
            'video_url' => $_POST['video_url']
        ];
        $result = $controller->updateFromForm($id, $data);
        
        
        if ($result['success']) {
            echo "<script>alert('✅ Activité/événement mis à jour !'); window.location='{$filename}';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la mise à jour: " . addslashes($result['message']) . "'); window.location='{$filename}';</script>";
        }
        exit();

    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        $result = $controller->deleteFromForm($_GET['id']);
        
       
        if ($result['success']) {
            echo "<script>alert('✅ Activité/événement supprimé !'); window.location='{$filename}';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la suppression: " . addslashes($result['message']) . "'); window.location='{$filename}';</script>";
        }
        exit();
    }
}


$activites = $controller->getAll();


?>