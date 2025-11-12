<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/../../controllers/ImpactController.php';
require_once __DIR__ . '/../../models/ImpactEcologique.php';


$controller = new ImpactController();
$impacts = $controller->getAllImpacts();
?>
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>TRAVELA </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="./vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="./vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

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
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!-- Votre header et sidebar existants restent ici -->
        <!--**********************************
            Header start
        ***********************************-->
       <div class="nav-header">
             

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
         <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">     
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="./index.php" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>    
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Sidebar start
        ***********************************-->
                <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first"> Menu</li>
                    <li><a class="has-arrow" href= "./index.php" aria-expanded="false"><i class="fa-regular fa-house"></i><span  >Acceuil</span></a>
                         
                    </li>
                    <li class="nav-label">MODULES</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-calendar"></i><span class="nav-text">Les Evenements</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./listeEV.php">Liste</a></li>
                            <li><a href="./ajoutEV.php">Ajout</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-location-dot"></i><span class="nav-text">Destinations&Réservations</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./listeDEST.php">Liste</a></li>
                            <li><a href="./ajoutDEST.php">Ajout</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-earth-americas"></i><span class="nav-text">Les impacts Ecologiques</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./listeIMP.php">Liste</a></li>
                            <li><a href="./ajoutIMP.php">Ajout</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-comment"></i><span class="nav-text">Les avis</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./listeAV.php">Liste</a></li>
                            <li><a href="./ajoutAV.php">Ajout</a></li>
                            
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-user"></i><span class="nav-text">Les utilisateurs</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./listeUS.php">Liste</a></li>
                            <li><a href="./ajoutUS.php">Ajout</a></li>
                            
                        </ul>
                    </li>
                    
                     
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <?php
        require_once __DIR__ . '/../../controllers/ImpactController.php';
        require_once __DIR__ . '/../../models/ImpactEcologique.php';


        
        // Traitement du formulaire d'ajout
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
            $controller = new ImpactController();
            
            $transport = $_POST['transport'] ?? '';
            $distance = floatval($_POST['distance'] ?? 0);
            $voyageurs = intval($_POST['voyageurs'] ?? 1);
            $hebergement = $_POST['hebergement'] ?? '';
            
            if (!empty($transport) && $distance > 0 && $voyageurs > 0 && !empty($hebergement)) {
                // Créer l'objet ImpactEcologique
                $impact = new ImpactEcologique($transport, $distance, $voyageurs, $hebergement);
                
                // Calculer le CO2
                $co2_total = $controller->calculerImpact($impact);
                
                // Ajouter à la base de données
                $controller->ajouter($impact, $co2_total);
                
                // Message de succès
                $success_message = "L'impact écologique a été ajouté avec succès ! CO2 Total: " . number_format($co2_total, 2) . " kg";
            } else {
                $error_message = "Veuillez remplir tous les champs correctement.";
            }
        }
        ?>
        
        <div class="content-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="fas fa-leaf me-2"></i>Ajouter un Impact Écologique
                                </h4>
                                <a href="./listeIMP.php" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste
                                </a>
                            </div>
                            <div class="card-body">
                                <!-- Messages d'alerte -->
                                <?php if(isset($success_message)): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <strong>Succès !</strong> <?php echo $success_message; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(isset($error_message)): ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <strong>Erreur !</strong> <?php echo $error_message; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="transport" class="form-label">
                                                <i class="fas fa-car me-1"></i>Mode de Transport
                                            </label>
                                            <select class="form-control" id="transport" name="transport" required>
                                                <option value="">Sélectionnez un transport</option>
                                                <option value="avion">✈️ Avion</option>
                                                <option value="train">🚆 Train</option>
                                                <option value="bus">🚌 Bus</option>
                                                <option value="voiture">🚗 Voiture</option>
                                                <option value="velo">🚲 Vélo</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="distance" class="form-label">
                                                <i class="fas fa-road me-1"></i>Distance (km)
                                            </label>
                                            <input type="number" class="form-control" id="distance" name="distance" 
                                                   step="0.1" min="0" placeholder="Ex: 150.5" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="voyageurs" class="form-label">
                                                <i class="fas fa-users me-1"></i>Nombre de Voyageurs
                                            </label>
                                            <input type="number" class="form-control" id="voyageurs" name="voyageurs" 
                                                   min="1" max="100" placeholder="Ex: 2" required>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="hebergement" class="form-label">
                                                <i class="fas fa-hotel me-1"></i>Type d'Hébergement
                                            </label>
                                            <select class="form-control" id="hebergement" name="hebergement" required>
                                                <option value="">Sélectionnez un hébergement</option>
                                                <option value="hotel_classique">🏨 Hôtel Classique</option>
                                                <option value="auberge_eco">🌿 Auberge Écologique</option>
                                                <option value="camping">⛺ Camping</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Informations sur les émissions -->
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="fas fa-info-circle me-2"></i>Informations sur les émissions
                                                    </h6>
                                                    <small class="text-muted">
                                                        <strong>Transport:</strong> Avion (250g/km) • Train (40g/km) • Bus (80g/km) • Voiture (120g/km) • Vélo (0g/km)<br>
                                                        <strong>Hébergement:</strong> Hôtel (30kg) • Auberge écologique (10kg) • Camping (5kg)
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" name="ajouter" class="btn btn-primary btn-lg">
                                                <i class="fas fa-plus-circle me-2"></i>Ajouter l'Impact Écologique
                                            </button>
                                            <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                                <i class="fas fa-redo me-2"></i>Réinitialiser
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts existants -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./vendor/chartist/js/chartist.min.js"></script>
    <script src="./vendor/moment/moment.min.js"></script>
    <script src="./vendor/pg-calendar/js/pignose.calendar.min.js"></script>

    <script>
    // Script pour améliorer l'expérience utilisateur
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-fermer les alertes après 5 secondes
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert.isConnected) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 5000);
        });

        // Validation en temps réel
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const distance = document.getElementById('distance');
                const voyageurs = document.getElementById('voyageurs');
                
                if (distance.value <= 0) {
                    e.preventDefault();
                    alert('La distance doit être supérieure à 0 km.');
                    distance.focus();
                    return false;
                }
                
                if (voyageurs.value < 1) {
                    e.preventDefault();
                    alert('Le nombre de voyageurs doit être au moins 1.');
                    voyageurs.focus();
                    return false;
                }
                
                return true;
            });
        });

        // Animation sur les champs
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    });
    </script>

</body>
</html>