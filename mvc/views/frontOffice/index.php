<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Travela</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
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
                        <a href="index.php" class="nav-item nav-link active">Acceuil</a>
                        <a href="DestRes.php" class="nav-item nav-link">Destination & Reservation</a>
                        <a href="blog.php" class="nav-item nav-link">Activites & Evenements</a>
                        <a href=" impactEco.php" class="nav-item nav-link">Impact Ecologique</a>
                        <a href="testimonial.php" class="nav-item nav-link">Avis</a>
                        <a href="profil.php" class="nav-item nav-link">Mon Profil</a>
                    <a href="login_client.php" class="nav-item nav-link text-danger">Déconnexion</a>
                         
                    </div>
                </div>
            </nav>

            <!-- Carousel Start -->
            <div class="carousel-header">
                <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="/travela/mvc/views/frontOffice/img/tunisia.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Explorer la Tunisie</h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4"> Le Voyage Qui A Du Sens.</h1>
                                     >
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-hover-bg btn btn-primary rounded-pill text-white  py-3 px-5" href="DestRes.php">Decouvrir maintenant</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/travela/mvc/views/frontOffice/img/jardin.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">trouver un tour parfait </h4>
</h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4">Votre Aventure, Notre Patrimoine. Durablement.</h1>
                                    
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="DestRes.php">Decouvrir maintenant</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/travela/mvc/views/frontOffice/img/sahara.jpg" class="img-fluid" alt="Image">
                            <div class="carousel-caption">
                                <div class="p-3" style="max-width: 900px;">
                                    <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;"> Tunisie Durable </h4>
                                    <h1 class="display-2 text-capitalize text-white mb-4">Explorez l'Héritage, Respectez l'Avenir. Tunisie</h1>
            
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="DestRes.php">Decouvrir maintenant </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <!-- Carousel End -->
        </div>
         
        <!-- Navbar & Hero End -->

        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                            <img src="/travela/mvc/views/frontOffice/img/05.jpg" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(travela/mvc/views/frontOffice/img/about-img-1.png);">
                        <h5 class="section-about-title pe-3">Qui sommes-nous ?</h5>
                        <h1 class="mb-4">Bienvenue à <span class="text-primary">Travela</span></h1>
                        <p class="mb-4">Travela est une plateforme de tourisme durable qui aide les voyageurs à planifier leurs séjours de manière responsable et respectueuse de l’environnement. Grâce à ses outils intuitifs, vous pouvez découvrir des destinations éco-responsables, gérer vos réservations en toute simplicité et même calculer l’impact écologique de vos voyages. Notre objectif est d’encourager un tourisme plus vert , où chaque voyage devient une expérience enrichissante pour vous et bénéfique pour la planète.</p>
                         
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
 

        
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">TRAVELA</a>, All right reserved.
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

        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="/travela/mvc/views/frontOffice/js/main.js"></script>
    </body>

</html>