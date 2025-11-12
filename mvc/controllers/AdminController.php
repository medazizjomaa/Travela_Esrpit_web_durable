<?php
session_start();

class AdminController {
    public function loginAdmin() {
        if ($_POST['action'] === 'login_admin') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            
            if ($username === 'admin' && $password === 'admin') {
                // Connexion réussie
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                $_SESSION['login_time'] = time();
                
                
                header('Location: /travela/mvc/views/backOffice/index.php');
                exit();
            } else {
               
                $_SESSION['error'] = "Identifiants administrateur incorrects";
                header('Location: /travela/mvc/views/frontOffice/login_admin.php');
                exit();
            }
        }
    }
    
    public function logoutAdmin() {
        
        session_destroy();
        
        
        header('Location: /travela/mvc/views/frontOffice/login_admin.php');
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $controller = new AdminController();
    
    if ($_POST['action'] === 'login_admin') {
        $controller->loginAdmin();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $controller = new AdminController();
    
    if ($_GET['action'] === 'logout') {
        $controller->logoutAdmin();
    }
}
?>