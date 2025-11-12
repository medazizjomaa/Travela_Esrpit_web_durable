<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idclient'])) {
    header("Location: /travela/mvc/views/frontOffice/login_client.php");
    exit();
}

// Récupérer les informations de l'utilisateur
$nomClient = $_SESSION['nomclient'] ?? '';
$prenomClient = $_SESSION['prenomclient'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Réussie - Travela</title>
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
        .success-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            margin: 20px;
            text-align: center;
        }
        .success-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 40px 30px;
        }
        .success-icon {
            font-size: 5rem;
            margin-bottom: 20px;
            animation: bounce 1s ease-in-out;
        }
        .success-body {
            padding: 40px 30px;
        }
        .user-welcome {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
        }
        .welcome-text {
            font-size: 1.5rem;
            font-weight: 600;
            color: #28a745;
            margin-bottom: 10px;
        }
        .user-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        .countdown {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 15px;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-header">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Connexion Réussie !</h2>
            <p class="mb-0">Bienvenue dans votre espace personnel</p>
        </div>
        
        <div class="success-body">
            <div class="user-welcome">
                <div class="welcome-text">Heureux de vous revoir</div>
                <div class="user-name"><?php echo htmlspecialchars($prenomClient . ' ' . $nomClient); ?></div>
                <div class="text-muted">
                    <i class="fas fa-envelope me-2"></i>
                    <?php echo htmlspecialchars($_SESSION['mailclient'] ?? ''); ?>
                </div>
            </div>
            
            <p class="text-muted mb-4">
                Votre connexion a été établie avec succès. Vous avez maintenant accès à toutes les fonctionnalités 
                de votre compte Travela.
            </p>
            
            <div class="d-grid gap-3">
                <a href="/travela/mvc/views/frontOffice/profil.php" class="btn btn-success pulse">
                    <i class="fas fa-user-circle me-2"></i>
                    Accéder à mon profil
                </a>
                
                <a href="/travela/mvc/views/frontOffice/destination.html" class="btn btn-outline-success">
                    <i class="fas fa-map-marked-alt me-2"></i>
                    Explorer les destinations
                </a>
            </div>
            
            <div class="countdown">
                <i class="fas fa-clock me-1"></i>
                Redirection automatique vers votre profil dans <span id="countdown">5</span> secondes...
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Compte à rebours pour la redirection automatique
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        
        const timer = setInterval(function() {
            countdown--;
            countdownElement.textContent = countdown;
            
            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = '/travela/mvc/views/frontOffice/profil.php';
            }
        }, 1000);

        // Optionnel : Permettre à l'utilisateur d'annuler la redirection automatique
        document.addEventListener('click', function() {
            clearInterval(timer);
            countdownElement.textContent = 'redirection annulée';
            countdownElement.style.color = '#dc3545';
        });
    </script>
</body>
</html>