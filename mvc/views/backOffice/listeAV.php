<!DOCTYPE html>
<html lang="en">

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
                            <li><a href="./ listeIMP.php">Liste</a></li>
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
            module 
        ***********************************-->




        <!--**********************************
            module
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
    <script src="./js/dashboard/dashboard-2.js"></script>

    <script>
    // Script pour remplir la modal avec les données
    document.addEventListener('DOMContentLoaded', function() {
        var editModal = document.getElementById('editModal');
        if (editModal) {
            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                
                // Récupérer les données des attributs data-*
                var id = button.getAttribute('data-id');
                var transport = button.getAttribute('data-transport');
                var distance = button.getAttribute('data-distance');
                var voyageurs = button.getAttribute('data-voyageurs');
                var hebergement = button.getAttribute('data-hebergement');
                
                console.log('Remplissage modal avec:', id, transport, distance, voyageurs, hebergement);
                
                // Remplir les champs du formulaire
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_transport').value = transport;
                document.getElementById('edit_distance').value = distance;
                document.getElementById('edit_voyageurs').value = voyageurs;
                document.getElementById('edit_hebergement').value = hebergement;
            });
        }
        
        // Afficher les messages de confirmation
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === '1') {
            alert('Opération effectuée avec succès!');
        }
    });
    </script>

</body>
</html>