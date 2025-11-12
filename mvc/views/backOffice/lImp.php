<?php
// TRAITER LES REQUÊTES POST AVANT TOUT OUTPUT HTML
require_once __DIR__ . '/../../controllers/ImpactController.php';
require_once __DIR__ . '/../../models/ImpactEcologique.php';
// Instanciation du contrôleur
$controller = new ImpactController();
// Gestion des actions POST (incluant redirections si nécessaire)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleActions();
    // Si handleActions() fait une redirection (via header()), le script s'arrête ici avec exit().
}
// Récupération des impacts APRÈS le traitement POST
$impacts = $controller->getAllImpacts();
?>
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
                                <li class="submenu-item  active">
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
                        <li class="sidebar-title">Pages</li>
  
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
    <h3>Liste de l'Historique des Impacts Écologiques</h3>
</div>

<div class="container mt-4">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Transport</th>
                <th>Distance (km)</th>
                <th>Voyageurs</th>
                <th>Hébergement</th>
                <th>CO2 Total (kg)</th>
                <th>Date Calcul</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($impacts)): ?>
                <?php foreach ($impacts as $imp): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($imp['ID']); ?></td>
                        <td><?php echo htmlspecialchars($imp['TRANSPORT']); ?></td>
                        <td><?php echo htmlspecialchars($imp['DISTANCE']); ?></td>
                        <td><?php echo htmlspecialchars($imp['VOYAGEURS']); ?></td>
                        <td><?php echo htmlspecialchars($imp['HEBERGEMENT']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($imp['CO2_TOTAL'], 2)); ?></td>
                        <td><?php echo htmlspecialchars($imp['DATE_CALCUL']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editImpactModal" 
                                    onclick="setEditData(
                                        <?php echo $imp['ID']; ?>, 
                                        '<?php echo htmlspecialchars($imp['TRANSPORT']); ?>', 
                                        <?php echo $imp['DISTANCE']; ?>, 
                                        <?php echo $imp['VOYAGEURS']; ?>, 
                                        '<?php echo htmlspecialchars($imp['HEBERGEMENT']); ?>'
                                    )">
                                Modifier
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $imp['ID']; ?>)">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Aucun impact écologique trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="editImpactModal" tabindex="-1" aria-labelledby="editImpactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImpactModalLabel">Modifier l'Impact Écologique</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../../controllers/impactController.php">
                <input type="hidden" name="action" value="update"> 
                <div class="modal-body">
                    <input type="hidden" name="id" id="editIdImpact">

                    <div class="mb-3">
                        <label for="editTransport" class="form-label">Transport</label>
                        <select class="form-control" id="editTransport" name="transport" required>
                            <?php foreach ($transports as $t): ?>
                                <option value="<?php echo $t; ?>"><?php echo ucfirst($t); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="editDistance" class="form-label">Distance (km)</label>
                        <input type="number" step="0.01" class="form-control" id="editDistance" name="distance" required>
                    </div>

                    <div class="mb-3">
                        <label for="editVoyageurs" class="form-label">Nombre de Voyageurs</label>
                        <input type="number" class="form-control" id="editVoyageurs" name="voyageurs" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="editHebergement" class="form-label">Type d'Hébergement</label>
                        <select class="form-control" id="editHebergement" name="hebergement" required>
                            <?php foreach ($hebergements as $h): ?>
                                <option value="<?php echo $h; ?>"><?php echo ucfirst(str_replace('_', ' ', $h)); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
/**
 * Prépare les données pour l'édition dans le modal.
 */
function setEditData(id, transport, distance, voyageurs, hebergement) {
    document.getElementById('editIdImpact').value = id;
    document.getElementById('editTransport').value = transport;
    document.getElementById('editDistance').value = distance;
    document.getElementById('editVoyageurs').value = voyageurs;
    document.getElementById('editHebergement').value = hebergement;
}

/**
 * Demande confirmation avant de supprimer et redirige.
 */
function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement d\'impact écologique ?')) {
        // L'action cible le contrôleur avec l'action 'delete' via GET, comme dans l'exemple de réservation.
        window.location.href = '../../controllers/impactController.php?action=delete&id=' + id;
    }
}
</script>
<script>
function setEditData(id, transport, distance, voyageurs, hebergement) {
    document.getElementById('editId').value = id;
    document.getElementById('editTransport').value = transport;
    document.getElementById('editDistance').value = distance;
    document.getElementById('editVoyageurs').value = voyageurs;
    document.getElementById('editHebergement').value = hebergement;
}

function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet impact ?')) {
        window.location.href = '../view/backOffice/lImp.php?action=delete&id=' + id;
    }
}
</script>

             

     
    </div>
    <script src="assets1/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets1/js/bootstrap.bundle.min.js"></script>

    <script src="assets1/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets1/js/pages/dashboard.js"></script>

    <script src="assets1/js/main.js"></script>
</body>

</html>