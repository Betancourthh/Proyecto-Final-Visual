<?php
// Controller/CatalogController.php
class CatalogController {
    private $db;
    private $telaModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->telaModel = new Tela($this->db);
    }

    public function index() {
        if (!isset($_SESSION['logged_in'])) {
            header('Location: index.php?controller=user&action=login');
            exit();
        }

        // Obtener todas las telas
        $telas = $this->telaModel->getAllTelas();
        require_once __DIR__ . '/../View/catalog.php';
    }

    public function detail() {
        if (!isset($_SESSION['logged_in'])) {
            header('Location: index.php?controller=user&action=login');
            exit();
        }

        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if ($id) {
            // Obtener los detalles de la tela específica
            $tela = $this->telaModel->getTelaById($id);
            if ($tela) {
                require_once __DIR__ . '/../View/tela_detail.php';
            } else {
                header('Location: index.php?controller=catalog&action=index');
            }
        } else {
            header('Location: index.php?controller=catalog&action=index');
        }
    }

    public function showManual() {
        if (!isset($_SESSION['logged_in'])) {
            header('Location: index.php?controller=user&action=login');
            exit();
        }
        
        // Cargar la vista del manual del catálogo
        require_once __DIR__ . '/../View/manual_catalog.php';
    }
}