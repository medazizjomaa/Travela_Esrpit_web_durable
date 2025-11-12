<?php
// Vue: travela/mvc/views/backOffice/lAvis.php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Assurez-vous que le chemin est correct depuis la vue
require_once '../../controllers/AvisController.php'; 

$controller = new AvisController();
$avis_principaux = $controller->getAvisPrincipaux();
$note_moyenne = $controller->getAverageNote();
// Récupérer et effacer le message de session
$feedback = $controller->getAndClearMessage();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Avis</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets1/css/bootstrap.css">

    <link rel="stylesheet" href="assets1/vendors/iconly/bold.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets1/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets1/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-chat-heart-fill"></i>
                                <span>Avis</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item active">
                                    <a href="lAvis.php">Liste</a>
                                </li>
                                <li class="submenu-item  ">
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
            
            <?php if (!empty($feedback['message'])): ?>
                <div class="alert alert-<?php echo ($feedback['type'] === 'success' ? 'success' : 'danger'); ?> alert-dismissible fade show mx-3" role="alert">
                    <?php echo htmlspecialchars($feedback['message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

<div class="container mt-5">
    
    <h2>Avis existants💬 <span class="badge bg-success">Note Moyenne: <?php echo $note_moyenne; ?>/5</span></h2>
    <?php if (empty($avis_principaux)): ?>
        <p>Aucun avis principal trouvé.</p>
    <?php else: ?>
        <?php 
        /** @var Avis $avis */
        foreach ($avis_principaux as $avis): 
        ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($avis->getNomClient()); ?> 
                        (<?php echo htmlspecialchars($avis->getEmail()); ?>)
                        <span class="badge bg-info text-dark ms-2"><?php echo $avis->getNote(); ?>/5 <i class="fas fa-star"></i></span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">Posté le <?php echo date('d/m/Y H:i', strtotime($avis->getDateAvis())); ?></h6>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($avis->getCommentaire())); ?></p>
                    
                    <button class="btn btn-sm btn-outline-secondary like-btn" data-id="<?php echo $avis->getId(); ?>">
                        <i class="far fa-thumbs-up"></i> J'aime (<span id="likes-<?php echo $avis->getId(); ?>"><?php echo $avis->getLikes(); ?></span>)
                    </button>

                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" 
                        onclick="setEditAvisData(<?php echo $avis->getId(); ?>, '<?php echo htmlspecialchars(addslashes($avis->getNomClient())); ?>', '<?php echo htmlspecialchars(addslashes($avis->getEmail())); ?>', <?php echo $avis->getNote(); ?>, '<?php echo htmlspecialchars(addslashes($avis->getCommentaire())); ?>', 'avis')">
                        Modifier
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo $avis->getId(); ?>, 'supprimer_avis')">
                        Supprimer
                    </button>

                    <hr>
                    <h6>Réponses:</h6>
                    
                    <?php 
                    $reponses = $controller->getReponsesByAvisId($avis->getId());
                    if (!empty($reponses)):
                        /** @var Avis $reponse */
                        foreach ($reponses as $reponse):
                    ?>
                        <div class="ms-4 p-2 bg-light border-start border-primary border-4 mb-2">
                            <p class="mb-1"><strong><?php echo htmlspecialchars($reponse->getNomClient()); ?></strong>
                                <small class="text-muted ms-2"><?php echo date('d/m/Y H:i', strtotime($reponse->getDateAvis())); ?></small></p>
                            <p class="mb-1"><?php echo nl2br(htmlspecialchars($reponse->getCommentaire())); ?></p>
                            
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" 
                                onclick="setEditAvisData(<?php echo $reponse->getId(); ?>, '<?php echo htmlspecialchars(addslashes($reponse->getNomClient())); ?>', '<?php echo htmlspecialchars(addslashes($reponse->getEmail())); ?>', null, '<?php echo htmlspecialchars(addslashes($reponse->getCommentaire())); ?>', 'reponse')">
                                Modifier Rep.
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?php echo $reponse->getId(); ?>, 'supprimer_reponse')">
                                Supprimer Rep.
                            </button>
                            <button class="btn btn-sm btn-outline-secondary like-btn" data-id="<?php echo $reponse->getId(); ?>">
                                <i class="far fa-thumbs-up"></i> J'aime (<span id="likes-<?php echo $reponse->getId(); ?>"><?php echo $reponse->getLikes(); ?></span>)
                            </button>
                        </div>
                    <?php endforeach; endif; ?>

                    <button class="btn btn-sm btn-success mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#reply-<?php echo $avis->getId(); ?>">
                        Répondre
                    </button>
                    <div class="collapse mt-2" id="reply-<?php echo $avis->getId(); ?>">
                        <form method="POST" action="../../controllers/AvisController.php" class="p-3 border rounded">
                            <input type="hidden" name="action" value="repondre_avis">
                            <input type="hidden" name="avis_id" value="<?php echo $avis->getId(); ?>">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="nom_reponse" placeholder="Votre Nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="email" class="form-control" name="email_reponse" placeholder="Votre Email (Optionnel)">
                                </div>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="commentaire_reponse" rows="2" placeholder="Votre réponse..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Envoyer la Réponse</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifier l'Avis/la Réponse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../../controllers/AvisController.php" id="editForm"> 
                <div class="modal-body">
                    <input type="hidden" name="id" id="editId">
                    <input type="hidden" name="action" id="editAction">
                    
                    <div class="mb-3">
                        <label for="editNom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="editNom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="mb-3" id="editNoteContainer">
                        <label for="editNote" class="form-label">Note (1-5)</label>
                        <input type="number" class="form-control" id="editNote" name="note" min="1" max="5">
                    </div>
                    <div class="mb-3">
                        <label for="editCommentaire" class="form-label">Commentaire</label>
                        <textarea class="form-control" id="editCommentaire" name="commentaire" rows="3" required></textarea>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // JS pour remplir le modal de modification
    function setEditAvisData(id, nom, email, note, commentaire, type) {
        document.getElementById('editId').value = id;
        document.getElementById('editNom').value = nom;
        document.getElementById('editEmail').value = email;
        document.getElementById('editCommentaire').value = commentaire;

        const noteContainer = document.getElementById('editNoteContainer');
        const noteInput = document.getElementById('editNote');

        if (type === 'avis') {
            document.getElementById('editAction').value = 'modifier_avis';
            noteContainer.style.display = 'block';
            noteInput.required = true;
            noteInput.value = note;
        } else { // type === 'reponse'
            document.getElementById('editAction').value = 'modifier_reponse';
            noteContainer.style.display = 'none';
            noteInput.required = false;
            noteInput.value = '';
        }
    }

    // JS pour la confirmation de suppression
    function confirmDelete(id, action) {
        if (confirm(`Êtes-vous sûr de vouloir supprimer ${action === 'supprimer_avis' ? 'cet avis et ses réponses' : 'cette réponse'}?`)) {
            // Créer un formulaire POST dynamique
            const form = document.createElement('form');
            form.method = 'POST';
            // CORRECTION: Assurez-vous que l'action pointe correctement vers le contrôleur
            form.action = '../../controllers/AvisController.php'; 

            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = id;

            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;

            form.appendChild(idInput);
            form.appendChild(actionInput);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // JS pour la gestion des Likes (AJAX)
    $(document).ready(function() {
        $('.like-btn').on('click', function() {
            const avisId = $(this).data('id');
            const likeSpan = $('#likes-' + avisId);

            $.post('../../controllers/AvisController.php', {
                action: 'like_avis',
                id: avisId
            }, function(response) {
                if (response.success) {
                    likeSpan.text(response.likes);
                    // Rendre le bouton "aimé" visuellement
                    // Vous pouvez ajouter une classe 'btn-primary' au lieu de 'btn-outline-secondary'
                    // Ou simplement un petit effet visuel.
                } else {
                    alert('Erreur: ' + response.message);
                }
            }, 'json');
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