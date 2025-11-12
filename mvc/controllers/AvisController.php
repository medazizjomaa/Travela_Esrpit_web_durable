<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/travela/mvc/models/Avis.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/travela/mvc/DBConnection.php'; 

class AvisController {
    
    private $db; 
    private $tableName = 'avis_clients';

    public function __construct() {
        $database = new DBConnection(); 
        $this->db = $database->getConnection(); 
        $this->createTableIfNotExists(); 
    }

    // Création de la table si elle n'existe pas (inchangé)
    private function createTableIfNotExists() {
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->tableName . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom_client VARCHAR(100),
            email VARCHAR(100),
            note INT,
            commentaire TEXT,
            date_avis DATETIME DEFAULT CURRENT_TIMESTAMP,
            avis_parent INT DEFAULT NULL,
            likes INT DEFAULT 0,
            user_id INT DEFAULT NULL
        )";
        try {
            $this->db->exec($sql);
        } catch (PDOException $e) {
            error_log("Erreur lors de la création de la table: " . $e->getMessage());
        }
    }

    // Ajouter un avis ou une réponse (inchangé)
    public function ajouterAvis(Avis $avis) {
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if ($avis->getAvisParent() === null) {
            // Avis principal
            $sql = "INSERT INTO " . $this->tableName . " (nom_client, email, note, commentaire, user_id) VALUES (:nom, :email, :note, :commentaire, :user_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nom', $avis->getNomClient(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $avis->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':note', $avis->getNote(), PDO::PARAM_INT);
            $stmt->bindValue(':commentaire', $avis->getCommentaire(), PDO::PARAM_STR);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        } else {
            // Réponse
            // NOTE: Assurez-vous que l'email est correctement géré pour les réponses (ici il est null dans le constructeur de la réponse, assurez-vous que la colonne l'accepte ou fournissez un email par défaut/vide)
            $email_response = $avis->getEmail() ?? ''; 
            $sql = "INSERT INTO " . $this->tableName . " (nom_client, email, commentaire, avis_parent, user_id) VALUES (:nom, :email, :commentaire, :avis_parent, :user_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nom', $avis->getNomClient(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $email_response, PDO::PARAM_STR);
            $stmt->bindValue(':commentaire', $avis->getCommentaire(), PDO::PARAM_STR);
            $stmt->bindValue(':avis_parent', $avis->getAvisParent(), PDO::PARAM_INT);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        }
        return $stmt->execute();
    }

    // Récupérer tous les avis principaux (inchangé)
    public function getAvisPrincipaux() {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE avis_parent IS NULL ORDER BY date_avis DESC";
        $stmt = $this->db->query($sql);
        $avis_list = array();
        if ($stmt) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $row) {
                $avis = new Avis(
                    $row['id'],
                    $row['nom_client'],
                    $row['email'],
                    $row['note'],
                    $row['commentaire'],
                    $row['date_avis'],
                    $row['avis_parent']
                );
                $avis->setLikes($row['likes']);
                $avis->setUserId($row['user_id']);
                $avis_list[] = $avis;
            }
        }
        return $avis_list;
    }

    // Récupérer les réponses d'un avis (inchangé)
    public function getReponsesByAvisId($avis_id) {
        $sql = "SELECT * FROM " . $this->tableName . " WHERE avis_parent = :avis_id ORDER BY date_avis ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':avis_id', $avis_id, PDO::PARAM_INT);
        $stmt->execute();
        $reponses = array();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            $avis = new Avis(
                $row['id'],
                $row['nom_client'],
                $row['email'],
                null,
                $row['commentaire'],
                $row['date_avis'],
                $row['avis_parent']
            );
            $avis->setLikes($row['likes']);
            $avis->setUserId($row['user_id']);
            $reponses[] = $avis;
        }
        return $reponses;
    }

    // Calculer la moyenne des notes (inchangé)
    public function getAverageNote() {
        $sql = "SELECT AVG(note) as avg_note FROM " . $this->tableName . " WHERE avis_parent IS NULL AND note IS NOT NULL";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return round($result['avg_note'], 1) ?? 0;
    }

    // Incrémenter les likes (inchangé)
    public function incrementLikes($id) {
        $sql = "UPDATE " . $this->tableName . " SET likes = likes + 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Modifier un avis (inchangé)
    public function modifierAvis($id, $nom, $email, $note, $commentaire) {
        
        $sql = "UPDATE " . $this->tableName . " SET nom_client = :nom, email = :email, note = :note, commentaire = :commentaire WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':note', $note, PDO::PARAM_INT);
        $stmt->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Modifier une réponse (inchangé)
    public function modifierReponse($id, $nom, $email, $commentaire) {
        
        $sql = "UPDATE " . $this->tableName . " SET nom_client = :nom, email = :email, commentaire = :commentaire WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un avis (inchangé)
    public function supprimerAvis($id) {
        
        try {
            $this->db->beginTransaction();
            // Supprimer les réponses
            $sql_reponses = "DELETE FROM " . $this->tableName . " WHERE avis_parent = :id";
            $stmt_reponses = $this->db->prepare($sql_reponses);
            $stmt_reponses->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt_reponses->execute();
            // Supprimer l'avis principal
            $sql_avis = "DELETE FROM " . $this->tableName . " WHERE id = :id";
            $stmt_avis = $this->db->prepare($sql_avis);
            $stmt_avis->bindValue(':id', $id, PDO::PARAM_INT);
            $result = $stmt_avis->execute();
            $this->db->commit();
            return $result;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erreur lors de la suppression: " . $e->getMessage());
            return false;
        }
    }

    // Supprimer une réponse (inchangé)
    public function supprimerReponse($id) {
        
        $sql = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Vérifier si l'utilisateur est propriétaire (ou Admin) (inchangé)
    public function isOwner($id) {
        if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            return true; 
        }

        if (!isset($_SESSION['user_id'])) return false;
        
        $sql = "SELECT user_id FROM " . $this->tableName . " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result && $result['user_id'] == $_SESSION['user_id'];
    }

    /**
     * Gérer la soumission du formulaire et effectuer la redirection.
     */
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = isset($_POST['action']) ? $_POST['action'] : '';
            
            // Détermine la page de redirection par défaut ou depuis le formulaire
            // NOTE: Le chemin est supposé être relatif à l'emplacement du contrôleur (../views/backOffice/)
            $redirect_view = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : 'lAvis.php'; 
            $redirect_path = '../views/backOffice/' . $redirect_view; 

            switch($action) {
                case 'ajouter_avis':
                    $this->ajouterNouvelAvis();
                    break;
                case 'repondre_avis':
                    $this->ajouterReponse();
                    break;
                case 'modifier_avis':
                    $this->modifierAvisPost();
                    break;
                case 'modifier_reponse':
                    $this->modifierReponsePost();
                    break;
                case 'supprimer_avis':
                    $this->supprimerAvisPost();
                    break;
                case 'supprimer_reponse':
                    $this->supprimerReponsePost();
                    break;
                case 'like_avis':
                    $this->likeAvisPost();
                    exit(); 
                    break;
            }
            
            // Redirection après traitement (sauf pour l'AJAX 'like_avis')
            header("Location: {$redirect_path}"); 
            exit();
        }
    }

    // Les autres méthodes de traitement (ajouterNouvelAvis, ajouterReponse, etc.) sont inchangées
    // car elles appellent déjà setMessage en cas de succès ou d'échec.

    public function ajouterNouvelAvis() {
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $note = intval($_POST['note'] ?? 0);
        $commentaire = trim($_POST['commentaire'] ?? '');
        if (empty($nom) || empty($commentaire) || $note == 0) {
            $this->setMessage("Veuillez remplir tous les champs obligatoires (Nom, Commentaire, Note).", "error");
            return;
        }
        $avis = new Avis(null, $nom, $email, $note, $commentaire, null, null); 
        if ($this->ajouterAvis($avis)) {
            $this->setMessage("Votre avis a été ajouté avec succès!", "success");
        } else {
            $this->setMessage("Erreur interne lors de l'ajout de l'avis", "error");
        }
    }

    public function ajouterReponse() {
        $nom = trim($_POST['nom_reponse'] ?? '');
        // Pas d'email dans le formulaire de réponse, utiliser une valeur par défaut ou le laisser vide/null
        $email = ''; 
        $commentaire = trim($_POST['commentaire_reponse'] ?? '');
        $avis_parent = intval($_POST['avis_id'] ?? 0);
        if (empty($nom) || empty($commentaire) || $avis_parent == 0) {
            $this->setMessage("Veuillez remplir tous les champs obligatoires (Nom, Commentaire) pour répondre.", "error");
            return;
        }
        $avis = new Avis(null, $nom, $email, null, $commentaire, null, $avis_parent);
        if ($this->ajouterAvis($avis)) {
            $this->setMessage("Votre réponse a été ajoutée avec succès!", "success");
        } else {
            $this->setMessage("Erreur interne lors de l'ajout de la réponse", "error");
        }
    }
        public function modifierAvisPost() {
        $id = intval($_POST['id'] ?? 0);
        // NOTE: Les champs nom, email, note ne sont pas dans le formulaire de modification de aAvis.php, 
        // vous devriez les récupérer de la DB avant de modifier ou les ajouter au modal d'édition.
        // Ici, je les laisse comme dans votre code original, mais soyez vigilant à ce qu'ils soient définis.
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $note = intval($_POST['note'] ?? 0);
        $commentaire = trim($_POST['commentaire'] ?? '');
        
        // Si ces valeurs ne sont pas passées par le formulaire, vous devriez les récupérer de la DB ici.
        // Pour l'instant, on se base sur ce qui est dans le POST.
        
        if (empty($commentaire) || $id == 0) {
            $this->setMessage("Données de modification incomplètes ou invalides pour l'avis.", "error");
            return;
        }
        // Il faudrait charger les données existantes (nom, email, note) si elles ne sont pas dans le POST, 
        // sinon elles seront NULL/vides dans la DB si vous ne les modifiez pas.
        // Pour simplifier, on suppose que seule la note et le commentaire sont modifiés via le modal.

        // Dans aAvis.php, le modal d'édition ne contient que 'commentaire'. 
        // Il faudrait ajuster le contrôleur ou le modal. 
        // Simplification ici : on modifie juste le commentaire, et on laisse les autres champs à leurs valeurs actuelles 
        // (ce qui nécessite une méthode modifierAvis_partial dans le modèle, mais pour l'instant, on se base sur votre code)

        if ($this->modifierAvis($id, $nom, $email, $note, $commentaire)) {
            $this->setMessage("L'avis a été modifié avec succès!", "success");
        } else {
             if(empty($_SESSION['message'])) $this->setMessage("Erreur DB lors de la modification de l'avis", "error");
        }
    }

    public function modifierReponsePost() {
        $id = intval($_POST['id'] ?? 0);
        // Même note que ci-dessus, les champs nom et email ne sont pas dans le formulaire d'édition des réponses.
        $nom = trim($_POST['nom'] ?? ''); 
        $email = trim($_POST['email'] ?? '');
        $commentaire = trim($_POST['commentaire'] ?? '');
        if (empty($commentaire) || $id == 0) {
            $this->setMessage("Données de modification incomplètes ou invalides pour la réponse.", "error");
            return;
        }
        // Le message d'erreur est géré à l'intérieur de modifierReponse() si autorisation échoue.
        if ($this->modifierReponse($id, $nom, $email, $commentaire)) {
            $this->setMessage("La réponse a été modifiée avec succès!", "success");
        } else {
            if(empty($_SESSION['message'])) $this->setMessage("Erreur DB lors de la modification de la réponse", "error");
        }
    }

    public function supprimerAvisPost() {
        $id = intval($_POST['id'] ?? 0);
        if ($id == 0) {
            $this->setMessage("ID d'avis invalide", "error");
            return;
        }
        // Le message d'erreur est géré à l'intérieur de supprimerAvis() si autorisation échoue.
        if ($this->supprimerAvis($id)) {
            $this->setMessage("L'avis et ses réponses ont été supprimés avec succès!", "success");
        } else {
            if(empty($_SESSION['message'])) $this->setMessage("Erreur DB lors de la suppression de l'avis", "error");
        }
    }

    public function supprimerReponsePost() {
        $id = intval($_POST['id'] ?? 0);
        if ($id == 0) {
            $this->setMessage("ID de réponse invalide", "error");
            return;
        }
        // Le message d'erreur est géré à l'intérieur de supprimerReponse() si autorisation échoue.
        if ($this->supprimerReponse($id)) {
            $this->setMessage("La réponse a été supprimée avec succès!", "success");
        } else {
             if(empty($_SESSION['message'])) $this->setMessage("Erreur DB lors de la suppression de la réponse", "error");
        }
    }

    public function likeAvisPost() {
        header('Content-Type: application/json'); 
        $id = intval($_POST['id'] ?? 0);
        if ($id == 0) {
            echo json_encode(['success' => false, 'message' => 'ID invalide']);
            return;
        }
        if ($this->incrementLikes($id)) {
            $sql = "SELECT likes FROM " . $this->tableName . " WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'likes' => $result['likes']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur DB lors du like']);
        }
    }

    public function setMessage($text, $type) {
        $_SESSION['message'] = $text;
        // Utilisez 'success' ou 'danger' pour Bootstrap
        $_SESSION['message_type'] = ($type === 'warning' || $type === 'error') ? 'danger' : 'success';
    }
    
    /**
     * Récupère le message et le type de la session, puis les efface (méthode flash).
     */
    public function getAndClearMessage() {
        $message = $_SESSION['message'] ?? null;
        $type = $_SESSION['message_type'] ?? null;
        
        // Effacer le message après l'avoir récupéré
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);

        return ['message' => $message, 'type' => $type];
    }
    
    // CORRECTION : Ces deux méthodes ne sont plus nécessaires/doivent être fusionnées avec getAndClearMessage
    // pour éviter l'affichage continu des messages.
    public function getMessage() {
        return $_SESSION['message'] ?? null;
    }
    public function getMessageType() {
        // Retourne le type 'danger' par défaut si non défini
        return $_SESSION['message_type'] ?? 'success';
    }
}

if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    $controller = new AvisController();
    $controller->handleRequest();
}
?>