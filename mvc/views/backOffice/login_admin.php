<?php
session_start();

// CORRECTION : Affichage amélioré des messages d'erreur
if(isset($_SESSION['error'])){
    echo "<div class='alert alert-error'>".$_SESSION['error']."</div>";
    unset($_SESSION['error']);
}

// CORRECTION : Affichage des messages de succès
if(isset($_SESSION['success'])){
    echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur - Travela</title>
    <!-- Utiliser le même CSS que login client -->
    <link rel="stylesheet" href="/travela/mvc/views/frontOffice/css/styleAuth.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        .admin-warning {
            text-align: center;
            margin-bottom: 20px;
            padding: 12px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            color: #5a6fd8;
            text-decoration: underline;
            transform: translateX(-5px);
        }
        
        /* Assurer que les labels fonctionnent avec placeholder=" " */
        .input-wrapper input:focus + label,
        .input-wrapper input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 14px;
            color: #667eea;
            font-weight: 600;
        }
        
        .input-wrapper input:placeholder-shown + label {
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #a0aec0;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Administration</h2>
                <p>Accès réservé aux administrateurs</p>
            </div>

            <div class="admin-warning">
                <i class="fas fa-shield-alt"></i>
                Zone sécurisée - Accès restreint
            </div>

            <form class="auth-form" id="adminLoginForm" action="/travela/mvc/controllers/AdminController.php" method="POST" novalidate>
                <input type="hidden" name="action" value="login_admin">
                
                <div class="form-group">
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" required autocomplete="username" 
                               placeholder=" " value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        <label for="username">Nom d'utilisateur</label>
                    </div>
                    <span class="error-message" id="usernameError"></span>
                </div>

                <div class="form-group">
                    <div class="input-wrapper password-wrapper">
                        <input type="password" id="password" name="password" required autocomplete="current-password" placeholder=" ">
                        <label for="password">Mot de passe</label>
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="error-message" id="passwordError"></span>
                </div>

                <button type="submit" class="auth-btn">
                    <span class="btn-text">Connexion Admin</span>
                </button>
            </form>

            <div class="back-link">
                <a href="/travela/mvc/views/frontOffice/login_client.php">
                    <i class="fas fa-arrow-left"></i>
                    Retour à la connexion client
                </a>
            </div>
        </div>
    </div>

    <script>
        // Script pour toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const passwordToggle = document.getElementById('passwordToggle');
            const passwordInput = document.getElementById('password');
            
            if (passwordToggle && passwordInput) {
                passwordToggle.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
            
            // Gestion des labels avec placeholder
            const inputs = document.querySelectorAll('.input-wrapper input');
            inputs.forEach(input => {
                // Vérifier si le champ a une valeur au chargement
                if (input.value.trim() !== '') {
                    input.setAttribute('data-filled', 'true');
                }
                
                input.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        this.setAttribute('data-filled', 'true');
                    } else {
                        this.removeAttribute('data-filled');
                    }
                });
                
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });
            });
        });
    </script>
</body>
</html>