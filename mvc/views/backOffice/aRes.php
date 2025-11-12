
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✈️ Ajouter une Réservation - Dashboard</title>

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
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-calendar-event-fill"></i>
                                <span>Réservations</span>
                            </a>
                            <ul class="submenu active ">
                                <li class="submenu-item ">
                                    <a href="lRes.php">Liste</a>
                                </li>
                                <li class="submenu-item active ">
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
<div class="page-heading">
                <h3>Ajouter une Nouvelle Réservation ✈️</h3>
            </div>
            <div class="page-content">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Remplissez les informations de la Réservation</h4>
                        </div>
                        <div class="card-body">
                            <form action="../../controllers/resController.php?action=addReservation" method="POST" class="form form-vertical">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="destination"><i class="bi bi-geo-alt-fill"></i> Destination (Nom)</label>
                                                <input type="text" id="destination" class="form-control" name="destination" placeholder="Ex: Paris, Tokyo..." required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="date_reservation"><i class="bi bi-calendar-check-fill"></i> Date de Réservation</label>
                                                <input type="date" id="date_reservation" class="form-control" name="date_reservation" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="type"><i class="bi bi-tags-fill"></i> Type de Réservation</label>
                                                <select class="form-control" id="type" name="type" required>
                                                    <option value="" disabled selected>Sélectionner un type</option>
                                                  
                                                    <option value="en groupe">🏨 En groupe</option>
                        
                                                    <option value="ind">🏄 Individuel</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nbr_personne"><i class="bi bi-people-fill"></i> Nombre de Personnes</label>
                                                <input type="number" id="nbr_personne" class="form-control" name="nbr_personne" placeholder="Nombre de personnes" min="1" required>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">
                                                <i class="bi bi-box-arrow-in-right"></i> Enregistrer
                                            </button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                                <i class="bi bi-arrow-counterclockwise"></i> Réinitialiser
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
             
        </div>
    </div>
    <script src="assets1/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets1/js/bootstrap.bundle.min.js"></script>

    <script src="assets1/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets1/js/pages/dashboard.js"></script>

    <script src="assets1/js/main.js"></script>
</body>

</html>