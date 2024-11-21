<?php
// Controller/TelaController.php

require_once 'Model/Database.php';
require_once 'Model/Tela.php';
require_once 'Model/ImageUploader.php';

class TelaController {
    private $db;
    private $telaModel;
    private $imageUploader;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->telaModel = new Tela($this->db);
        $this->imageUploader = new ImageUploader();
    }

    // Método para mostrar el formulario de nueva tela
    public function showUploadForm() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['logged_in'])) {
            header('Location: ?controller=user&action=login');
            return;
        }
        
        include 'View/upload_tela.php';
    }

    // Método para procesar la subida de nueva tela
    public function uploadTela() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['logged_in'])) {
            header('Location: ?controller=user&action=login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recuperar datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $metraje = $_POST['metraje'] ?? 0;
            $whatsapp_link = $_POST['whatsapp_link'] ?? '';

            // Validaciones básicas
            if (empty($nombre) || $metraje <= 0 || empty($whatsapp_link)) {
                $error = "Todos los campos son obligatorios";
                include 'View/upload_tela.php';
                return;
            }

            // Procesar subida de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                $imageName = $this->imageUploader->uploadImage($_FILES['imagen']);
                
                if ($imageName) {
                    try {
                        // Preparar consulta para insertar nueva tela
                        $query = "INSERT INTO telas (nombre, imagen, metraje, whatsapp_link) 
                                  VALUES (:nombre, :imagen, :metraje, :whatsapp_link)";
                        $stmt = $this->db->prepare($query);
                        $stmt->execute([
                            ':nombre' => $nombre,
                            ':imagen' => $imageName,
                            ':metraje' => $metraje,
                            ':whatsapp_link' => $whatsapp_link
                        ]);

                        // Redirigir al catálogo con mensaje de éxito
                        $_SESSION['message'] = "Tela agregada exitosamente";
                        header('Location: ?controller=catalog&action=index');
                    } catch(PDOException $e) {
                        // Manejar errores de base de datos
                        $error = "Error al guardar la tela: " . $e->getMessage();
                        include 'View/upload_tela.php';
                    }
                } else {
                    // Error en la subida de imagen
                    $error = "Error al subir la imagen. Verifica el formato y tamaño.";
                    include 'View/upload_tela.php';
                }
            } else {
                $error = "Debe seleccionar una imagen";
                include 'View/upload_tela.php';
            }
        } else {
            // Si no es POST, mostrar formulario
            $this->showUploadForm();
        }
    }

    // Método para editar una tela existente
    public function editTela() {
        // Verificar autenticación
        if (!isset($_SESSION['logged_in'])) {
            header('Location: ?controller=user&action=login');
            return;
        }

        $id = $_GET['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lógica de actualización de tela
            // Similar a uploadTela() pero con UPDATE en lugar de INSERT
        } else {
            // Cargar datos de la tela para edición
            $tela = $this->telaModel->getTelaById($id);
            include 'View/edit_tela.php';
        }
    }

    // Método para eliminar una tela
    public function deleteTela() {
        // Verificar autenticación
        if (!isset($_SESSION['logged_in'])) {
            header('Location: ?controller=user&action=login');
            return;
        }

        $id = $_GET['id'] ?? null;

        if ($id) {
            try {
                // Obtener datos de la tela para eliminar imagen
                $tela = $this->telaModel->getTelaById($id);

                // Eliminar registro de base de datos
                $query = "DELETE FROM telas WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->execute([':id' => $id]);

                // Eliminar archivo de imagen
                $imagePath = 'uploads/' . $tela['imagen'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                $_SESSION['message'] = "Tela eliminada exitosamente";
                header('Location: ?controller=catalog&action=index');
            } catch(PDOException $e) {
                $_SESSION['error'] = "Error al eliminar la tela";
                header('Location: ?controller=catalog&action=index');
            }
        }
    }
}