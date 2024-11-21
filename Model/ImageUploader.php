<?php
class ImageUploader {
    // Configuración de la subida de imágenes
    private $uploadDir = 'uploads/';
    private $maxFileSize = 5 * 1024 * 1024; // 5MB
    private $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    private $allowedMimeTypes = [
        'image/jpeg',
        'image/png', 
        'image/gif',
        'image/webp'
    ];

    /**
     * Sube una imagen y devuelve el nuevo nombre del archivo
     * 
     * @param array $file Archivo $_FILES['imagen']
     * @return string|false Nombre del archivo subido o false si hay error
     */
    public function uploadImage($file) {
        // Verificar si se subió un archivo
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            $this->logError("Error en la subida del archivo");
            return false;
        }

        // Validar tamaño del archivo
        if ($file['size'] > $this->maxFileSize) {
            $this->logError("El archivo excede el tamaño máximo de " . ($this->maxFileSize / 1024 / 1024) . "MB");
            return false;
        }

        // Validar tipo de archivo
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $this->allowedMimeTypes)) {
            $this->logError("Tipo de archivo no permitido");
            return false;
        }

        // Obtener extensión del archivo
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $this->allowedExtensions)) {
            $this->logError("Extensión de archivo no permitida");
            return false;
        }

        // Generar nombre único para el archivo
        $newFileName = $this->generateUniqueFileName($extension);
        $uploadPath = $this->uploadDir . $newFileName;

        // Intentar mover el archivo
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            // Opcional: Redimensionar imagen para optimizar
            $this->resizeImage($uploadPath, 800, 600);
            return $newFileName;
        } else {
            $this->logError("No se pudo mover el archivo");
            return false;
        }
    }

    /**
     * Genera un nombre de archivo único
     * 
     * @param string $extension Extensión del archivo
     * @return string Nombre de archivo único
     */
    private function generateUniqueFileName($extension) {
        // Combina timestamp, número aleatorio y hash
        return uniqid(rand(), true) . '.' . $extension;
    }

    /**
     * Redimensiona una imagen manteniendo la proporción
     * 
     * @param string $filePath Ruta del archivo
     * @param int $maxWidth Ancho máximo
     * @param int $maxHeight Alto máximo
     */
    private function resizeImage($filePath, $maxWidth, $maxHeight) {
        // Obtener información de la imagen
        list($width, $height, $type) = getimagesize($filePath);

        // Calcular nuevas dimensiones
        $ratio = min($maxWidth / $width, $maxHeight / $height);
        $newWidth = $width * $ratio;
        $newHeight = $height * $ratio;

        // Crear imagen de destino
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Cargar imagen original según su tipo
        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($filePath);
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($filePath);
                break;
            case IMAGETYPE_WEBP:
                $source = imagecreatefromwebp($filePath);
                break;
            default:
                return; // Tipo no soportado
        }

        // Redimensionar
        imagecopyresampled(
            $newImage, $source, 
            0, 0, 0, 0, 
            $newWidth, $newHeight, 
            $width, $height
        );

        // Guardar imagen redimensionada
        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($newImage, $filePath, 85);
                break;
            case IMAGETYPE_PNG:
                imagepng($newImage, $filePath, 8);
                break;
            case IMAGETYPE_GIF:
                imagegif($newImage, $filePath);
                break;
            case IMAGETYPE_WEBP:
                imagewebp($newImage, $filePath, 85);
                break;
        }

        // Liberar memoria
        imagedestroy($newImage);
        imagedestroy($source);
    }

    /**
     * Registra errores de subida
     * 
     * @param string $message Mensaje de error
     */
    private function logError($message) {
        // Puedes personalizar esto para guardar en un archivo de log
        error_log("ImageUploader: " . $message);
    }
}

// Ejemplo de uso en el controlador
class TelaController {
    private $imageUploader;

    public function __construct() {
        $this->imageUploader = new ImageUploader();
    }

    public function uploadTela() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validar datos del formulario
            $nombre = $_POST['nombre'];
            $metraje = $_POST['metraje'];
            $whatsapp_link = $_POST['whatsapp_link'];

            // Procesar subida de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                $imageName = $this->imageUploader->uploadImage($_FILES['imagen']);
                
                if ($imageName) {
                    // Guardar en base de datos
                    $query = "INSERT INTO telas (nombre, imagen, metraje, whatsapp_link) 
                              VALUES (:nombre, :imagen, :metraje, :whatsapp_link)";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute([
                        ':nombre' => $nombre,
                        ':imagen' => $imageName,
                        ':metraje' => $metraje,
                        ':whatsapp_link' => $whatsapp_link
                    ]);

                    // Redirigir o mostrar mensaje de éxito
                    header('Location: ?controller=catalog&action=index');
                } else {
                    // Manejar error de subida
                    $error = "Error al subir la imagen";
                    include 'View/upload_tela.php';
                }
            }
        } else {
            // Mostrar formulario de subida
            include 'View/upload_tela.php';
        }
    }
}