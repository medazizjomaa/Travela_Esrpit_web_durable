     <?php
// Exécutez le contrôleur pour charger les données
require_once '../../controllers/ClientController.php'; 
$controller = new UnifiedClientController();
$clients = $controller->getAllClients(); 
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
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Clients</span>
                            </a>
                            <ul class="submenu active ">
                                <li class="submenu-item active ">
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
    <h3>Liste des Clients</h3>
</div>

<div class="container mt-4">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID Client</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($clients)): ?>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client['idclient']); ?></td>
                        <td><?php echo htmlspecialchars($client['nomclient']); ?></td>
                        <td><?php echo htmlspecialchars($client['prenomclient']); ?></td>
                        <td><?php echo htmlspecialchars($client['mailclient']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                onclick="setEditData(
                                    <?php echo $client['idclient']; ?>, 
                                    '<?php echo htmlspecialchars($client['nomclient']); ?>', 
                                    '<?php echo htmlspecialchars($client['prenomclient']); ?>', 
                                    '<?php echo htmlspecialchars($client['mailclient']); ?>'
                                )">
                                Modifier
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $client['idclient']; ?>)">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Aucun client trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier le Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../../controllers/ClientController.php?action=update">
                <div class="modal-body">
                    <input type="hidden" name="idclient" id="editIdClient">
                    
                    <div class="mb-3">
                        <label for="editNomClient" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="editNomClient" name="nomclient" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editPrenomClient" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="editPrenomClient" name="prenomclient" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editMailClient" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editMailClient" name="mailclient" required>
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
 * Rempli le formulaire du modal de modification avec les données du client sélectionné.
 * @param {number} id - L'ID du client.
 * @param {string} nom - Le nom du client.
 * @param {string} prenom - Le prénom du client.
 * @param {string} email - L'email du client.
 */
function setEditData(id, nom, prenom, email) {
    document.getElementById('editIdClient').value = id;
    document.getElementById('editNomClient').value = nom;
    document.getElementById('editPrenomClient').value = prenom;
    document.getElementById('editMailClient').value = email;
}

/**
 * Affiche une boîte de dialogue de confirmation pour la suppression.
 * @param {number} id - L'ID du client à supprimer.
 */
function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce client ? Cette action est irréversible.')) {
        // L'action pointera vers l'URL du contrôleur avec action=delete
        window.location.href = '../../controllers/ClientController.php?action=delete&id=' + id;
    }
}
</script>
</script>


             
        </div>
    </div>
    <script src="assets1/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets1/js/bootstrap.bundle.min.js"></script>

    <script src="assets1/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets1/js/pages/dashboard.js"></script>

    <script src="assets1/js/main.js"></script>
</body>

</html>