<?php
require_once("ImpactController.php");


// Création du contrôleur
$controller = new ImpactController();

// Gestion des actions
$action = isset($_GET['action']) ? $_GET['action'] : 'formulaire';

switch($action) {
    case 'formulaire':
        $controller->afficherFormulaire();
        break;
    case 'calculer':
        $controller->calculer();
        break;
    case 'historique':
        $controller->historique();
        break;
        
    default:
        echo "Action inconnue: " . $action;
}
?>