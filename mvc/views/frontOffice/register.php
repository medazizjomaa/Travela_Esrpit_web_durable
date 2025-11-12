<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inscription - Travela</title>
   
  <link rel="stylesheet" href="/travela/mvc/views/frontOffice/css/styleAuth.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h2>Créer un compte</h2>
        <p>Rejoignez la communauté Travela</p>
      </div>

      <!-- Messages d'erreur ou succès -->
      <?php
        if(isset($_SESSION['error'])){
            echo "<div class='alert alert-error'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
            echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
            unset($_SESSION['success']);
        }
      ?>

      <form class="auth-form" id="registerForm" action="/travela/mvc/controllers/ClientController.php" method="POST" novalidate>
        <input type="hidden" name="action" value="register">
        
        <div class="form-group">
          <div class="input-wrapper">
            <input type="text" id="nom" name="nom" required autocomplete="given-name" 
                   placeholder=" " value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>"/>
            <label for="nom">Nom</label>
          </div>
          <span class="error-message" id="nomError"></span>
        </div>

        <div class="form-group">
          <div class="input-wrapper">
            <input type="text" id="prenom" name="prenom" required autocomplete="family-name" 
                   placeholder=" " value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>"/>
            <label for="prenom">Prénom</label>
          </div>
          <span class="error-message" id="prenomError"></span>
        </div>

        <div class="form-group">
          <div class="input-wrapper">
            <input type="email" id="email" name="email" required autocomplete="email" 
                   placeholder=" " value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"/>
            <label for="email">Adresse e-mail</label>
          </div>
          <span class="error-message" id="emailError"></span>
        </div>

        <div class="form-group">
          <div class="input-wrapper password-wrapper">
            <input type="password" id="password" name="password" required autocomplete="new-password" placeholder=" "/>
            <label for="password">Mot de passe</label>
            <button type="button" class="password-toggle" id="passwordToggle">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <span class="error-message" id="passwordError"></span>
        </div>

        <div class="form-group">
          <div class="input-wrapper password-wrapper">
            <input type="password" id="confirmPassword" name="confirmPassword" required autocomplete="new-password" placeholder=" "/>
            <label for="confirmPassword">Confirmez le mot de passe</label>
            <button type="button" class="password-toggle" id="confirmPasswordToggle">
              <i class="fas fa-eye"></i>
            </button>
          </div>
          <span class="error-message" id="confirmPasswordError"></span>
        </div>

        <button type="submit" class="auth-btn">
          <span class="btn-text">S'inscrire</span>
        </button>
      </form>

      <div class="divider">
        <span>ou inscrivez-vous avec</span>
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
        <p>Vous avez déjà un compte ? <a href="/travela/mvc/views/frontOffice/login_client.php">Se connecter</a></p>
      </div>
    </div>
  </div>

  <script src="/travela/mvc/views/shared/js/form-utils.js"></script>
</body>
</html>