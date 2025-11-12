<?php
// Début du fichier de vue (aAvis.php)
// Remplacez par le chemin correct si vous utilisez un routeur
require_once '../../controllers/AvisController.php'; 

// Démarrer la session en premier (si ce n'est pas déjà fait ailleurs)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 

$avisController = new AvisController();

// 1. Traiter toute soumission POST (Ceci est nécessaire si vous soumettez directement au contrôleur
// OU si le routeur renvoie le contrôle à cette vue après traitement)
// $avisController->handleRequest(); // Commenté car le contrôleur va gérer sa propre exécution/redirection

// 2. Récupérer les données pour l'affichage (y compris les messages après traitement)
$avis_principaux = $avisController->getAvisPrincipaux();
$note_moyenne = $avisController->getAverageNote();

// ATTENTION : UTILISATION DE LA NOUVELLE MÉTHODE UNIQUE ET CORRIGÉE
$flash_data = $avisController->getAndClearMessage();
$message = $flash_data['message'];
$message_type = $flash_data['type'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis Clients</title>

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
                        <li class="sidebar-item  ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Pages &amp; Configuration</li>
                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link '>
                                <i class="bi bi-chat-heart-fill"></i>
                                <span>Avis</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item ">
                                    <a href="lAvis.php">Liste</a>
                                </li>
                                <li class="submenu-item active ">
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
    <h3>Avis Clients et Évaluations ⭐</h3>
</div>

<div class="page-content">
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-<?php echo htmlspecialchars($message_type); ?> alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($message); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card mb-4 bg-light-primary">
        <div class="card-body text-center">
            <h5 class="card-title">Note Moyenne Globale</h5>
            <p class="card-text display-4 text-primary">
                <?php echo number_format($note_moyenne, 1); ?>/5 
                <i class="bi bi-star-fill text-warning"></i>
            </p>
        </div>
    </div>
    
    <div class="row">
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Laissez votre Avis 👋</h5>
                </div>
                <div class="card-body">
                    <form action="../../controllers/AvisController.php" method="POST"> 
                        <input type="hidden" name="action" value="ajouter_avis">
                        <input type="hidden" name="redirect_to" value="aAvis.php">

                        <div class="form-group">
                            <label for="nom">Votre Nom</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Votre Email (non affiché)</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="note">Note (1 à 5)</label>
                            <select class="form-select" name="note" required>
                                <option value="">Choisir une note</option>
                                <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                                <option value="4">⭐⭐⭐⭐ (Très Bien)</option>
                                <option value="3">⭐⭐⭐ (Moyen)</option>
                                <option value="2">⭐⭐ (Insuffisant)</option>
                                <option value="1">⭐ (Mauvais)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="commentaire">Commentaire</label>
                            <textarea class="form-control" name="commentaire" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            <i class="bi bi-send-fill"></i> Soumettre l'Avis
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Avis des Clients (<?php echo count($avis_principaux); ?>)</h5>
                </div>
                <div class="card-body">
                    
                    <?php if (!empty($avis_principaux)): ?>
                        <?php foreach ($avis_principaux as $avis): 
                            $reponses = $avisController->getReponsesByAvisId($avis->getId());
                            $is_owner = isset($_SESSION['user_id']) && $avis->getUserId() == $_SESSION['user_id'];
                        ?>
                        <div class="mb-4 p-3 border rounded">
                            
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-1">
                                        <i class="bi bi-person-circle"></i> 
                                        <strong><?php echo htmlspecialchars($avis->getNomClient()); ?></strong> 
                                        <?php if ($avis->getUserId()): ?><small class="badge bg-secondary">Membre</small><?php endif; ?>
                                    </p>
                                    <p class="text-warning mb-1">
                                        <?php for ($i = 0; $i < $avis->getNote(); $i++): ?><i class="bi bi-star-fill"></i><?php endfor; ?>
                                        <small class="text-muted ms-2"><?php echo date('d/m/Y H:i', strtotime($avis->getDateAvis())); ?></small>
                                    </p>
                                    <p class="mt-2"><?php echo nl2br(htmlspecialchars($avis->getCommentaire())); ?></p>
                                </div>
                                
                                <div>
                                    <button class="btn btn-outline-danger btn-sm me-2 like-btn" data-id="<?php echo $avis->getId(); ?>">
                                        <i class="bi bi-heart-fill"></i> <span id="likes-<?php echo $avis->getId(); ?>"><?php echo $avis->getLikes(); ?></span>
                                    </button>
                                    
                                    <?php if ($is_owner): ?>
                                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $avis->getId(); ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form method="POST" action="../../controllers/AvisController.php" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis et toutes ses réponses ?');">
                                            <input type="hidden" name="action" value="supprimer_avis">
                                            <input type="hidden" name="id" value="<?php echo $avis->getId(); ?>">
                                            <input type="hidden" name="redirect_to" value="aAvis.php">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    
                                    <button class="btn btn-sm btn-outline-secondary mt-2" data-bs-toggle="collapse" data-bs-target="#repondre-<?php echo $avis->getId(); ?>">
                                        <i class="bi bi-reply"></i> Répondre
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mt-3 ps-4 border-start">
                                <?php foreach ($reponses as $reponse): 
                                    $is_response_owner = isset($_SESSION['user_id']) && $reponse->getUserId() == $_SESSION['user_id'];
                                ?>
                                <div class="p-2 mb-2 bg-light rounded d-flex justify-content-between align-items-start">
                                    <div>
                                        <p class="mb-0">
                                            <strong><?php echo htmlspecialchars($reponse->getNomClient()); ?>:</strong> 
                                            <?php echo nl2br(htmlspecialchars($reponse->getCommentaire())); ?>
                                        </p>
                                        <small class="text-muted"><?php echo date('d/m/Y H:i', strtotime($reponse->getDateAvis())); ?></small>
                                    </div>
                                    <?php if ($is_response_owner): ?>
                                        <form method="POST" action="../../controllers/AvisController.php" class="d-inline ms-3" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réponse ?');">
                                            <input type="hidden" name="action" value="supprimer_reponse">
                                            <input type="hidden" name="id" value="<?php echo $reponse->getId(); ?>">
                                            <input type="hidden" name="redirect_to" value="aAvis.php">
                                            <button type="submit" class="btn btn-sm btn-outline-danger p-1">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>

                                <div class="collapse mt-2" id="repondre-<?php echo $avis->getId(); ?>">
                                    <form action="../../controllers/AvisController.php" method="POST" class="p-2 border rounded bg-white">
                                        <input type="hidden" name="action" value="repondre_avis">
                                        <input type="hidden" name="avis_id" value="<?php echo $avis->getId(); ?>">
                                        <input type="hidden" name="redirect_to" value="aAvis.php">
                                        <div class="form-group mb-2">
                                            <input type="text" class="form-control form-control-sm" name="nom_reponse" placeholder="Votre Nom" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <textarea class="form-control form-control-sm" name="commentaire_reponse" rows="2" placeholder="Votre réponse..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-secondary w-100">
                                            Envoyer la Réponse
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalEdit<?php echo $avis->getId(); ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="../../controllers/AvisController.php" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditLabel">Modifier votre Avis</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="action" value="modifier_avis">
                                            <input type="hidden" name="id" value="<?php echo $avis->getId(); ?>">
                                            <input type="hidden" name="redirect_to" value="aAvis.php">
                                            <div class="form-group">
                                                <label>Commentaire</label>
                                                <textarea class="form-control" name="commentaire" rows="3" required><?php echo htmlspecialchars($avis->getCommentaire()); ?></textarea>
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

                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info">
                            Aucun avis n'a encore été publié. Soyez le premier !
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.like-btn').forEach(button => {
    button.addEventListener('click', function() {
        const avisId = this.dataset.id;
        const button = this;

        fetch('../../controllers/AvisController.php', { // Ciblez le contrôleur directement pour AJAX
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=like_avis&id=${avisId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Met à jour le compteur de likes
                document.getElementById(`likes-${avisId}`).textContent = data.likes;
                // Ajoute une animation/couleur pour montrer que le like a réussi
                button.classList.add('active'); 
            } else {
                alert('Erreur lors de l\'ajout du like: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur AJAX:', error);
            alert('Une erreur de communication est survenue.');
        });
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