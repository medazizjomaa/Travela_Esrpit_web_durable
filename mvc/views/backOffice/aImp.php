<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinations</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets1/css/bootstrap.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="./vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="./vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets1/vendors/iconly/bold.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets1/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets1/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets1/css/app.css">
    <link rel="shortcut icon" href="assets1/images/favicon.svg" type="image/x-icon">
</head>
    <style>
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }
        .d-flex {
            display: flex;
        }
        .me-2 {
            margin-right: 0.5rem;
        }
    </style>
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
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-star-fill"></i>
                                <span>Activités & Evènements</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="lEvt.php">Liste</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="aEvt.php">Ajout</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-globe-americas"></i>
                                <span>Impact Ecologique</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item ">
                                    <a href="limp.php">Liste</a>
                                </li>
                                <li class="submenu-item active">
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
    <h3>Calculateur d'Impact Écologique 🌍</h3>
</div>

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Estimez votre empreinte carbone de voyage</h4>
            </div>
            <div class="card-body">
                <form action="../../controllers/ImpactController.php?action=calculer" method="POST" class="form form-vertical" id="formCalculImpact">
                    <div class="form-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="transport"><i class="bi bi-airplane-fill"></i> Mode de Transport</label>
                                    <select class="form-control" id="transport" name="transport" required>
                                        <option value="" disabled selected>Sélectionner un mode</option>
                                        <option value="avion">✈️ Avion</option>
                                        <option value="train">🚆 Train</option>
                                        <option value="bus">🚌 Bus</option>
                                        <option value="voiture">🚗 Voiture</option>
                                        <option value="velo">🚲 Vélo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="distance"><i class="bi bi-rulers"></i> Distance (en km)</label>
                                    <input type="number" id="distance" class="form-control" name="distance" placeholder="Distance aller-retour en kilomètres" min="0" step="0.1" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="voyageurs"><i class="bi bi-people-fill"></i> Nombre de Voyageurs</label>
                                    <input type="number" id="voyageurs" class="form-control" name="voyageurs" placeholder="Nombre de personnes concernées" min="1" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hebergement"><i class="bi bi-house-door-fill"></i> Type d'Hébergement</label>
                                    <select class="form-control" id="hebergement" name="hebergement" required>
                                        <option value="" disabled selected>Sélectionner un type</option>
                                        <option value="hotel_classique">🏨 Hôtel Classique</option>
                                        <option value="auberge_eco">🌿 Auberge Éco-responsable</option>
                                        <option value="camping">⛺ Camping</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1 mb-1">
                                    <i class="bi bi-calculator"></i> Calculer l'Impact
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                    <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="resultatImpact" class="mt-4 p-3 border rounded" style="display: none;">
                    <h5>Résultat de l'Empreinte Carbone (kg de CO2e)</h5>
                    <p>Transport : <strong id="co2Transport"></strong> kg</p>
                    <p>Hébergement : <strong id="co2Hebergement"></strong> kg</p>
                    <p>Total estimé : <strong id="co2Total" class="text-primary fs-4"></strong> kg de CO2 équivalent</p>
                    <small class="text-muted">Ce résultat a été enregistré dans votre historique.</small>
                </div>

            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('formCalculImpact').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const url = form.action;

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('co2Transport').textContent = data.co2_transport.toFixed(2);
                document.getElementById('co2Hebergement').textContent = data.co2_hebergement.toFixed(2);
                document.getElementById('co2Total').textContent = data.co2_total.toFixed(2);
                document.getElementById('resultatImpact').style.display = 'block';
                alert('✅ Calcul effectué et impact enregistré !');
            } else {
                alert('❌ Erreur lors du calcul de l\'impact.');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur de connexion est survenue.');
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