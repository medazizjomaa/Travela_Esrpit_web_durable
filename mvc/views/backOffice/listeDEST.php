<?php
require_once __DIR__ . '/../../controllers/DestinationControllers.php'; // adjust the path if needed
$destinationController = new DestinationController();

// Handle POST actions (edit/delete)
$destinationController->handleActions();

// Fetch all destinations
$destinations = $destinationController->listeDestinations();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>TRAVELA</title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <link href="./vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="./vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <style>
        .btn-sm { padding: 0.25rem 0.5rem; font-size: 0.875rem; }
        .d-flex { display: flex; }
        .me-2 { margin-right: 0.5rem; }
    </style>
</head>

<body>

<div id="main-wrapper">

    <!-- Header start -->
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
    <!-- Header end -->

    <!-- Sidebar start -->
    <div class="quixnav">
        <div class="quixnav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label first"> Menu</li>
                <li><a class="has-arrow" href="./index.php" aria-expanded="false"><i class="fa-regular fa-house"></i><span>Acceuil</span></a></li>
                <li class="nav-label">MODULES</li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-calendar"></i><span class="nav-text">Les Evenements</span></a>
                    <ul aria-expanded="false">
                        <li><a href="./listeEV.php">Liste</a></li>
                        <li><a href="./ajoutEV.php">Ajout</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-location-dot"></i><span class="nav-text">Destinations&Réservations</span></a>
                    <ul aria-expanded="false">
                        <li><a href="./listeDEST.php">Liste</a></li>
                        <li><a href="./ajoutDEST.php">Ajout</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-earth-americas"></i><span class="nav-text">Les impacts Ecologiques</span></a>
                    <ul aria-expanded="false">
                        <li><a href="./listeIMP.php">Liste</a></li>
                        <li><a href="./ajoutIMP.php">Ajout</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-comment"></i><span class="nav-text">Les avis</span></a>
                    <ul aria-expanded="false">
                        <li><a href="./listeAV.php">Liste</a></li>
                        <li><a href="./ajoutAV.php">Ajout</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-user"></i><span class="nav-text">Les utilisateurs</span></a>
                    <ul aria-expanded="false">
                        <li><a href="./listeUS.php">Liste</a></li>
                        <li><a href="./ajoutUS.php">Ajout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- Sidebar end -->

    <!--********************************** Main Content ***********************************-->
    <div class="content-body">
        <div class="container-fluid mt-4">
            <h3>Liste des Destinations & Réservations</h3>

            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success">Opération effectuée avec succès!</div>
            <?php elseif(isset($_GET['error'])): ?>
                <div class="alert alert-danger">Une erreur est survenue!</div>
            <?php endif; ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Place</th>
                        <th>Persons</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($destinations)): ?>
                        <?php foreach($destinations as $dest): ?>
                            <tr>
                                <td><?= htmlspecialchars($dest['idresdev']) ?></td>
                                <td><?= htmlspecialchars($dest['mailclient']) ?></td>
                                <td><?= htmlspecialchars($dest['mailclient']) ?></td>
                                <td><?= htmlspecialchars($dest['phonenumber']) ?></td>
                                <td><?= htmlspecialchars($dest['placename']) ?></td>
                                <td><?= htmlspecialchars($dest['nbrpersons']) ?></td>
                                <td><?= htmlspecialchars($dest['price']) ?></td>
                                <td>
                                    <form method="POST" style="display:inline-block;">
                                        <input type="hidden" name="action" value="modifier">
                                        <input type="hidden" name="id" value="<?= $dest['idresdev'] ?>">
                                        <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                    </form>

                                    <form method="POST" style="display:inline-block;" onsubmit="return confirm('Voulez-vous vraiment supprimer ?');">
                                        <input type="hidden" name="action" value="supprimer">
                                        <input type="hidden" name="id" value="<?= $dest['idresdev'] ?>">
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-center">Aucune réservation trouvée</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div> <!-- end main-wrapper -->

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="./vendor/global/global.min.js"></script>
<script src="./js/quixnav-init.js"></script>
<script src="./js/custom.min.js"></script>
<script src="./vendor/chartist/js/chartist.min.js"></script>
<script src="./vendor/moment/moment.min.js"></script>
<script src="./vendor/pg-calendar/js/pignose.calendar.min.js"></script>
<script src="./js/dashboard/dashboard-2.js"></script>
</body>
</html>
