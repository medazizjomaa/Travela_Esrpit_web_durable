<?php
require_once __DIR__ . '/../../controllers/destController.php';
$controller = new DestinationController();
$destinations = $controller->getAllDestinations();
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
                        <li class="sidebar-item  active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-truck-front-fill"></i>
                                <span>Destinations</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
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
                            <ul class="submenu  ">
                                <li class="submenu-item ">
                                    <a href="lRes.php">Liste</a>
                                </li>
                                <li class="submenu-item  ">
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
<?php
// Inclure et exécuter le contrôleur pour récupérer les données et gérer les actions
require_once '../../controllers/destController.php'; 

// Récupérer toutes les destinations pour l'affichage de la liste
$destinations = $controller->getAllDestinations();
?>

<div class="page-heading">
    <h3>Liste des Destinations</h3>
</div>

<div class="container mt-4">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom de la Destination</th>
                <th>Prix (€)</th>
                <th>Image (Chemin)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($destinations)): ?>
                <?php foreach ($destinations as $dest): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($dest['id_dest']); ?></td>
                        <td><?php echo htmlspecialchars($dest['nom_dest']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($dest['prix'], 2, ',', ' ')); ?> €</td>
                        <td><?php echo htmlspecialchars($dest['imageD']); ?></td>
                        <td>
                                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                    onclick="setEditData(
                                        <?php echo $dest['id_dest']; ?>, 
                                        '<?php echo htmlspecialchars($dest['nom_dest']); ?>', 
                                        <?php echo $dest['prix']; ?>,
                                        '<?php echo htmlspecialchars($dest['imageD']); ?>'
                                    )">
                                Modifier
                            </button>
                                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $dest['id_dest']; ?>)">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Aucune destination trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier la Destination</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="lDest.php?action=update">
                <div class="modal-body">
                    <input type="hidden" name="id_dest" id="editIdDest">
                    <div class="mb-3">
                        <label for="editNomDest" class="form-label">Nom de la Destination</label>
                        <input type="text" class="form-control" id="editNomDest" name="nom_dest" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPrix" class="form-label">Prix (€)</label>
                        <input type="number" step="0.01" class="form-control" id="editPrix" name="prix" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImageD" class="form-label">Chemin de l'Image</label>
                        <input type="text" class="form-control" id="editImageD" name="imageD" required>
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

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Ajouter une Nouvelle Destination</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="lDest.php?action=add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="addNomDest" class="form-label">Nom de la Destination</label>
                        <input type="text" class="form-control" id="addNomDest" name="nom_dest" required>
                    </div>
                    <div class="mb-3">
                        <label for="addPrix" class="form-label">Prix (€)</label>
                        <input type="number" step="0.01" class="form-control" id="addPrix" name="prix" required>
                    </div>
                    <div class="mb-3">
                        <label for="addImageD" class="form-label">Chemin de l'Image</label>
                        <input type="text" class="form-control" id="addImageD" name="imageD" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter la Destination</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
/**
 * Fonction JS pour pré-remplir les champs de la modal de modification.
 */
function setEditData(id_dest, nom_dest, prix, imageD) {
    document.getElementById('editIdDest').value = id_dest;
    document.getElementById('editNomDest').value = nom_dest;
    document.getElementById('editPrix').value = prix;
    document.getElementById('editImageD').value = imageD;
}

/**
 * Fonction JS pour confirmer la suppression et rediriger.
 */
function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette destination ? Cette action est irréversible.')) {
        // Redirige vers le contrôleur avec l'action 'delete'
       window.location.href = 'lDest.php?action=delete&id=' + id;
    }
}
</script>
    <script src="assets1/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets1/js/bootstrap.bundle.min.js"></script>

    <script src="assets1/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets1/js/pages/dashboard.js"></script>

    <script src="assets1/js/main.js"></script>
</body>

</html>