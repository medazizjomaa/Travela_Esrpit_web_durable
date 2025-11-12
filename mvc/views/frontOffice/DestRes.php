<?php
session_start();
require_once __DIR__ . '/../../controllers/destController.php';
require_once __DIR__ . '/../../controllers/resController.php';

// Récupération des destinations depuis la BD
$destinationC = new DestinationController();
$listeDestinations = $destinationC->getAllDestinations();

// Si un utilisateur est connecté
$nomClient = isset($_SESSION['nomclient']) ? $_SESSION['nomclient'] : '';
$mailClient = isset($_SESSION['mailclient']) ? $_SESSION['mailclient'] : '';
$telephoneClient = isset($_SESSION['telephone']) ? $_SESSION['telephone'] : '';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Travela - Tourism Website Template</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="/travela/mvc/views/frontOffice/lib/owlcarousel/assets1/owl.carousel.min.css" rel="stylesheet">
        <link href="/travela/mvc/views/frontOffice/lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="/travela/mvc/views/frontOffice/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="/travela/mvc/views/frontOffice/css/style.css" rel="stylesheet">
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
                    <!-- <img src="/travela/mvc/views/frontOffice/img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Acceuil</a>
                    <a href="DestRes.php" class="nav-item nav-link active">Destination & Reservation</a>
                    <a href="blog.php" class="nav-item nav-link">Activités & Événements</a>
                    <a href=" impactEco.php" class="nav-item nav-link">Impact Écologique</a>
                    <a href="testimonial.php" class="nav-item nav-link ">Avis</a>
                    <a href="profil.php" class="nav-item nav-link">Mon Profil</a>
                    <a href="login_client.php" class="nav-item nav-link text-danger">Déconnexion</a>
                </div>
            </div>
            </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-dest">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Nos Destinations</h1>
                 
            </div>
        </div>
        <!-- Header End -->

        <!-- Destination Start -->
<div class="container-fluid destination py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Destinations</h5>
            <h1 class="mb-0">Destinations Populaires</h1>
        </div>

        <?php
        // Charger le contrôleur
        require_once __DIR__ . '/../../controllers/destController.php';
        $destinationController = new DestinationController();
        $destinations = $destinationController->getAllDestinations(); // fonction à définir dans ton controller
        ?>

        <div class="tab-class text-center">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <?php if (!empty($destinations)): ?>
                            <?php foreach ($destinations as $destination): ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" 
                                             src="/travela/mvc/views/frontOffice/img/<?= htmlspecialchars($destination['imageD']); ?>" 
                                             alt="<?= htmlspecialchars($destination['nom_dest']); ?>">
                                        <div class="destination-overlay p-4">
                                            <button class="book-now-btn" 
                                                    data-destination="<?= htmlspecialchars($destination['nom_dest']); ?>">
                                                Book Now
                                            </button>
                                            <h4 class="text-white mb-2 mt-3">
                                                <?= htmlspecialchars($destination['nom_dest']); ?>
                                            </h4>
                                            <p class="text-white mb-0"><?= htmlspecialchars($destination['prix']); ?></p>
                                        </div>
                                        <div class="search-icon">
                                            <a href="/travela/mvc/views/frontOffice/img/<?= htmlspecialchars($destination['imageD']); ?>" 
                                               data-lightbox="<?= htmlspecialchars($destination['nom_dest']); ?>">
                                                <i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center text-muted">Aucune destination disponible pour le moment.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Destination End -->
<!-- 🧳 Reservation Section Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Réservation</h5>
                <h1 class="text-white mb-4">Réservez Votre Voyage</h1>
                <p class="text-white mb-4">
                    Profitez des meilleures offres pour vos destinations préférées. 
                    Réservez dès maintenant votre prochaine aventure en toute simplicité !
                </p>
                <a href="#destination-section" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">
                    Voir les Destinations
                </a>
            </div>

            <div class="col-lg-6">
                <h1 class="text-white mb-3">Formulaire de Réservation</h1>
                <p class="text-white mb-4">Complétez les informations ci-dessous pour finaliser votre réservation.</p>

                <form method="POST" action="/travela/mvc/controllers/resController.php?action=addReservation">
    <div class="row g-3">
        <!-- Destination (auto-filled via JS) -->
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" 
                       class="form-control bg-white border-0" 
                       id="destination" 
                       name="destination"
                       readonly required>
                <label for="destination">Destination</label>
            </div>
        </div>

        <!-- Type -->
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-select bg-white border-0" id="type" name="type" required>
                    <option value="">-- Choisissez --</option>
                    <option value="individuel">Individuel</option>
                    <option value="groupe">En groupe</option>
                </select>
                <label for="type">Type de réservation</label>
            </div>
        </div>

        <!-- Nombre de personnes -->
        <div class="col-md-6">
            <div class="form-floating">
                <input type="number" 
                       class="form-control bg-white border-0" 
                       id="nbr_personne" 
                       name="nbr_personne" 
                       min="1" required>
                <label for="nbr_personne">Nombre de personnes</label>
            </div>
        </div>

        <!-- Date -->
        <div class="col-md-6">
            <div class="form-floating">
                <input type="date" 
                       class="form-control bg-white border-0" 
                       id="date_reservation" 
                       name="date_reservation" 
                       required>
                <label for="date_reservation">Date de réservation</label>
            </div>
        </div>

        <!-- Bouton -->
        <div class="col-12">
            <button class="btn btn-primary text-white w-100 py-3" type="submit">
                Réserver Maintenant
            </button>
        </div>
    </div>
</form>
            </div>
        </div>
    </div>
</div>
<!-- 🧳 Reservation Section End -->

        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
            

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script>
// Quand on clique sur "Book Now"
document.addEventListener("DOMContentLoaded", function () {
    const bookButtons = document.querySelectorAll(".book-now-btn");
    const reservationForm = document.getElementById("reservation-form");

    bookButtons.forEach(button => {
        button.addEventListener("click", function () {
            // Récupérer les infos de la destination
            const destinationName = this.getAttribute("data-destination");

            // Remplir automatiquement le champ destination du formulaire
            document.getElementById("destination").value = destinationName;

            // Si tu veux que le formulaire prenne les infos du user connecté
            <?php if (isset($_SESSION['nom'])): ?>
                document.getElementById("nom").value = "<?= $_SESSION['nom'] ?>";
                document.getElementById("email").value = "<?= $_SESSION['email'] ?>";
                document.getElementById("telephone").value = "<?= $_SESSION['telephone'] ?>";
            <?php endif; ?>

            // Faire défiler vers le formulaire
            reservationForm.scrollIntoView({ behavior: "smooth" });
        });
    });
});
</script>


        <!-- Template Javascript -->
        <script src="/travela/mvc/views/frontOffice//js/main.js"></script>
    
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