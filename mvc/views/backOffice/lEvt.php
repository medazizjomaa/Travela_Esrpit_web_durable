  <?php
require_once __DIR__ . '/../../controllers/ActiviteEvenementDurableController.php';
$controller = new ActiviteEvenementDurableController();
$evenements = $controller->getAll();
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
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-star-fill"></i>
                                <span>Activités & Evènements</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
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
            <div class="page-heading">
    <h3>Liste des Activités & Événements Durables</h3>
</div>

<div class="container mt-4">
    <table class="table table-striped table-bordered table-responsive">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Lieu</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Responsable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($activites)): ?>
                <?php foreach ($activites as $act): 
                    // Assurez-vous que $act est bien un tableau associatif (Array) pour que cela fonctionne.
                    // Si $act est un objet, remplacez $act['colonne'] par $act->getColone() si vous utilisez des accesseurs.
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($act['id'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($act['nom'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($act['type'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($act['lieu'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($act['date_debut'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($act['date_fin'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($act['responsable'] ?? ''); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                onclick="setEditData(
                                    <?php echo $act['id'] ?? 'null'; ?>, 
                                    '<?php echo htmlspecialchars($act['nom'] ?? ''); ?>', 
                                    '<?php echo htmlspecialchars(addslashes($act['description'] ?? '')); ?>', 
                                    '<?php echo htmlspecialchars($act['type'] ?? ''); ?>', 
                                    '<?php echo htmlspecialchars($act['lieu'] ?? ''); ?>', 
                                    '<?php echo htmlspecialchars($act['date_debut'] ?? ''); ?>', 
                                    '<?php echo htmlspecialchars($act['date_fin'] ?? ''); ?>', 
                                    '<?php echo htmlspecialchars($act['responsable'] ?? ''); ?>',
                                    '<?php echo htmlspecialchars($act['image_url'] ?? ''); ?>',
                                    '<?php echo htmlspecialchars($act['video_url'] ?? ''); ?>'
                                )">
                                Modifier
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $act['id'] ?? 'null'; ?>)">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Aucune activité ou événement trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier l'Activité/Événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="lEvt.php?action=update">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editIdAct">
                    
                    <div class="mb-3">
                        <label for="editNom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="editNom" name="nom" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editType" class="form-label">Type</label>
                        <select class="form-control" id="editType" name="type" required>
                            <option value="Activité">Activité</option>
                            <option value="Événement">Événement</option>
                            </select>
                    </div>

                    <div class="mb-3">
                        <label for="editLieu" class="form-label">Lieu</label>
                        <input type="text" class="form-control" id="editLieu" name="lieu" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editDateDebut" class="form-label">Date de Début</label>
                            <input type="datetime-local" class="form-control" id="editDateDebut" name="date_debut" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editDateFin" class="form-label">Date de Fin</label>
                            <input type="datetime-local" class="form-control" id="editDateFin" name="date_fin" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editResponsable" class="form-label">Responsable</label>
                        <input type="text" class="form-control" id="editResponsable" name="responsable" required>
                    </div>

                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="editImageUrl" class="form-label">URL Image</label>
                        <input type="url" class="form-control" id="editImageUrl" name="image_url">
                    </div>

                    <div class="mb-3">
                        <label for="editVideoUrl" class="form-label">URL Vidéo</label>
                        <input type="url" class="form-control" id="editVideoUrl" name="video_url">
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
function setEditData(id, nom, description, type, lieu, date_debut, date_fin, responsable, image_url, video_url) {
    // Remplir les champs du Modal de modification
    document.getElementById('editIdAct').value = id;
    document.getElementById('editNom').value = nom;
    document.getElementById('editDescription').value = description;
    document.getElementById('editType').value = type;
    document.getElementById('editLieu').value = lieu;
    document.getElementById('editResponsable').value = responsable;
    document.getElementById('editImageUrl').value = image_url;
    document.getElementById('editVideoUrl').value = video_url;
    
    // Les champs de date/heure peuvent nécessiter un formatage spécifique
    // Si date_debut/date_fin sont au format YYYY-MM-DD HH:MM:SS, on les ajuste pour input type="datetime-local"
    const formatDateTime = (dateTimeString) => {
        if (!dateTimeString) return '';
        // Input datetime-local attend YYYY-MM-DDTHH:MM
        return dateTimeString.replace(' ', 'T').substring(0, 16); 
    };

    document.getElementById('editDateDebut').value = formatDateTime(date_debut);
    document.getElementById('editDateFin').value = formatDateTime(date_fin);
}

function confirmDelete(id) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette Activité/Événement ?')) {
        // Redirection vers le contrôleur avec l'action 'delete'
        window.location.href = 'lEvt.php?action=delete&id=' + id;
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