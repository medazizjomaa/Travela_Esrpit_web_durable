<?php
require_once __DIR__ . '/../../controllers/resController.php';
$controller = new ReservationController();
$reservations = $controller->getAllReservations();
$destinations = $controller->getAllDestinations();  // Pour la liste déroulante
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
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-calendar-event-fill"></i>
                                <span>Réservations</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active ">
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
    <h3>Liste de Réservations</h3>
</div>

<div class="container mt-4">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID Réservation</th>
                <th>ID Client</th>
                <th>Destination</th>
                <th>Date Réservation</th>
                <th>Type</th>
                <th>Nombre de Personnes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($reservations)): ?>
                <?php foreach ($reservations as $res): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($res['id_res']); ?></td>
                        <td><?php echo htmlspecialchars($res['idclient']); ?></td>
                        <td><?php echo htmlspecialchars($res['nom_dest']); ?></td>
                        <td><?php echo htmlspecialchars($res['date_res']); ?></td>
                        <td><?php echo htmlspecialchars($res['type_res']); ?></td>
                        <td><?php echo htmlspecialchars($res['nbr_personnes']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                    onclick="setEditData(<?php echo $res['id_res']; ?>, <?php echo $res['idclient']; ?>, <?php echo $res['id_dest']; ?>, '<?php echo htmlspecialchars($res['date_res']); ?>', '<?php echo htmlspecialchars($res['type_res']); ?>', <?php echo $res['nbr_personnes']; ?>)">
                                Modifier
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $res['id_res']; ?>)">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Aucune réservation trouvée.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal pour modifier -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier la Réservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="lRes.php?action=update">
                <div class="modal-body">
                    <input type="hidden" name="id_res" id="editIdRes">
                    <div class="mb-3">
                        <label for="editIdClient" class="form-label">ID Client</label>
                        <input type="number" class="form-control" id="editIdClient" name="idclient" required>
                    </div>
                    <div class="mb-3">
                        <label for="editIdDest" class="form-label">Destination</label>
                        <select class="form-control" id="editIdDest" name="id_dest" required>
                            <?php foreach ($destinations as $dest): ?>
                                <option value="<?php echo $dest['id_dest']; ?>"><?php echo htmlspecialchars($dest['nom_dest']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDateRes" class="form-label">Date de Réservation</label>
                        <input type="date" class="form-control" id="editDateRes" name="date_res" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTypeRes" class="form-label">Type de Réservation</label>
                        <input type="text" class="form-control" id="editTypeRes" name="type_res" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNbrPersonnes" class="form-label">Nombre de Personnes</label>
                        <input type="number" class="form-control" id="editNbrPersonnes" name="nbr_personnes" min="1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function setEditData(id, idclient, id_dest, date_res, type_res, nbr_personnes) {
    document.getElementById('editIdRes').value = id;
    document.getElementById('editIdClient').value = idclient;
    document.getElementById('editIdDest').value = id_dest;
    document.getElementById('editDateRes').value = date_res;
    document.getElementById('editTypeRes').value = type_res;
    document.getElementById('editNbrPersonnes').value = nbr_personnes;
}

function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')) {
        window.location.href = 'lRes.php?action=delete&id=' + id;
    }
}
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
