<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>TRAVELA - Gestion des Clients</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <link href="./vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="./vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --success-color: #00b09b;
            --warning-color: #ff9a9e;
            --info-color: #a8c0ff;
        }
        
        .client-card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border: none;
        }
        .client-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .status-active {
            background-color: #e6f7ee;
            color: #00a65a;
        }
        .status-inactive {
            background-color: #fdeaea;
            color: #e74c3c;
        }
        .status-pending {
            background-color: #fff8e6;
            color: #f39c12;
        }
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 12px;
            padding: 20px;
        }
        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin: 0 3px;
        }
        .search-box {
            border-radius: 20px;
            padding-left: 40px;
        }
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }
    </style>
</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
        </div>
    </div>

    <!-- Notification Toast -->
    <div class="notification-toast">
        <?php
        session_start();
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>' . $_SESSION['success'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>' . $_SESSION['error'] . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            unset($_SESSION['error']);
        }
        ?>
    </div>

    <!-- Main Wrapper -->
    <div id="main-wrapper">

        <!-- Header et Sidebar (contenu existant) -->
        <!-- ... -->

        <!-- Content Body -->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Gestion des Clients</h4>
                            <p class="mb-0">Gérez tous vos clients depuis cette interface</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
                            <i class="fas fa-plus me-2"></i>Nouveau Client
                        </button>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-xl-3 col-sm-6">
                        <div class="stats-card mb-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2 class="text-white" id="totalClients">0</h2>
                                    <p class="mb-0">Clients Totaux</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-2x text-white-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="stats-card mb-4" style="background: linear-gradient(135deg, #00b09b 0%, #96c93d 100%);">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2 class="text-white" id="activeClients">0</h2>
                                    <p class="mb-0">Clients Actifs</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-user-check fa-2x text-white-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="stats-card mb-4" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2 class="text-white" id="newClients">0</h2>
                                    <p class="mb-0">Nouveaux (30j)</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-user-plus fa-2x text-white-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="filter-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" class="form-control search-box" id="searchInput" placeholder="Rechercher un client...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">Tous les statuts</option>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sortFilter">
                                <option value="date_desc">Date d'inscription (Récent)</option>
                                <option value="date_asc">Date d'inscription (Ancien)</option>
                                <option value="name_asc">Nom (A-Z)</option>
                                <option value="name_desc">Nom (Z-A)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Clients Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card client-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Liste des Clients</h4>
                                <div class="d-flex">
                                    <button class="btn btn-outline-secondary btn-sm me-2" id="refreshBtn">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" id="clientsTable">
                                        <thead>
                                            <tr>
                                                <th>Client</th>
                                                <th>Email</th>
                                                <th>Téléphone</th>
                                                <th>Date d'inscription</th>
                                                <th>Statut</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="clientsTableBody">
                                            <?php
                                            // Récupération des données depuis la base via ClientController
                                            try {
                                                require_once '../controllers/ClientController.php';
                                                $controller = new UnifiedClientController();
                                                
                                                // Récupérer tous les clients
                                                $stmt = $controller->db->query("SELECT * FROM client ORDER BY idclient DESC");
                                                $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                
                                                if (empty($clients)) {
                                                    echo '<tr>
                                                        <td colspan="6" class="text-center py-4">
                                                            <i class="fas fa-users fa-2x text-muted mb-2"></i>
                                                            <p class="text-muted">Aucun client trouvé</p>
                                                        </td>
                                                    </tr>';
                                                } else {
                                                    foreach ($clients as $client) {
                                                        $initials = substr($client['prenomclient'] ?? '', 0, 1) . substr($client['nomclient'] ?? '', 0, 1);
                                                        $status = 'active';
                                                        $statusText = 'Actif';
                                                        
                                                        echo '
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="client-avatar me-3">' . strtoupper($initials) . '</div>
                                                                    <div>
                                                                        <h6 class="mb-0">' . htmlspecialchars($client['prenomclient'] . ' ' . $client['nomclient']) . '</h6>
                                                                        <small class="text-muted">ID: CL-' . str_pad($client['idclient'], 3, '0', STR_PAD_LEFT) . '</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>' . htmlspecialchars($client['mailclient']) . '</td>
                                                            <td>' . htmlspecialchars($client['telephone'] ?? 'Non renseigné') . '</td>
                                                            <td>' . (isset($client['date_inscription']) ? date('d/m/Y', strtotime($client['date_inscription'])) : 'Non renseignée') . '</td>
                                                            <td><span class="status-badge status-' . $status . '">' . $statusText . '</span></td>
                                                            <td>
                                                                <button class="btn btn-light btn-sm action-btn view-client" data-id="' . $client['idclient'] . '" data-bs-toggle="tooltip" title="Voir détails">
                                                                    <i class="fas fa-eye text-primary"></i>
                                                                </button>
                                                                <button class="btn btn-light btn-sm action-btn edit-client" data-id="' . $client['idclient'] . '" data-bs-toggle="tooltip" title="Modifier">
                                                                    <i class="fas fa-edit text-success"></i>
                                                                </button>
                                                                <button class="btn btn-light btn-sm action-btn delete-client" data-id="' . $client['idclient'] . '" data-bs-toggle="tooltip" title="Supprimer">
                                                                    <i class="fas fa-trash text-danger"></i>
                                                                </button>
                                                            </td>
                                                        </tr>';
                                                    }
                                                }
                                            } catch (Exception $e) {
                                                echo '<tr>
                                                    <td colspan="6" class="text-center py-4 text-danger">
                                                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                                        <p>Erreur de chargement des données</p>
                                                    </td>
                                                </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout de client -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Ajouter un nouveau client</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addClientForm" action="../controllers/ClientController.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="register">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label">Prénom *</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mot de passe *</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <span class="password-toggle" onclick="togglePassword('password')">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirmPassword" class="form-label">Confirmer le mot de passe *</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                    <span class="password-toggle" onclick="togglePassword('confirmPassword')">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Créer le compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de modification de client -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClientModalLabel">Modifier le client</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editClientForm" action="../controllers/ClientController.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="update_profile">
                        <input type="hidden" id="edit_idclient" name="idclient">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edit_nomclient" class="form-label">Nom *</label>
                                <input type="text" class="form-control" id="edit_nomclient" name="nomclient" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="edit_prenomclient" class="form-label">Prénom *</label>
                                <input type="text" class="form-control" id="edit_prenomclient" name="prenomclient" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_mailclient" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="edit_mailclient" name="mailclient" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="edit_telephone" name="telephone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts existants -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script>
    // Fonction pour basculer la visibilité du mot de passe
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Mettre à jour les statistiques
        updateStatistics();
        
        // Auto-hide les alertes après 5 secondes
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Événements pour les boutons d'action
        document.querySelectorAll('.view-client').forEach(button => {
            button.addEventListener('click', function() {
                const clientId = this.getAttribute('data-id');
                viewClientDetails(clientId);
            });
        });

        document.querySelectorAll('.edit-client').forEach(button => {
            button.addEventListener('click', function() {
                const clientId = this.getAttribute('data-id');
                editClient(clientId);
            });
        });

        document.querySelectorAll('.delete-client').forEach(button => {
            button.addEventListener('click', function() {
                const clientId = this.getAttribute('data-id');
                deleteClient(clientId);
            });
        });

        // Recherche en temps réel
        document.getElementById('searchInput').addEventListener('input', filterClients);
        document.getElementById('statusFilter').addEventListener('change', filterClients);
        document.getElementById('sortFilter').addEventListener('change', sortClients);

        // Bouton de rafraîchissement
        document.getElementById('refreshBtn').addEventListener('click', function() {
            location.reload();
        });
    });

    // Mettre à jour les statistiques
    function updateStatistics() {
        const totalClients = document.querySelectorAll('#clientsTableBody tr').length - 1; // Exclure la ligne vide
        document.getElementById('totalClients').textContent = totalClients;
        document.getElementById('activeClients').textContent = totalClients;
        document.getElementById('newClients').textContent = Math.floor(totalClients * 0.3); // Estimation
    }

    // Filtrer les clients
    function filterClients() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value;
        const rows = document.querySelectorAll('#clientsTableBody tr');
        
        rows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const email = row.cells[1].textContent.toLowerCase();
            const status = row.cells[4].textContent.toLowerCase();
            
            const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
            const matchesStatus = !statusFilter || status.includes(statusFilter);
            
            row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
        });
    }

    // Trier les clients
    function sortClients() {
        // Implémentation simple du tri
        alert('Fonction de tri à implémenter');
    }

    // Voir les détails d'un client
    function viewClientDetails(clientId) {
        alert('Détails du client ID: ' + clientId + '\n\nCette fonctionnalité sera implémentée prochainement.');
    }

    // Modifier un client
    function editClient(clientId) {
        // Récupérer les données du client et remplir le modal
        alert('Modification du client ID: ' + clientId + '\n\nCette fonctionnalité sera implémentée prochainement.');
    }

    // Supprimer un client
    function deleteClient(clientId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce client ? Cette action est irréversible.')) {
            // Rediriger vers le contrôleur de suppression
            window.location.href = '../controllers/ClientController.php?action=delete&id=' + clientId;
        }
    }
    </script>

</body>
</html>