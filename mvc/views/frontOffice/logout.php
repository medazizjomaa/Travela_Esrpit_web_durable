<?php
session_start();

// Vérifier si la confirmation a été envoyée
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['confirm_logout'])) {
    // Détruire toutes les données de session
    $_SESSION = array();

    // Supprimer le cookie de session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(), 
            '', 
            time() - 42000,
            $params["path"], 
            $params["domain"], 
            $params["secure"], 
            $params["httponly"]
        );
    }

    // Détruire la session
    session_destroy();

    // Rediriger vers la page de connexion avec un message de succès
    header("Location: /travela/mvc/views/frontOffice/login_client.php?message=deconnexion_reussie");
    exit();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idclient'])) {
    header("Location: /travela/mvc/views/frontOffice/login_client.php");
    exit();
}

// Récupérer les informations de l'utilisateur pour affichage
$nomClient = $_SESSION['nomclient'] ?? '';
$prenomClient = $_SESSION['prenomclient'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travela - Confirmation de déconnexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .logout-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            margin: 20px;
        }
        .logout-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .logout-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        .logout-body {
            padding: 40px 30px;
            text-align: center;
        }
        .user-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 25px;
        }
        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
        }
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            border: none;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-header">
            <div class="logout-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <h2>Déconnexion</h2>
        </div>
        
        <div class="logout-body">
            <div class="user-info">
                <h5>Compte connecté :</h5>
                <p class="mb-1"><strong><?php echo htmlspecialchars($prenomClient . ' ' . $nomClient); ?></strong></p>
                <small class="text-muted">ID: #<?php echo htmlspecialchars($_SESSION['idclient'] ?? ''); ?></small>
            </div>
            
            <h4 class="text-danger mb-4">
                <i class="fas fa-exclamation-circle me-2"></i>
                Êtes-vous sûr de vouloir vous déconnecter ?
            </h4>
            
            <p class="text-muted mb-4">
                Vous serez redirigé vers la page de connexion. Pour accéder à nouveau à votre compte, 
                vous devrez vous reconnecter avec votre email et mot de passe.
            </p>
            
            <form method="POST" class="mb-3">
                <div class="btn-group">
                    <a href="/travela/mvc/views/frontOffice/profil.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Annuler
                    </a>
                    <button type="submit" name="confirm_logout" value="1" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt me-2"></i>Oui, me déconnecter
                    </button>
                </div>
            </form>
            
            <small class="text-muted">
                <i class="fas fa-info-circle me-1"></i>
                Vous pouvez vous reconnecter à tout moment.
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>