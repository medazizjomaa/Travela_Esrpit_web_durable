<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Inclure les fichiers nécessaires - ADAPTEZ LES CHEMINS SELON VOTRE STRUCTURE
require_once __DIR__ . '/../../../controllers/ActiviteEvenementDurableController1.php';
require_once __DIR__ . '/../../../models/activites_evenement_durables.php';
require_once __DIR__ . '/../../../DBConnection.php';

try {
    $controller = new ActiviteEvenementDurableController();
    $activites = $controller->getAll();
    
    // Convertir les objets en tableau pour JSON
    $activitesArray = [];
    foreach ($activites as $activite) {
        $activitesArray[] = [
            'id' => $activite->getId(),
            'nom' => $activite->getNom(),
            'description' => $activite->getDescription(),
            'type' => $activite->getType(),
            'lieu' => $activite->getLieu(),
            'date_debut' => $activite->getDateDebut(),
            'date_fin' => $activite->getDateFin(),
            'responsable' => $activite->getResponsable(),
            'image_url' => $activite->getImageUrl(),
            'video_url' => $activite->getVideoUrl()
        ];
    }
    
    echo json_encode($activitesArray);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors du chargement des activités: ' . $e->getMessage()]);
}
?>