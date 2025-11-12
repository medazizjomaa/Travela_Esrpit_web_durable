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
            // Correction pour s'assurer que les dates/heures sont bien formatées
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
    // 🚨 CORRECTION : Retourne des tableaux associatifs pour la vue.
    public function getAll() {
        try {
            $query = "SELECT * FROM " . $this->table . " ORDER BY date_debut DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            
            // Retourne un tableau simple des données de la BD (plus facile à utiliser dans la vue PHP)
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération: " . $e->getMessage());
            return [];
        }
    }

    // READ - Récupérer une activité/événement par ID (garde le retour d'objet pour les autres usages)
    public function getById($id) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                // Retourne un objet 'ActiviteEvenementDurable'
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

    // READ - Récupérer par type (activité ou événement) (garde le retour d'objet pour les autres usages)
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

    // Récupérer les activités/événements à venir (garde le retour d'objet pour les autres usages)
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
    
    // 🔹 Méthode pour ajouter via formulaire
    public function addFromForm($data) {
        return $this->create($data);
    }

    // 🔹 Méthode pour mettre à jour via formulaire
    public function updateFromForm($id, $data) {
        return $this->update($id, $data);
    }

    // 🔹 Méthode pour supprimer via formulaire
    public function deleteFromForm($id) {
        return $this->delete($id);
    }
}

// Fichier de destination pour les redirections
$filename = 'lEvt.php'; 

// Gestion des actions en bas du fichier
$controller = new ActiviteEvenementDurableController();

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cette section était en JSON, gardons-la si vous utilisez AJAX pour l'ajout. 
        // Si vous voulez une redirection, il faut la modifier comme delete/update ci-dessous.
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
        
        // Redirection après ajout (si non utilisé via AJAX)
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
        
        // 🚨 CORRECTION : Utilisation de redirection JS + alerte
        if ($result['success']) {
            echo "<script>alert('✅ Activité/événement mis à jour !'); window.location='{$filename}';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la mise à jour: " . addslashes($result['message']) . "'); window.location='{$filename}';</script>";
        }
        exit();

    } elseif ($_GET['action'] === 'delete' && isset($_GET['id'])) {
        $result = $controller->deleteFromForm($_GET['id']);
        
        // 🚨 CORRECTION : Utilisation de redirection JS + alerte
        if ($result['success']) {
            echo "<script>alert('✅ Activité/événement supprimé !'); window.location='{$filename}';</script>";
        } else {
            echo "<script>alert('❌ Erreur lors de la suppression: " . addslashes($result['message']) . "'); window.location='{$filename}';</script>";
        }
        exit();
    }
}

// 📌 Étape cruciale : Récupérer toutes les activités pour la vue
// Si aucune action n'est demandée, cette variable sera utilisée pour afficher la liste.
$activites = $controller->getAll();

// Le reste du code (qui inclut la vue) est censé se trouver ici, 
// ou vous incluez manuellement le fichier de vue (lActivites.php) après ce point.
?>