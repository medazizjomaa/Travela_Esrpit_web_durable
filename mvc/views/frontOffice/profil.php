<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idclient'])) {
    header("Location: /travela/mvc/views/frontOffice/login_client.php");
    exit();
}

// Afficher les messages
if(isset($_SESSION['error'])){
    echo "<div class='alert alert-error'>".$_SESSION['error']."</div>";
    unset($_SESSION['error']);
}
if(isset($_SESSION['success'])){
    echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
    unset($_SESSION['success']);
}

// Récupérer les données du client depuis la session
$nomClient = $_SESSION['nomclient'] ?? '';
$prenomClient = $_SESSION['prenomclient'] ?? '';
$emailClient = $_SESSION['mailclient'] ?? '';
$idClient = $_SESSION['idclient'] ?? '';

// Date d'inscription
$dateInscription = date('d/m/Y');

// Vérifier si on affiche la page de confirmation de suppression
$showDeleteConfirmation = isset($_GET['confirm_delete']) && $_GET['confirm_delete'] === 'true';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Travela - Mon Profil</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="/travela/mvc/views/frontOffice/lib/owlcarousel/assets1/owl.carousel.min.css" rel="stylesheet">
  <link href="/travela/mvc/views/frontOffice/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link href="/travela/mvc/views/frontOffice/css/bootstrap.min.css" rel="stylesheet">
  <link href="/travela/mvc/views/frontOffice/css/style.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<script>
document.getElementById("open-chatbot-btn").addEventListener("click", function() {
  window.location.href = "chatbot.php"; // 🔹 redirige vers chatbot.php
});
</script>


<body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        
         <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Travela</h1>
                    <!-- <img src="/travela/mvc/views/frontOffice/img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                         <a href="/travela/mvc/views/frontOffice/index.php" class="nav-item nav-link ">Acceuil</a>
                        <a href="/travela/mvc/views/frontOffice/DestRes.php" class="nav-item nav-link">Destination & Reservation</a>
                        <a href="/travela/mvc/views/frontOffice/blog.php" class="nav-item nav-link">Activites & Evenements</a>
                        <a href=" /travela/mvc/views/frontOffice/impactEco.php" class="nav-item nav-link ">Impact Ecologique</a>
                        <a href="/travela/mvc/views/frontOffice/testimonial.php" class="nav-item nav-link">Avis</a>
                        <a href="/travela/mvc/views/frontOffice/profil.php" class="nav-item nav-link active">Mon Profil</a>
                    <a href="login_client.php" class="nav-item nav-link text-danger">Déconnexion</a>
                         
                    </div>
                </div>
            </nav>
    <!-- Suppression du header : Layout commence directement avec le contenu pour plus d'espace et de simplicité -->
  </div>

  <!-- Page de confirmation de suppression -->
  <?php if ($showDeleteConfirmation): ?>
  <div class="delete-confirmation-page">
    <div class="delete-confirmation-content">
      <div class="delete-confirmation-header">
        <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
        <h3>Confirmation de Suppression</h3>
      </div>
      <div class="delete-confirmation-body">
        <div class="text-center mb-4">
          <h4 class="text-danger mb-3">Êtes-vous absolument sûr ?</h4>
          <p class="text-muted">
            Cette action ne peut pas être annulée. Toutes vos données seront <strong>définitivement supprimées</strong>.
            Vous perdrez l'accès à votre compte et à toutes vos réservations.
          </p>
        </div>
        
                <form id="deleteAccountForm" action="/travela/mvc/controllers/ClientController.php" method="POST">
          <input type="hidden" name="action" value="delete_account">
          <input type="hidden" name="idclient" value="<?php echo htmlspecialchars($idClient); ?>">
          
          <div class="mb-3">
            <label for="confirm_password_page" class="form-label fw-bold">
              Veuillez confirmer votre mot de passe pour continuer :
            </label>
            <div class="password-field">
              <input type="password" class="form-control" id="confirm_password_page" 
                     name="confirm_password" required placeholder="Entrez votre mot de passe actuel">
              <button type="button" class="password-toggle" onclick="togglePassword('confirm_password_page')">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
          
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="confirmDeletePage" required>
            <label class="form-check-label" for="confirmDeletePage">
              Je comprends que cette action est irréversible et je souhaite supprimer définitivement mon compte.
            </label>
          </div>
        </form>
      </div>
      <div class="delete-confirmation-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeDeleteConfirmation()">
          <i class="fas fa-times me-2"></i>Annuler
        </button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtnPage" onclick="submitDeleteForm()" disabled>
          <i class="fas fa-trash-alt me-2"></i>Supprimer mon compte
        </button>
      </div>
    </div>
  </div>
  <?php endif; ?>
<div class="container-fluid bg-pro">
            <div class="container text-center py-5" style="max-width: 900px;">
                
                <h3 class="text-white display-3 mb-4"><i class="fas fa-user me-2"></i>   Bienvenue, <?php echo htmlspecialchars($prenomClient . ' ' . $nomClient); ?> !</h1>
                 
            </div>
        </div>

  <!-- Contenu du profil organisé avec plus d'espace -->
  <div class="profile-container">
    <!-- Première ligne : Informations personnelles à droite de Modifier mes Informations -->
    <div class="profile-top-row">
      <!-- Modification du profil -->
      <div class="main-content">
        <div class="profile-card bg-white p-4">
          <h4 class="section-title">
            <i class="fas fa-edit me-2"></i>Modifier mes Informations
          </h4>
          <form id="profileForm" action="/travela/mvc/controllers/ClientController.php" method="POST">
            <input type="hidden" name="action" value="update_profile">
            <input type="hidden" name="idclient" value="<?php echo htmlspecialchars($idClient); ?>">
            
            <div class="form-grid">
              <div class="form-group">
                <label for="nom" class="form-label text-muted">Nom</label>
                <input type="text" class="form-control" id="nom" name="nomclient"
                       value="<?php echo htmlspecialchars($nomClient); ?>" required>
              </div>
              
              <div class="form-group">
                <label for="prenom" class="form-label text-muted">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenomclient"
                       value="<?php echo htmlspecialchars($prenomClient); ?>" required>
              </div>
              
              <div class="form-group form-full-width">
                <label for="email" class="form-label text-muted">Adresse Email</label>
                <input type="email" class="form-control" id="email" name="mailclient"
                       value="<?php echo htmlspecialchars($emailClient); ?>" required>
              </div>
            </div>
            
            <div class="button-group">
              <button type="button" class="btn btn-secondary" onclick="resetForm()">
                <i class="fas fa-times me-2"></i>Annuler
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Enregistrer
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Sidebar avec informations essentielles pour le tourisme économique -->
      <div class="sidebar">
        <!-- Informations personnelles -->
        <div class="profile-card bg-white p-4">
          <h4 class="section-title">
            <i class="fas fa-id-card me-2"></i>Infos Personnelles
          </h4>
          <div class="info-grid">
            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-user"></i>
              </div>
              <div>
                <small class="text-muted">Nom Complet</small>
                <div class="fw-bold"><?php echo htmlspecialchars($prenomClient . ' ' . $nomClient); ?></div>
              </div>
            </div>
            
            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-envelope"></i>
              </div>
              <div>
                <small class="text-muted">Email</small>
                <div class="fw-bold"><?php echo htmlspecialchars($emailClient); ?></div>
              </div>
            </div>
            
            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-id-badge"></i>
              </div>
              <div>
                <small class="text-muted">ID Client</small>
                <div class="fw-bold">#<?php echo htmlspecialchars($idClient); ?></div>
              </div>
            </div>
            
            <div class="info-item">
              <div class="info-icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <div>
                <small class="text-muted">Membre depuis</small>
                <div class="fw-bold"><?php echo htmlspecialchars($dateInscription); ?></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Deuxième ligne : Sécurité du compte à côté de Mes Économies & Voyages -->
    <div class="profile-bottom-row">
      <!-- Section sécurité -->
      <div class="main-content">
        <div class="profile-card bg-white p-4">
          <h4 class="section-title">
            <i class="fas fa-shield-alt me-2"></i>Sécurité du Compte
          </h4>
          <form id="passwordForm" action="/travela/mvc/controllers/ClientController.php" method="POST">
            <input type="hidden" name="action" value="change_password">
            <input type="hidden" name="idclient" value="<?php echo htmlspecialchars($idClient); ?>">
            
            <div class="security-grid">
              <div class="form-group">
                <label for="current_password" class="form-label text-muted">Mot de passe actuel</label>
                <div class="password-field">
                  <input type="password" class="form-control" id="current_password" 
                         name="current_password" required>
                  <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </div>
              
              <div class="password-row">
                <div class="form-group">
                  <label for="new_password" class="form-label text-muted">Nouveau mot de passe</label>
                  <div class="password-field">
                    <input type="password" class="form-control" id="new_password" 
                           name="new_password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>
                  <div class="form-text">Minimum 8 caractères</div>
                </div>
                
                <div class="form-group">
                  <label for="confirm_password" class="form-label text-muted">Confirmer le mot de passe</label>
                  <div class="password-field">
                    <input type="password" class="form-control" id="confirm_password" 
                           name="confirm_password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                      <i class="fas fa-eye"></i>
                    </button>
                  </div>
                </div>
              </div>
              
              <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="resetPasswordForm()">
                  <i class="fas fa-times me-2"></i>Annuler
                </button>
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save me-2"></i>Changer le mot de passe
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Statistiques thématiques (économies, voyages abordables) -->
      <div class="sidebar">
        <div class="profile-card bg-white p-4">
          <h4 class="section-title">
            <i class="fas fa-chart-bar me-2"></i>Mes Économies & Voyages
          </h4>
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-number" id="reservationCount">0</div>
              <small class="text-muted">Réservations Économiques</small>
            </div>
            <div class="stat-card">
              <div class="stat-number" id="favoriteCount">0</div>
              <small class="text-muted">Destinations Favoris</small>
            </div>
            <div class="stat-card">
              <div class="stat-number" id="reviewCount">0</div>
              <small class="text-muted">Avis Partagés</small>
            </div>
            <div class="stat-card">
              <div class="stat-number" id="tripCount">0</div>
              <small class="text-muted">Voyages Réalisés</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Le reste du contenu reste inchangé -->
    <!-- Cartes côte à côte avec plus d'espace -->
    <div class="card-row-2">
      <!-- Zone dangereuse thématique (attention aux pertes budgétaires) -->
      <div class="profile-card bg-white p-4 danger-zone">
        <h4 class="section-title text-danger">
          <i class="fas fa-exclamation-triangle me-2"></i>Zone Dangereuse
        </h4>
        <div class="danger-content">
          <div class="danger-text">
            <p class="mb-3"><strong>Attention :</strong> Cette action est irréversible et peut affecter vos économies de voyage.</p>
            <ul class="text-muted small">
              <li>Données personnelles supprimées</li>
              <li>Réservations et économies perdues</li>
              <li>Avis et historique effacés</li>
            </ul>
          </div>
          <div class="danger-button">
            <button type="button" class="btn btn-danger" onclick="showDeleteConfirmation()">
              <i class="fas fa-trash-alt me-2"></i>Supprimer
            </button>
          </div>
        </div>
      </div>

      <!-- Activités récentes avec icônes de voyage -->
      <div class="profile-card bg-white p-4">
        <h4 class="section-title">
          <i class="fas fa-history me-2"></i>Activités Récentes
        </h4>
        <div class="activities-grid">
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-plane"></i> <!-- Icône voyage pour thème touristique -->
            </div>
            <div class="activity-content">
              <p class="mb-1">Connexion réussie</p>
              <small class="text-muted">Aujourd'hui à <?php echo date('H:i'); ?></small>
            </div>
          </div>
          
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-leaf"></i> <!-- Icône éco pour thème économique -->
            </div>
            <div class="activity-content">
              <p class="mb-1">Compte créé pour voyages éco</p>
              <small class="text-muted">Le <?php echo htmlspecialchars($dateInscription); ?></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/travela/mvc/views/frontOffice/lib/easing/easing.min.js"></script>
  <script src="/travela/mvc/views/frontOffice/lib/waypoints/waypoints.min.js"></script>
  <script src="/travela/mvc/views/frontOffice/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="/travela/mvc/views/frontOffice/lib/lightbox/js/lightbox.min.js"></script>
  <script src="/travela/mvc/views/frontOffice/js/main.js"></script>

  <script>
    // Fonction pour afficher la page de confirmation de suppression
    function showDeleteConfirmation() {
      window.location.href = 'profil.php?confirm_delete=true';
    }

    // Fonction pour fermer la page de confirmation
    function closeDeleteConfirmation() {
      window.location.href = 'profil.php';
    }

    // Fonction pour soumettre le formulaire de suppression
    function submitDeleteForm() {
      document.getElementById('deleteAccountForm').submit();
    }

    // Fonction pour basculer la visibilité du mot de passe
    function togglePassword(fieldId) {
      const field = document.getElementById(fieldId);
      const toggle = field.nextElementSibling;
      const icon = toggle.querySelector('i');
      
      if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    // Validation du formulaire de suppression
    document.addEventListener('DOMContentLoaded', function() {
      const confirmCheckbox = document.getElementById('confirmDeletePage');
      const confirmPassword = document.getElementById('confirm_password_page');
      const confirmButton = document.getElementById('confirmDeleteBtnPage');

      function validateDeleteForm() {
        const isChecked = confirmCheckbox.checked;
        const hasPassword = confirmPassword.value.trim().length > 0;
        confirmButton.disabled = !(isChecked && hasPassword);
      }

      if (confirmCheckbox && confirmPassword) {
        confirmCheckbox.addEventListener('change', validateDeleteForm);
        confirmPassword.addEventListener('input', validateDeleteForm);
      }

      // Simuler des données de statistiques thématiques
      setTimeout(() => {
        document.getElementById('reservationCount').textContent = '3';
        document.getElementById('favoriteCount').textContent = '7';
        document.getElementById('reviewCount').textContent = '2';
        document.getElementById('tripCount').textContent = '5';
      }, 1000);
    });

    // Réinitialiser les formulaires
    function resetForm() {
      document.getElementById('profileForm').reset();
    }

    function resetPasswordForm() {
      document.getElementById('passwordForm').reset();
    }

    // Gérer les messages d'alerte
    setTimeout(() => {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s ease';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      });
    }, 5000);
  </script>
  <button id="open-chatbot-btn" class="open-chatbot-btn">
  💬 Ouvrir le Chatbot
</button>
<a href="chatbot.php" target="_blank" class="open-chatbot-btn">
  💬 Ouvrir le Chatbot
</a>



        <!-- Bouton Chatbot -->
<button id="chatbot-btn" class="btn btn-primary btn-lg " 
        style="position: fixed; bottom: 25px; right: 25px; z-index: 1000;">
    <i class="fa-solid fa-robot"></i>
</button>

<!-- Fenêtre du Chatbot (contenu directement intégré, pas d'iframe) -->
<div id="chatbot-window" 
     style="display:none; position: fixed; bottom: 90px; right: 25px; width: 380px; height: 520px; 
            background: white; border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.3); 
            z-index: 1001; overflow: hidden;">

  <div style="background:#007bff; color:white; padding:10px; text-align:center; font-weight:bold;">
      Travela Chatbot
      <button id="close-chatbot" style="float:right; background:none; border:none; color:white; font-size:16px; cursor:pointer;">✕</button>
  </div>

  <div id="chat-body" style="padding:10px; height:370px; overflow-y:auto; font-size:14px;"></div>

  <div style="display:flex; padding:10px; border-top:1px solid #ddd;">
      <input type="text" id="user-input" placeholder="Écrivez ici..." 
             style="flex:1; padding:8px; font-size:14px; border:1px solid #ccc; border-radius:5px;">
      <button id="send-btn" 
              style="background-color:#007bff; color:white; border:none; padding:8px 12px; margin-left:5px; border-radius:5px; cursor:pointer;">
              Envoyer
      </button>
  </div>
</div>

<script>
const chatbotBtn = document.getElementById("chatbot-btn");
const chatbotWindow = document.getElementById("chatbot-window");
const closeChatbot = document.getElementById("close-chatbot");
const chatBody = document.getElementById('chat-body');
const userInput = document.getElementById('user-input');
const sendBtn = document.getElementById('send-btn');

// ouvrir / fermer le chatbot
chatbotBtn.addEventListener("click", () => {
  chatbotWindow.style.display = "block";
});
closeChatbot.addEventListener("click", () => {
  chatbotWindow.style.display = "none";
});

// Réponses automatiques
const responses = {
  "bonjour": "Bonjour 👋! Comment puis-je vous aider aujourd’hui ?",
  "réservation": "Pour vos réservations, consultez la section 'Destination & Reservation'.",
  "calculer impact":"pour calculer l'impact de votre voyage remplir le formulaire dans la section impact ecologique",
  "profil": "Vous pouvez gérer votre profil depuis votre page personnelle.",
  "avis":"si vous voulez ajouter votre avis consulter la page avis",
  "merci": "Avec plaisir 😊!",
  "aide": "Je peux répondre à vos questions sur Travela, les réservations ou le profil."
};

function addMessage(sender, text) {
  const msg = document.createElement('div');
  msg.style.marginBottom = '10px';
  msg.innerHTML = `<b style="color:${sender === 'user' ? '#333' : '#13357B80'}">${sender === 'user' ? 'Vous' : 'TravelaBot'} :</b> ${text}`;
  chatBody.appendChild(msg);
  chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
  const text = userInput.value.trim();
  if (text === "") return;

  addMessage('user', text);
  userInput.value = "";

  const reply = responses[text.toLowerCase()] || "Désolé 😅, je ne comprends pas encore cette question.";
  setTimeout(() => addMessage('bot', reply), 500);
}

sendBtn.addEventListener('click', sendMessage);
userInput.addEventListener('keypress', (e) => {
  if (e.key === 'Enter') sendMessage();
});
</script>
</body>
</html>