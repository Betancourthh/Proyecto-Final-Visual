<?php
// index.php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoloader
spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/Controller/' . $class . '.php',
        __DIR__ . '/Model/' . $class . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return true;
        }
    }
    return false;
});

// Obtener controlador y acción
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'user';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

try {
    switch($controller) {
        case 'user':
            $controller = new UserController();
            switch($action) {
                case 'login':
                    $controller->login();
                    break;
                case 'register':
                case 'showRegister':
                    $controller->showRegister();
                    break;
                case 'showManual':
                    $controller->showManual();
                    break;
                case 'logout':
                    $controller->logout();
                    break;
                default:
                    throw new Exception("Acción no válida para user");
            }
            break;

        case 'catalog':
            $controller = new CatalogController();
            switch($action) {
                case 'index':
                    $controller->index();
                    break;
                case 'detail':
                    $controller->detail();
                    break;
                case 'showManual':
                    $controller->showManual();
                    break;
                default:
                    throw new Exception("Acción no válida para catalog");
            }
            break;

        default:
            throw new Exception("Controlador no válido");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}