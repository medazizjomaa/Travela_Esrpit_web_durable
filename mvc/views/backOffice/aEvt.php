<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets1/css/bootstrap.css">

    <link rel="stylesheet" href="assets1/vendors/iconly/bold.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets1/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets1/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets1/css/app.css">
    <link rel="shortcut icon" href="assets1/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="assets1/images/logo/logo.png"  alt="Travela" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                             <li class="sidebar-title">Pages &amp; Configuration</li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-truck-front-fill"></i>
                                <span>Destinations</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="lDest.php">Liste</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="aDest.php">Ajout</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-calendar-event-fill"></i>
                                <span>Réservations</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="lRes.php">Liste</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="aRes.php">Ajout</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-star-fill"></i>
                                <span>Activités & Evènements</span>
                            </a>
                            <ul class="submenu active ">
                                <li class="submenu-item ">
                                    <a href="lEvt.php">Liste</a>
                                </li>
                                <li class="submenu-item active">
                                    <a href="aEvt.php">Ajout</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-globe-americas"></i>
                                <span>Impact Ecologique</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="limp.php">Liste</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="aimp.php">Ajout</a>
                                </li>
                            </ul>
                        </li>
                       <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-chat-heart-fill"></i>
                                <span>Avis</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="lAvis.php">Liste</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="aAvis.php">Ajout</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Clients</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="lClnt.php">Liste</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="aClnt.php">Ajout</a>
                                </li>
                            </ul>
                        </li>
                         
 </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
<!--CONTENU-->
           <div class="page-heading">
    <h3>Ajouter une Nouvelle Activité ou un Événement Durable 🌳</h3>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Détails de l'Activité/Événement</h4>
            </div>
            <div class="card-body">
                <form action="../../controllers/ActiviteEvenementDurableController.php?action=add" method="POST" class="form form-vertical" id="formAddActivityEvent">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nom"><i class="bi bi-tag-fill"></i> Nom</label>
                                    <input type="text" id="nom" class="form-control" name="nom" placeholder="Nom de l'événement ou de l'activité" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="type"><i class="bi bi-lightbulb-fill"></i> Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option value="" disabled selected>Choisir un type</option>
                                        <option value="Activite">Activité Durable</option>
                                        <option value="Evenement">Événement Écologique</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="lieu"><i class="bi bi-geo-alt-fill"></i> Lieu</label>
                                    <input type="text" id="lieu" class="form-control" name="lieu" placeholder="Ville, site, ou adresse" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="responsable"><i class="bi bi-person-circle"></i> Responsable/Organisateur</label>
                                    <input type="text" id="responsable" class="form-control" name="responsable" placeholder="Nom ou entité responsable" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="date_debut"><i class="bi bi-calendar-check"></i> Date de Début</label>
                                    <input type="date" id="date_debut" class="form-control" name="date_debut" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="date_fin"><i class="bi bi-calendar-x"></i> Date de Fin</label>
                                    <input type="date" id="date_fin" class="form-control" name="date_fin" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description"><i class="bi bi-card-text"></i> Description Détaillée</label>
                                    <textarea id="description" class="form-control" name="description" rows="3" placeholder="Description complète de l'activité/événement" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="image_url"><i class="bi bi-image"></i> URL de l'Image</label>
                                    <input type="url" id="image_url" class="form-control" name="image_url" placeholder="Ex: http://example.com/image.jpg">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="video_url"><i class="bi bi-camera-video"></i> URL de la Vidéo (Optionnel)</label>
                                    <input type="url" id="video_url" class="form-control" name="video_url" placeholder="Ex: Lien YouTube/Vimeo">
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-success me-1 mb-1">
                                    <i class="bi bi-plus-circle"></i> Enregistrer
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                    <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="statusMessage" class="mt-3 p-3 text-center rounded" style="display: none;"></div>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('formAddActivityEvent').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const statusDiv = document.getElementById('statusMessage');

        // Récupération des données du formulaire
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            statusDiv.style.display = 'block';
            if (data.success) {
                statusDiv.className = 'alert alert-success';
                statusDiv.innerHTML = `✅ ${data.message} (ID: ${data.id})`;
                form.reset(); // Vider le formulaire après succès
                // Redirection optionnelle vers la liste après un court délai
                // setTimeout(() => { window.location.href = 'lActivites.php'; }, 2000); 
            } else {
                statusDiv.className = 'alert alert-danger';
                statusDiv.innerHTML = `❌ Erreur : ${data.message}`;
            }
        })
        .catch(error => {
            statusDiv.style.display = 'block';
            statusDiv.className = 'alert alert-warning';
            statusDiv.innerHTML = '⚠️ Erreur de connexion ou serveur indisponible.';
            console.error('Erreur:', error);
        });
    });
</script>
    <script src="assets1/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets1/js/bootstrap.bundle.min.js"></script>

    <script src="assets1/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets1/js/pages/dashboard.js"></script>

    <script src="assets1/js/main.js"></script>
</body>

</html>