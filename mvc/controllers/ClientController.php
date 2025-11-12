<?php
session_start();
// Correction des chemins - ajustez selon votre structure réelle
require_once(__DIR__ . "/../DBConnection.php");
require_once(__DIR__ . "/../models/Client.php");

class UnifiedClientController {
    private $db;

     public function __construct() {
        try {
            $DBConnection = new DBConnection();
            $this->db = $DBConnection->getConnection();

            if (!$this->db) {
                throw new Exception("Impossible de se connecter à la base de données");
            }
        } catch (Exception $e) {
            error_log("Erreur constructeur ClientController: " . $e->getMessage());
            $_SESSION['error'] = "Erreur de connexion à la base de données";
            header("Location: /travela/mvc/views/frontOffice/login_client.php");
            exit();
        }
    }
    // ... à ajouter dans la classe UnifiedClientController

// 🔹 Récupérer tous les clients (pour la liste admin)
    public function getAllClients() {
        $query = "SELECT idclient, nomclient, prenomclient, mailclient FROM client";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// 🔹 Mettre à jour un client (pour le Back-Office)
    public function updateClientAdmin($idclient, $nomclient, $prenomclient, $mailclient)
    {
    $query = "UPDATE client SET nomclient = :nom, prenomclient = :prenom, mailclient = :email WHERE idclient = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $idclient);
    $stmt->bindParam(':nom', $nomclient);
    $stmt->bindParam(':prenom', $prenomclient);
    $stmt->bindParam(':email', $mailclient);
    return $stmt->execute();
    }

// 🔹 Supprimer un client (pour le Back-Office)
    public function deleteClientAdmin($idclient)
    {
    $stmt = $this->db->prepare("DELETE FROM client WHERE idclient = :id");
    $stmt->bindParam(':id', $idclient);
    return $stmt->execute();
    }
    // Inscription client
    public function inscrireClient() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'register') {
            $nom = isset($_POST["nom"]) ? trim(htmlspecialchars($_POST["nom"])) : "";
            $prenom = isset($_POST["prenom"]) ? trim(htmlspecialchars($_POST["prenom"])) : "";
            $email = isset($_POST["email"]) ? trim(htmlspecialchars($_POST["email"])) : "";
            $pass = isset($_POST["password"]) ? trim($_POST["password"]) : "";
            $confirmPass = isset($_POST["confirmPassword"]) ? trim($_POST["confirmPassword"]) : "";

            if (empty($nom) || empty($prenom) || empty($email) || empty($pass) || empty($confirmPass)) {
                $_SESSION['error'] = "⚠️ Tous les champs sont obligatoires.";
                header("Location: /travela/mvc/views/frontOffice/register.php");
                exit();
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "⚠️ L'adresse email n'est pas valide.";
                header("Location: /travela/mvc/views/frontOffice/register.php");
                exit();
            } elseif ($pass !== $confirmPass) {
                $_SESSION['error'] = "⚠️ Les mots de passe ne correspondent pas.";
                header("Location: /travela/mvc/views/frontOffice/register.php");
                exit();
            } else {
                // 🔹 Password complexity check
                $pattern = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[,;:!:'&_]).{8,}$/";
                if (!preg_match($pattern, $pass)) {
                    $_SESSION['error'] = "⚠️ Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial (, ; : ! : ' &_).";
                    header("Location: /travela/mvc/views/frontOffice/register.php");
                    exit();
                }

                try {
                    $query = "SELECT * FROM client WHERE mailclient = :email";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':email', $email);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        $_SESSION['error'] = "⚠️ Cet email est déjà utilisé.";
                        header("Location: /travela/mvc/views/frontOffice/register.php");
                        exit();
                    }

                    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

                    $query = "INSERT INTO client (nomclient, prenomclient, mailclient, motdepasse)
                              VALUES (:nom, :prenom, :email, :motdepasse)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':nom', $nom);
                    $stmt->bindParam(':prenom', $prenom);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':motdepasse', $hashedPassword);

                    if ($stmt->execute()) {
                        $_SESSION['success'] = "✅ Compte créé avec succès ! Vous pouvez vous connecter.";
                        header("Location: /travela/mvc/views/frontOffice/register.php");
                        exit();
                    } else {
                        $_SESSION['error'] = "⚠️ Erreur lors de la création du compte.";
                        header("Location: /travela/mvc/views/frontOffice/register.php");
                        exit();
                    }
                } catch (Exception $e) {
                    error_log("Erreur inscription: " . $e->getMessage());
                    $_SESSION['error'] = "Erreur lors de la création du compte.";
                    header("Location: /travela/mvc/views/frontOffice/register.php");
                    exit();
                }
            }
        }
    }

    // Connexion client
    public function connecterClient() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'login') {
            $email = isset($_POST['mailclient']) ? trim(htmlspecialchars($_POST['mailclient'])) : '';
            $motdepasse = isset($_POST['motdepasse']) ? trim($_POST['motdepasse']) : '';

            if (empty($email) || empty($motdepasse)) {
                $_SESSION['error'] = "Veuillez remplir tous les champs.";
                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Format d'email invalide.";
                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                exit();
            }

            try {
                $query = "SELECT * FROM client WHERE mailclient = :email";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                if ($stmt->rowCount() === 1) {
                    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Vérifier le mot de passe hashé
                    if (password_verify($motdepasse, $clientData['motdepasse'])) {
                        session_regenerate_id(true);
                        
                        $_SESSION['idclient'] = $clientData['idclient'];
                        $_SESSION['nomclient'] = htmlspecialchars($clientData['nomclient']);
                        $_SESSION['prenomclient'] = htmlspecialchars($clientData['prenomclient']);
                        $_SESSION['mailclient'] = htmlspecialchars($clientData['mailclient']);
                        $_SESSION['connecte'] = true;

                        // Rediriger vers la page de confirmation de connexion
                        header("Location: /travela/mvc/views/frontOffice/index.php");
                        exit();
                    }
                }
                
                $_SESSION['error'] = "Email ou mot de passe incorrect.";
                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                exit();
                
            } catch (Exception $e) {
                error_log("Erreur connexion: " . $e->getMessage());
                $_SESSION['error'] = "Erreur lors de la connexion.";
                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                exit();
            }
        }
    }

    // Mise à jour du profil
    public function mettreAJourProfil() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_profile') {
            // Vérifier si l'utilisateur est connecté
            if (!isset($_SESSION['idclient'])) {
                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                exit();
            }

            $idclient = $_POST['idclient'] ?? '';
            $nomclient = $_POST['nomclient'] ?? '';
            $prenomclient = $_POST['prenomclient'] ?? '';
            $mailclient = $_POST['mailclient'] ?? '';

            // Valider les données
            if (empty($nomclient) || empty($prenomclient) || empty($mailclient)) {
                $_SESSION['error'] = "Tous les champs sont obligatoires.";
                header("Location: /travela/mvc/views/frontOffice/profil.php");
                exit();
            } elseif (!filter_var($mailclient, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Format d'email invalide.";
                header("Location: /travela/mvc/views/frontOffice/profil.php");
                exit();
            } else {
                try {
                    // Vérifier si l'email existe déjà pour un autre utilisateur
                    $queryCheck = "SELECT idclient FROM client WHERE mailclient = :email AND idclient != :id";
                    $stmtCheck = $this->db->prepare($queryCheck);
                    $stmtCheck->bindParam(':email', $mailclient);
                    $stmtCheck->bindParam(':id', $idclient);
                    $stmtCheck->execute();

                    if ($stmtCheck->rowCount() > 0) {
                        $_SESSION['error'] = "Cet email est déjà utilisé par un autre compte.";
                        header("Location: /travela/mvc/views/frontOffice/profil.php");
                        exit();
                    }

                    // Mise à jour dans la base de données
                    $query = "UPDATE client SET nomclient = :nom, prenomclient = :prenom, mailclient = :email WHERE idclient = :id";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':nom', $nomclient);
                    $stmt->bindParam(':prenom', $prenomclient);
                    $stmt->bindParam(':email', $mailclient);
                    $stmt->bindParam(':id', $idclient);

                    if ($stmt->execute()) {
                        // Mettre à jour les données dans la session
                        $_SESSION['mailclient'] = $mailclient;
                        $_SESSION['nomclient'] = $nomclient;
                        $_SESSION['prenomclient'] = $prenomclient;
                        $_SESSION['success'] = "Profil mis à jour avec succès !";
                    } else {
                        $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
                    }
                } catch (Exception $e) {
                    error_log("Erreur mise à jour profil: " . $e->getMessage());
                    $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
                }
                
                header("Location: /travela/mvc/views/frontOffice/profil.php");
                exit();
            }
        }
    }

    // Changement de mot de passe
    public function changerMotDePasse() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
            if (!isset($_SESSION['idclient'])) {
                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                exit();
            }

            $idclient = $_POST['idclient'] ?? '';
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['error'] = "Tous les champs du mot de passe sont obligatoires.";
                header("Location: /travela/mvc/views/frontOffice/profil.php");
                exit();
            } elseif ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Les nouveaux mots de passe ne correspondent pas.";
                header("Location: /travela/mvc/views/frontOffice/profil.php");
                exit();
            } else {
                // 🔹 Password complexity check
                $pattern = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[,;:!:'&_]).{8,}$/";
                if (!preg_match($pattern, $newPassword)) {
                    $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial (, ; : ! : ' &_).";
                    header("Location: /travela/mvc/views/frontOffice/profil.php");
                    exit();
                }

                try {
                    $query = "SELECT motdepasse FROM client WHERE idclient = :id";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':id', $idclient);
                    $stmt->execute();

                    if ($stmt->rowCount() === 1) {
                        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
                        $hashedCurrentPassword = $clientData['motdepasse'];

                        if (password_verify($currentPassword, $hashedCurrentPassword)) {
                            if (password_verify($newPassword, $hashedCurrentPassword)) {
                                $_SESSION['error'] = "Le nouveau mot de passe doit être différent de l'actuel.";
                                header("Location: /travela/mvc/views/frontOffice/profil.php");
                                exit();
                            }

                            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                            $updateQuery = "UPDATE client SET motdepasse = :new_password WHERE idclient = :id";
                            $updateStmt = $this->db->prepare($updateQuery);
                            $updateStmt->bindParam(':new_password', $hashedNewPassword);
                            $updateStmt->bindParam(':id', $idclient);

                            if ($updateStmt->execute()) {
                                $_SESSION['success'] = "Mot de passe modifié avec succès !";
                            } else {
                                $_SESSION['error'] = "Erreur lors de la mise à jour du mot de passe.";
                            }
                        } else {
                            $_SESSION['error'] = "Le mot de passe actuel est incorrect.";
                        }
                    } else {
                        $_SESSION['error'] = "Utilisateur non trouvé.";
                    }
                } catch (Exception $e) {
                    error_log("Erreur changement mot de passe: " . $e->getMessage());
                    $_SESSION['error'] = "Erreur lors du changement de mot de passe.";
                }
                
                header("Location: /travela/mvc/views/frontOffice/profil.php");
                exit();
            }
        }
    }

    // Suppression du compte client
    public function supprimerCompte() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_account') {
            // Vérifier si l'utilisateur est connecté
            if (!isset($_SESSION['idclient'])) {
                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                exit();
            }

            $idclient = $_POST['idclient'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            // Validation des données
            if (empty($idclient) || empty($confirmPassword)) {
                $_SESSION['error'] = "Veuillez confirmer votre mot de passe.";
                header("Location: /travela/mvc/views/frontOffice/profil.php");
                exit();
            } else {
                try {
                    // Récupérer le mot de passe hashé depuis la base de données
                    $query = "SELECT motdepasse FROM client WHERE idclient = :id";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':id', $idclient);
                    $stmt->execute();

                    if ($stmt->rowCount() === 1) {
                        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
                        $hashedPassword = $clientData['motdepasse'];

                        // Vérifier si le mot de passe est correct
                        if (password_verify($confirmPassword, $hashedPassword)) {
                            // Supprimer le compte de la base de données
                            $deleteQuery = "DELETE FROM client WHERE idclient = :id";
                            $deleteStmt = $this->db->prepare($deleteQuery);
                            $deleteStmt->bindParam(':id', $idclient);

                            if ($deleteStmt->execute()) {
                                // Déconnexion et destruction de la session
                                $_SESSION = array();
                                
                                if (ini_get("session.use_cookies")) {
                                    $params = session_get_cookie_params();
                                    setcookie(session_name(), '', time() - 42000,
                                        $params["path"], $params["domain"],
                                        $params["secure"], $params["httponly"]
                                    );
                                }
                                
                                session_destroy();
                                $_SESSION['success'] = "Votre compte a été supprimé avec succès. Nous espérons vous revoir bientôt !";
                                header("Location: /travela/mvc/views/frontOffice/login_client.php");
                                exit();
                            } else {
                                $_SESSION['error'] = "Erreur lors de la suppression du compte.";
                                header("Location: /travela/mvc/views/frontOffice/profil.php");
                                exit();
                            }
                        } else {
                            $_SESSION['error'] = "Mot de passe incorrect. La suppression du compte a échoué.";
                            header("Location: /travela/mvc/views/frontOffice/profil.php");
                            exit();
                        }
                    } else {
                        $_SESSION['error'] = "Utilisateur non trouvé.";
                        header("Location: /travela/mvc/views/frontOffice/profil.php");
                        exit();
                    }
                } catch (Exception $e) {
                    error_log("Erreur suppression compte: " . $e->getMessage());
                    $_SESSION['error'] = "Erreur lors de la suppression du compte.";
                    header("Location: /travela/mvc/views/frontOffice/profil.php");
                    exit();
                }
            }
        }
    }

    // Méthode principale pour router les requêtes
    public function handleRequest() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'register': $this->inscrireClient(); break;
                case 'login': $this->connecterClient(); break;
                case 'update_profile': $this->mettreAJourProfil(); break;
                case 'change_password': $this->changerMotDePasse(); break;
                case 'delete_account': $this->supprimerCompte(); break;
                
            }
        }
    }

    // 🔹 Méthode pour ajouter via formulaire (inscription)
    public function addFromForm($data) {
    // Simule l'inscription sans session
    $nom = $data['nomclient'];
    $prenom = $data['prenomclient'];
    $email = $data['mailclient'];
    $pass = password_hash($data['motdepasse'], PASSWORD_DEFAULT);
    $query = "INSERT INTO client (nomclient, prenomclient, mailclient, motdepasse) VALUES (:nom, :prenom, :email, :pass)";
    $stmt = $this->db->prepare(query: $query);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass);
    return $stmt->execute();
}

// 🔹 Méthode pour mettre à jour via formulaire
}   

// Traitement des requêtes
try {
    $controller = new UnifiedClientController();
    $controller->handleRequest();
    } catch (Exception $e) {
    error_log("Erreur ClientController: " . $e->getMessage());
    $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
    header("Location: /travela/mvc/views/frontOffice/login_client.php");
    exit();
}
// ... Remplacement du bloc de traitement des requêtes à la fin du fichier

// Traitement des requêtes
try {
    $controller = new UnifiedClientController();

    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'delete' && isset($_GET['id'])) {
            if ($controller->deleteClientAdmin($_GET['id'])) {
                echo "<script>alert('✅ Client supprimé !'); window.location='../views/backOffice/lClnt.php';</script>";
            } else {
                echo "<script>alert('❌ Erreur lors de la suppression.'); window.location='../views/backOffice/lClnt.php';</script>";
            }
        } elseif ($_GET['action'] === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $idclient = $_POST['idclient'];
            $nomclient = $_POST['nomclient'];
            $prenomclient = $_POST['prenomclient'];
            $mailclient = $_POST['mailclient'];

            if ($controller->updateClientAdmin($idclient, $nomclient, $prenomclient, $mailclient)) {
                echo "<script>alert('✅ Client mis à jour !'); window.location='../views/backOffice/lClnt.php';</script>";
            } else {
                echo "<script>alert('❌ Erreur lors de la mise à jour.'); window.location='../views/backOffice/lClnt.php';</script>";
            }
        }
    }

    $controller->handleRequest();
} catch (Exception $e) {
    error_log("Erreur ClientController: " . $e->getMessage());
    $_SESSION['error'] = "Une erreur est survenue. Veuillez réessayer.";
    exit();
}
?>