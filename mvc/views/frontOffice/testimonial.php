<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
// Inclusion avec chemins absolus
require_once $_SERVER['DOCUMENT_ROOT'] . '/travela/mvc/controllers/AvisController.php';

$controller = new AvisController();
$controller->handleRequest();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Travela - Avis Clients</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    
    <link href="/travela/mvc/views/frontOffice/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/travela/mvc/views/frontOffice/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    
    <link href="/travela/mvc/views/frontOffice/css/bootstrap.min.css" rel="stylesheet">

    
    <link href="/travela/mvc/views/frontOffice/css/style.css" rel="stylesheet">

    <style>
        .avis-item, .reponse-item {
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #f9f9f9, #fff);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .avis-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .reponse-item {
            margin-left: 40px;
            background: linear-gradient(135deg, #e9ecef, #f8f9fa);
            border-left: 4px solid #007bff;
        }
        .star-rating {
            color: #ffc107;
            font-size: 1.2em;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
        }
        .like-btn {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.3s;
        }
        .like-btn:hover, .like-btn.liked {
            color: #dc3545;
        }
        .interactive-stars .star {
            font-size: 2em;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }
        .interactive-stars .star.selected {
            color: #ffc107;
        }
        .collapse-toggle {
            cursor: pointer;
            color: #007bff;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .stats {
            background: #c9c972ff;
            width: 40%;
            margin: auto;
            color: white;
            padding: 10px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

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
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Accueil</a>
                    <a href="DestRes.php" class="nav-item nav-link">Destination & Reservation</a>
                    <a href="blog.php" class="nav-item nav-link">Activités & Événements</a>
                    <a href=" impactEco.php" class="nav-item nav-link">Impact Écologique</a>
                    <a href="testimonial.php" class="nav-item nav-link active">Avis</a>
                    <a href="profil.php" class="nav-item nav-link">Mon Profil</a>
                    <a href="login_client.php" class="nav-item nav-link text-danger">Déconnexion</a>
                    <a href="/travela/mvc/controllers/ClientController.php?action=logout" class="nav-item nav-link text-danger">Déconnexion</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Header Start -->
    <div class="container-fluid bg-avis">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4">Feedbacks</h3>
        </div>
    </div>
    <!-- Header End -->

    <!-- Avis Section Start -->
    <div class="container-fluid avis-section py-5">
        <div class="container py-5">
            
            <!-- Statistiques -->
            <div class="stats">
                <h5>📊 Statistiques des Avis</h5>
                <p>Total d'avis : <?php echo count($controller->getAvisPrincipaux()); ?> | Moyenne : <?php echo $controller->getAverageNote(); ?>/5 ⭐</p>
            </div>

            <!-- Message de confirmation (Toast) -->
            <?php if ($controller->getMessage()): ?>
                <div class="toast align-items-center text-white bg-<?php echo $controller->getMessageType() === 'success' ? 'success' : 'danger'; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
                    <div class="d-flex">
                        <div class="toast-body">
                            <?php echo htmlspecialchars($controller->getMessage()); ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
                <script>
                    var toastEl = document.querySelector('.toast');
                    var toast = new bootstrap.Toast(toastEl);
                    toast.show();
                </script>
            <?php endif; ?>

            <!-- Formulaire nouvel avis -->
            <div class="avis-form mb-5 p-4 bg-light rounded shadow">
                <h3 class="mb-4"><i class="fas fa-pen"></i> Laissez votre avis</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="ajouter_avis">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="nom" class="form-control mb-3" placeholder="Votre nom *" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control mb-3" placeholder="Votre email">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Note :</label>
                        <div class="interactive-stars" id="star-rating">
                            <span class="star" data-value="5">⭐</span>
                            <span class="star" data-value="4">⭐</span>
                            <span class="star" data-value="3">⭐</span>
                            <span class="star" data-value="2">⭐</span>
                            <span class="star" data-value="1">⭐</span>
                        </div>
                        <input type="hidden" name="note" id="note-value" value="0">
                    </div>
                    <textarea name="commentaire" class="form-control mb-3" placeholder="Votre commentaire... *" rows="4" required></textarea>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Publier l'avis</button>
                </form>
            </div>

            <!-- Liste des avis (Carousel) -->
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Avis Clients</h5>
                <h1 class="mb-0">Ce que disent nos clients !</h1>
            </div>

            <?php
            $avisList = $controller->getAvisPrincipaux();
            if (empty($avisList)): ?>
                <div class="text-center">
                    <p>🎉 Aucun avis pour le moment. Soyez le premier à donner votre avis !</p>
                </div>
            <?php else: ?>
                <div class="owl-carousel testimonial-carousel">
                    <?php foreach ($avisList as $avis): ?>
                        <div class="avis-item fade-in">
                            <div class="d-flex align-items-start">
                                <div class="avatar"><?php echo strtoupper(substr($avis->getNomClient(), 0, 1)); ?></div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h5 class="mb-1"><?php echo htmlspecialchars($avis->getNomClient()); ?></h5>
                                            <div class="star-rating mb-2">
                                                <?php echo str_repeat('⭐', (int)$avis->getNote()); ?> <span class="badge bg-warning"><?php echo (int)$avis->getNote(); ?>/5</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="like-btn" onclick="likeAvis(<?php echo $avis->getId(); ?>)">👍 <span id="likes-<?php echo $avis->getId(); ?>"><?php echo $avis->getLikes(); ?></span></button>
                                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $avis->getUserId()): ?>
                                                <button class="btn btn-sm btn-outline-secondary ms-2" onclick="editAvis(<?php echo $avis->getId(); ?>)">✏️</button>
                                                <button class="btn btn-sm btn-outline-danger ms-2" onclick="confirmDelete(<?php echo $avis->getId(); ?>, 'avis')">🗑️</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p class="mb-3"><?php echo nl2br(htmlspecialchars($avis->getCommentaire())); ?></p>
                                    <small class="text-muted"><?php echo htmlspecialchars($avis->getDateAvis()); ?></small>

                                    <!-- Réponses -->
                                    <div class="mt-3">
                                        <span class="collapse-toggle" data-bs-toggle="collapse" data-bs-target="#replies-<?php echo $avis->getId(); ?>">💬 Voir les réponses (<?php echo count($controller->getReponsesByAvisId($avis->getId())); ?>)</span>
                                        <div class="collapse mt-2" id="replies-<?php echo $avis->getId(); ?>">
                                            <?php
                                            $reponses = $controller->getReponsesByAvisId($avis->getId());
                                            foreach ($reponses as $reponse): ?>
                                                <div class="reponse-item">
                                                    <strong><?php echo htmlspecialchars($reponse->getNomClient()); ?> :</strong>
                                                    <p class="mb-1"><?php echo nl2br(htmlspecialchars($reponse->getCommentaire())); ?></p>
                                                    <div class="d-flex justify-content-between">
                                                        <small class="text-muted"><?php echo htmlspecialchars($reponse->getDateAvis()); ?></small>
                                                        <button class="like-btn" onclick="likeAvis(<?php echo $reponse->getId(); ?>)">👍 <span id="likes-<?php echo $reponse->getId(); ?>"><?php echo $reponse->getLikes(); ?></span></button>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <!-- Formulaire de réponse -->
                                    <div class="mt-3">
                                        <form method="POST">
                                            <input type="hidden" name="action" value="repondre_avis">
                                            <input type="hidden" name="avis_id" value="<?php echo $avis->getId(); ?>">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="nom_reponse" class="form-control form-control-sm mb-2" placeholder="Votre nom *" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="email" name="email_reponse" class="form-control form-control-sm mb-2" placeholder="Votre email">
                                                </div>
                                            </div>
                                            <textarea name="commentaire_reponse" class="form-control form-control-sm mb-2" placeholder="Votre réponse... *" rows="2" required></textarea>
                                            <button type="submit" class="btn btn-sm btn-outline-primary">💬 Répondre</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Avis Section End -->

    <!-- Copyright -->
    <div class="container-fluid copyright text-body py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-end mb-md-0">
                    <i class="fas fa-copyright me-2"></i>
                    <a class="text-white" href="#">Travela</a>, Tous droits réservés.
                </div>
                <div class="col-md-6 text-center text-md-start">
                    Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top">
        <i class="fa fa-arrow-up"></i>
    </a>

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/travela/mvc/views/frontOffice/lib/easing/easing.min.js"></script>
    <script src="/travela/mvc/views/frontOffice/lib/waypoints/waypoints.min.js"></script>
    <script src="/travela/mvc/views/frontOffice/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/travela/mvc/views/frontOffice/lib/lightbox/js/lightbox.min.js"></script>
    <script src="/travela/mvc/views/frontOffice/js/main.js"></script>

    <!-- Initialisation Owl Carousel -->
    <script>
        $(document).ready(function() {
            $('.testimonial-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                items: 1,
                autoplay: true,
                autoplayTimeout: 5000
            });
        });
    </script>

    <!-- JavaScript pour les étoiles -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('#star-rating .star');
            const noteInput = document.getElementById('note-value');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    noteInput.value = value;

                    // Réinitialiser toutes les étoiles
                    stars.forEach(s => s.classList.remove('selected'));

                    // Colorer les étoiles jusqu'à celle cliquée
                    for (let i = 0; i < value; i++) {
                        stars[i].classList.add('selected');
                    }
                });
            });
        });
    </script>

    <!-- Fonction like AJAX -->
    <script>
        function likeAvis(id) {
            console.log('Like clicked for ID:', id);  // Log pour déboguer
            fetch('testimonial.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=like_avis&id=' + id
            })
            .then(response => {
                console.log('Response status:', response.status);  // Log pour déboguer
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);  // Log pour déboguer
                if (data.success) {
                    document.getElementById('likes-' + id).textContent = data.likes
                                    } else {
                    alert('Erreur lors du like: ' + (data.message || 'Inconnue'));
                }
            })
            .catch(error => {
                console.error('Erreur AJAX:', error);
                alert('Erreur réseau lors du like');
            });
        }
    </script>

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

  <div style="background:#13357B80; color:white; padding:10px; text-align:center; font-weight:bold;">
      Travela Chatbot
      <button id="close-chatbot" style="float:right; background:none; border:none; color:white; font-size:16px; cursor:pointer;">✕</button>
  </div>

  <div id="chat-body" style="padding:10px; height:370px; overflow-y:auto; font-size:14px;"></div>

  <div style="display:flex; padding:10px; border-top:1px solid #ddd;">
      <input type="text" id="user-input" placeholder="Écrivez ici..." 
             style="flex:1; padding:8px; font-size:14px; border:1px solid #ccc; border-radius:5px;">
      <button id="send-btn" 
              style="background-color:#13357B80; color:white; border:none; padding:8px 12px; margin-left:5px; border-radius:5px; cursor:pointer;">
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
