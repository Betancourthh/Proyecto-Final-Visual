<?php
// Controller/UserController.php
class UserController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($this->userModel->login($usuario, $password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['usuario'] = $usuario;
                header('Location: index.php?controller=catalog&action=index');
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos";
                require_once __DIR__ . '/../View/login.php';
            }
        } else {
            require_once __DIR__ . '/../View/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Validar número de celular
                if (strlen($_POST['celular']) !== 10 || !ctype_digit($_POST['celular'])) {
                    $error = "El número de celular debe tener exactamente 10 dígitos";
                    require_once __DIR__ . '/../View/register.php';
                    return;
                }

                $this->userModel->nombre = $_POST['nombre'];
                $this->userModel->apellido = $_POST['apellido'];
                $this->userModel->celular = $_POST['celular'];
                $this->userModel->usuario = $_POST['usuario'];
                $this->userModel->password = $_POST['password'];

                if ($this->userModel->register()) {
                    header('Location: index.php?controller=user&action=login');
                    exit();
                } else {
                    $error = "Error al registrar el usuario";
                    require_once __DIR__ . '/../View/register.php';
                }
            } catch (Exception $e) {
                $error = "Error: " . $e->getMessage();
                require_once __DIR__ . '/../View/register.php';
            }
        } else {
            // Si es GET, mostrar el formulario de registro
            require_once __DIR__ . '/../View/register.php';
        }
    }

    public function showManual() {
        require_once __DIR__ . '/../View/manual_login.php';
    }

    public function showRegister() {
        require_once __DIR__ . '/../View/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=user&action=login');
        exit();
    }
}