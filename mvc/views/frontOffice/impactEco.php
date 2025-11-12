<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Travela-impact Ecologique</title>
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

        <!-- Chart.js pour graphiques interactifs -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

       
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
                         <a href="/travela/mvc/views/frontOffice/index.php" class="nav-item nav-link ">Acceuil</a>
                        <a href="/travela/mvc/views/frontOffice/DestRes.php" class="nav-item nav-link">Destination & Reservation</a>
                        <a href="/travela/mvc/views/frontOffice/blog.php" class="nav-item nav-link">Activites & Evenements</a>
                        <a href=" /travela/mvc/views/frontOffice/impactEco.php" class="nav-item nav-link active">Impact Ecologique</a>
                        <a href="/travela/mvc/views/frontOffice/testimonial.php" class="nav-item nav-link">Avis</a>
                        <a href="/travela/mvc/views/frontOffice/profil.php" class="nav-item nav-link">Mon Profil</a>
                    <a href="login_client.php" class="nav-item nav-link text-danger">Déconnexion</a>
                         
                    </div>
                </div>
            </nav>

        <!-- Header Start -->
        <div class="container-fluid bg-eco">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Impact Ecologique</h1>
                 
            </div>
        </div>
        <!-- Header End -->
        
        <!-- Services Start -->
         <div class="container-fluid destination py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h3 class="section-title px-3">Calculateur d'impact écologique</h3>
                    
                    <p> En quelques clics, découvrez l'empreinte carbone de votre voyage et recevez des conseils pour réduire votre impact sur l'environnement. Parce que voyager responsable, c'est aussi prendre soin de notre planète.</p>
                </div>
                
                <!-- Nouvelle disposition avec deux colonnes -->
                <div class="impact-main-container">
                    <!-- Colonne de gauche pour les résultats -->
                    <div class="impact-left-panel">
                        <div id="impactResultContainer" class="impact-result-container">
                            <!-- Message par défaut quand aucun calcul n'a été fait -->
                            <div id="defaultMessage" class="impact-default-message">
                                <i class="fas fa-leaf"></i>
                                <h1 class="mb-0">" Ici on vous permet d'estimer les émissions de CO₂ générées par vos déplacements et vos choix d'hébergement. "</h1>
                            </div>
                            
                            <!-- Contenu des résultats (caché par défaut) -->
                            <div id="impactResultContent" class="impact-result-content">
                                <h2>🌍 Résultat du calcul</h2>
                                <div class="impact-result">
                                    <p><strong>Transport choisi :</strong> <span id="resultTransport"></span></p>
                                    <p><strong>Distance :</strong> <span id="resultDistance"></span> km</p>
                                    <p><strong>Nombre de voyageurs :</strong> <span id="resultVoyageurs"></span></p>
                                    <p><strong>Hébergement :</strong> <span id="resultHebergement"></span></p>
                                    <hr>
                                    <h3>Ton voyage génère environ 
                                        <span class="impact-co2" id="resultCO2"></span> kg de CO₂
                                    </h3>
                                    <p>🌳 Il faudrait planter <strong id="resultArbres"></strong> arbres pour compenser.</p>
                                    <p>🔥 C'est équivalent à environ <strong id="resultKmVoiture"></strong> km en voiture.</p>
                                </div>
                                <a href="#" onclick="resetForm()" class="impact-btn">🔄 Refaire un calcul</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Colonne de droite pour le formulaire -->
                    <div class="impact-right-panel">
                        <div class="impact-container">
                            <div class="form-section">
                                <form id="impactForm">
                                    <label for="transport">Mode de transport</label>
                                    <select name="transport" id="transport" required>
                                        <option value="voiture">🚗 Voiture</option>
                                        <option value="avion">✈️ Avion</option>
                                        <option value="train">🚆 Train</option>
                                        <option value="bus">🚌 Bus</option>
                                        
                                        <option value="velo">🚴 Vélo</option>
                                    </select>

                                    <label for="distance">Distance (en km)</label>
                                    <input type="number" name="distance" id="distance" required min="1">

                                    <label for="voyageurs">Nombre de voyageurs</label>
                                    <input type="number" name="voyageurs" id="voyageurs" required min="1">

                                    <label for="hebergement">Type d'hébergement</label>
                                    <select name="hebergement" id="hebergement" required>
                                        <option value="hotel_classique">🏨 Hôtel classique</option>
                                        <option value="auberge_eco">🏡 Auberge éco-responsable</option>
                                        <option value="camping">⛺ Camping</option>
                                    </select>

                                    <button type="submit" id="calculateBtn">Calculer l'impact 🌱</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
          <!-- Astuces et conseils dans un cadre remarquable (en dessous) -->
                <div id="tips" class="tips">
                    <h4>💡 Astuces pour réduire votre impact :</h4>
                    <ul id="tipsList"></ul>
                </div>
            </div>
        </div>
         <!-- Faits intéressants sur l'impact écologique -->
            <div class="eco-facts">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h3 class="section-title px-3">🔍 Faits intéressants</h3>
                </div>
                
                <div class="fact-card">
                    <p><strong>Le vélo :</strong> Un mode de transport zéro émission ! Pédaler 10 km équivaut à économiser 1 kg de CO₂.</p>
                </div>
                <div class="fact-card">
                    <p><strong>Les hôtels éco :</strong> Ils utilisent des énergies renouvelables et réduisent les déchets, diminuant l'impact de 50-70%.</p>
                </div>
                <div class="fact-card">
                    <p><strong>Compensation carbone :</strong> Planter un arbre absorbe environ 20 kg de CO₂ par an. Pensez aux programmes comme Tree-Nation !</p>
                </div>
            </div>

        <!-- Liste des impacts calculés -->
<div class="container py-5">
    <div class="history">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h3 class="section-title px-3">📜 Historique des impacts calculés</h3>
        </div>
        
        <div class="row" id="historyContainer">
            <?php
            // Inclure le contrôleur et récupérer l'historique
            require_once '../../controllers/ImpactController.php';
            $controller = new ImpactController();
            $impacts = $controller->getAllImpacts();
            
            foreach ($impacts as $impact) {
                echo '
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="impact-history-card interactive-element" onclick="showDetails(' . $impact['ID'] . ')">
                        <div class="impact-history-header">
                            <div class="impact-date">' . $impact['DATE_CALCUL'] . '</div>
                            <div class="impact-co2-badge">' . $impact['CO2_TOTAL'] . ' kg CO₂</div>
                        </div>
                        <div class="impact-history-body">
                            <div class="impact-info-item">
                                <i class="fas fa-car"></i>
                                <span>' . $impact['TRANSPORT'] . '</span>
                            </div>
                            <div class="impact-info-item">
                                <i class="fas fa-road"></i>
                                <span>' . $impact['DISTANCE'] . ' km</span>
                            </div>
                            <div class="impact-info-item">
                                <i class="fas fa-users"></i>
                                <span>' . $impact['VOYAGEURS'] . ' voyageur(s)</span>
                            </div>
                            <div class="impact-info-item">
                                <i class="fas fa-hotel"></i>
                                <span>' . $impact['HEBERGEMENT'] . '</span>
                            </div>
                        </div>
                        <div class="impact-history-footer">
                            <button class="btn-details" onclick="event.stopPropagation(); showDetails(' . $impact['ID'] . ')">
                                Voir détails
                            </button>
                        </div>
                    </div>
                </div>';
            }
            
            // Message si aucun historique
            if (empty($impacts)) {
                echo '
                <div class="col-12 text-center">
                    <div class="empty-history-message">
                        <i class="fas fa-history fa-3x mb-3"></i>
                        <h4>Aucun calcul enregistré</h4>
                        <p>Vos calculs d\'impact écologique apparaîtront ici</p>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</div>
           
            <!-- Quiz interactif -->
              <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h3 class="section-title px-3">🧠 Quiz : Êtes-vous éco-responsable ?</h3>
                </div>
            <div class="quiz">
               
                <div class="quiz-question">
                    <p>Quelle est la meilleure façon de réduire l'impact carbone d'un voyage ?</p>
                    <div class="quiz-options">
                        <label><input type="radio" name="quiz1" value="a"> Prendre l'avion pour aller plus vite</label>
                        <label><input type="radio" name="quiz1" value="b"> Choisir le train ou le bus</label>
                        <label><input type="radio" name="quiz1" value="c"> Voyager en voiture seul</label>
                    </div>
                    <button onclick="checkQuiz()" class="btn btn-primary mt-2">Vérifier</button>
                    <p id="quizResult" class="mt-2"></p>
                </div>
            </div>

           
        <!-- Services End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author's credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author's credit link/attribution link/backlink, ***/-->
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
        

        <!-- Template Javascript -->
        <script src="/travela/mvc/views/frontOffice//js/main.js"></script>

        <!-- Script personnalisé pour interactivité -->
        <script>
            // Initialiser les tooltips Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            
            // Gestion du formulaire avec AJAX
            document.getElementById('impactForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                fetch('../../controllers/index.php?action=calculer', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remplir le conteneur de résultat
                        document.getElementById('resultTransport').innerText = data.transport;
                        document.getElementById('resultDistance').innerText = data.distance;
                        document.getElementById('resultVoyageurs').innerText = data.voyageurs;
                        document.getElementById('resultHebergement').innerText = data.hebergement;
                        document.getElementById('resultCO2').innerText = Math.round(data.co2_total * 100) / 100 + ' kg';
                        document.getElementById('resultArbres').innerText = Math.round(data.co2_total / 20);
                        document.getElementById('resultKmVoiture').innerText = Math.round(data.co2_total * 5);

                        // Afficher les résultats et masquer le message par défaut
                        document.getElementById('defaultMessage').style.display = 'none';
                        document.getElementById('impactResultContent').style.display = 'block';
                        document.getElementById('impactResultContent').classList.add('fade-in');
                        
                        document.getElementById('tips').style.display = 'block';

                        // Générer des astuces
                        generateTips(data.transport, data.hebergement);

                        // Recharger l'historique après ajout
                        reloadHistory();
                    } else {
                        alert('Erreur lors du calcul.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur de connexion.');
                });
            });

            function generateTips(transport, hebergement) {
                let tips = [];
                if (transport === 'avion') tips.push('Considérez le train pour réduire de 80% les émissions.');
                if (hebergement === 'hotel_classique') tips.push('Choisissez un camping pour un impact minimal.');
                tips.push('Compensez vos émissions en plantant des arbres via des programmes de reforestation.');

                const tipsList = document.getElementById('tipsList');
                tipsList.innerHTML = '';
                tips.forEach(tip => {
                    const li = document.createElement('li');
                    li.textContent = tip;
                    tipsList.appendChild(li);
                });
            }

            function resetForm() {
                document.getElementById('impactForm').reset();
                // Réinitialiser l'affichage des résultats
                document.getElementById('defaultMessage').style.display = 'block';
                document.getElementById('impactResultContent').style.display = 'none';
                document.getElementById('tips').style.display = 'none';
            }

            function reloadHistory() {
                fetch('../../controllers/index.php?action=getHistory')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('historyTable');
                    tbody.innerHTML = '';
                    data.forEach(impact => {
                        const tr = document.createElement('tr');
                        tr.className = 'interactive-element';
                        tr.onclick = () => showDetails(impact.ID);
                        tr.innerHTML = `
                            <td>${impact.DATE_CALCUL}</td>
                            <td>${impact.TRANSPORT}</td>
                            <td>${impact.DISTANCE}</td>
                            <td>${impact.VOYAGEURS}</td>
                            <td>${impact.HEBERGEMENT}</td>
                            <td>${impact.CO2_TOTAL}</td>
                        `;
                        tbody.appendChild(tr);
                    });
                })
                .catch(error => console.error('Erreur rechargement historique:', error));
            }

            function showDetails(id) {
                // Fonction pour afficher plus de détails sur un impact (peut être étendue)
                alert('Détails pour l\'impact ID: ' + id);
            }

            function checkQuiz() {
                const selected = document.querySelector('input[name="quiz1"]:checked');
                const result = document.getElementById('quizResult');
                if (!selected) {
                    result.innerText = 'Veuillez sélectionner une réponse.';
                    result.style.color = 'red';
                    return;
                }
                if (selected.value === 'b') {
                    result.innerText = 'Bonne réponse ! Le train ou le bus est plus éco-responsable.';
                    result.style.color = 'green';
                } else {
                    result.innerText = 'Mauvaise réponse. Essayez le train ou le bus pour réduire l\'impact.';
                    result.style.color = 'red';
                }
            }
            function showDetails(id) {
    // Récupérer les détails via AJAX ou afficher une modal
    fetch(`../../controllers/index.php?action=getImpactDetails&id=${id}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Afficher les détails dans une modal
            const modalContent = `
                <div class="modal fade" id="impactDetailsModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Détails du calcul - ${data.date}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="impact-details-grid">
                                    <div class="detail-item">
                                        <strong>Transport:</strong> ${data.transport}
                                    </div>
                                    <div class="detail-item">
                                        <strong>Distance:</strong> ${data.distance} km
                                    </div>
                                    <div class="detail-item">
                                        <strong>Voyageurs:</strong> ${data.voyageurs}
                                    </div>
                                    <div class="detail-item">
                                        <strong>Hébergement:</strong> ${data.hebergement}
                                    </div>
                                    <div class="detail-item highlight">
                                        <strong>CO₂ Total:</strong> ${data.co2_total} kg
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            // Ajouter la modal au DOM et l'afficher
            document.body.insertAdjacentHTML('beforeend', modalContent);
            const modal = new bootstrap.Modal(document.getElementById('impactDetailsModal'));
            modal.show();
            
            // Nettoyer après fermeture
            document.getElementById('impactDetailsModal').addEventListener('hidden.bs.modal', function() {
                this.remove();
            });
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Erreur lors du chargement des détails');
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