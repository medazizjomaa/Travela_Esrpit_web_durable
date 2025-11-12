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

    // CREATE - Ajouter une nouvelle activité/événement
    public function create($data) {
        try {
            $query = "INSERT INTO " . $this->table . " 
                     (nom, description, type, lieu, date_debut, date_fin, responsable, image_url, video_url) 
                     VALUES (:nom, :description, :type, :lieu, :date_debut, :date_fin, :responsable, :image_url, :video_url)";
            
            $stmt = $this->db->prepare($query);
            
            // Bind des paramètres
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

    // READ - Récupérer toutes les activités/événements
    public function getAll() {
        try {
            $query = "SELECT * FROM " . $this->table . " ORDER BY date_debut DESC";
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
            error_log("Erreur lors de la récupération: " . $e->getMessage());
            return [];
        }
    }

    // READ - Récupérer une activité/événement par ID
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

    // READ - Récupérer par type (activité ou événement)
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

    // UPDATE - Mettre à jour une activité/événement
    public function update($id, $data) {
        try {
            $query = "UPDATE " . $this->table . " 
                     SET nom = :nom, description = :description, type = :type, lieu = :lieu, 
                         date_debut = :date_debut, date_fin = :date_fin, responsable = :responsable,
                         image_url = :image_url, video_url = :video_url 
                     WHERE id = :id";
            
            $stmt = $this->db->prepare($query);
            
            // Bind des paramètres
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

    // DELETE - Supprimer une activité/événement
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

    // Récupérer les activités/événements à venir
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
}
?>