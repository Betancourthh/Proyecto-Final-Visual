<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Nueva Tela - Textilandia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Agregar Nueva Tela</h2>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="?controller=tela&action=uploadTela" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Tela</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen de la Tela</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                <small class="form-text text-muted">
                    Formatos permitidos: JPG, PNG, GIF, WebP. Tamaño máximo: 5MB
                </small>
            </div>
            
            <div class="mb-3">
                <label for="metraje" class="form-label">Metraje Disponible</label>
                <input type="number" class="form-control" id="metraje" name="metraje" step="0.01" min="0" required>
            </div>
            
            <div class="mb-3">
                <label for="whatsapp_link" class="form-label">Enlace de WhatsApp para Pedidos</label>
                <input type="url" class="form-control" id="whatsapp_link" name="whatsapp_link" required 
                       placeholder="https://wa.me/xxxxxxxxxx">
            </div>
            
            <button type="submit" class="btn btn-primary">Subir Tela</button>
        </form>
    </div>
</body>
</html>