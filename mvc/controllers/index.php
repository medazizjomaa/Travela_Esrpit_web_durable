<?php
require_once("ImpactController.php");



$controller = new ImpactController();


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