<?php
session_start();
$logoutMessage = $_GET['message'] ?? '';

// Afficher les messages d'erreur
if(isset($_SESSION['error'])){
    echo "<div class='alert alert-error'>".$_SESSION['error']."</div>";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Travela</title>
    <link rel="stylesheet" href="/travela/mvc/views/frontOffice/css/styleAuth.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Bienvenue</h2>
                <p>Connectez-vous à votre compte Travela</p>
            </div>

            <!-- Message de déconnexion réussi -->
            <?php if ($logoutMessage === 'deconnexion_reussie'): ?>
                <div class="alert alert-success">
                    Déconnexion effectuée avec succès !
                </div>
            <?php endif; ?>

            <form class="auth-form" id="loginForm" action="/travela/mvc/controllers/ClientController.php" method="POST" novalidate>
                <input type="hidden" name="action" value="login">
                
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="email" id="mailclient" name="mailclient" required autocomplete="email" 
                               placeholder=" " value="<?php echo isset($_POST['mailclient']) ? htmlspecialchars($_POST['mailclient']) : ''; ?>">
                        <label for="mailclient">Adresse e-mail</label>
                    </div>
                    <span class="error-message" id="emailError"></span>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="motdepasse" name="motdepasse" required autocomplete="current-password" placeholder=" ">
                        <label for="motdepasse">Mot de passe</label>
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <div class="form-options">
                    <label class="remember-wrapper">
                        <input type="checkbox" id="remember" name="remember">
                        <span>Se souvenir de moi</span>
                    </label>
                    <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="auth-btn">
                    <span class="btn-text">Se connecter</span>
                </button>
            </form>

            <div class="divider">
                <span>ou continuer avec</span>
            </div>

            <div class="social-login">
                <button type="button" class="social-btn google-btn">
                    <i class="fab fa-google" style="color: #DB4437;"></i>
                    Google
                </button>
                <button type="button" class="social-btn github-btn">
                    <i class="fab fa-github" style="color: #333;"></i>
                    GitHub
                </button>
            </div>

            <div class="auth-link">
                <p>Vous n'avez pas de compte ? <a href="/travela/mvc/views/frontOffice/register.php">Inscrivez-vous</a></p>
            </div>

            <div class="admin-link">
                <a href="/travela/mvc/views/backOffice/login_admin.php" class="admin-btn">
                    <i class="fas fa-user-shield"></i>
                    Accès Administrateur
                </a>
            </div>
        </div>
    </div>

    <script>
        // Script pour toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('motdepasse');
            
            if (passwordToggle && passwordInput) {
                passwordToggle.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
        });
    </script>
</body>
</html>