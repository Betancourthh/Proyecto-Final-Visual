<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Tela - Textilandia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .img-detail {
            max-height: 400px;
            object-fit: contain;
        }
        .detail-card {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        .color-badge {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 15px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .details-section {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card detail-card">
                    <div class="card-body">
                        <img src="uploads/<?php echo htmlspecialchars($tela['imagen']); ?>" 
                             class="img-fluid img-detail rounded" 
                             alt="<?php echo htmlspecialchars($tela['nombre']); ?>">
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card detail-card">
                    <div class="card-body">
                        <h2 class="mb-4"><?php echo htmlspecialchars($tela['nombre']); ?></h2>
                        
                        <div class="details-section">
                            <h5 class="text-muted mb-3">Detalles</h5>
                            
                            <!-- Metraje -->
                            <div class="mb-3">
                                <h6>Metraje Disponible:</h6>
                                <span class="badge bg-success fs-6">
                                    <?php echo number_format($tela['metraje'], 2); ?> metros
                                </span>
                            </div>
                            
                            <!-- Colores -->
                            <?php if(isset($tela['colores']) && !empty($tela['colores'])): ?>
                            <div class="mb-3">
                                <h6>Colores Disponibles:</h6>
                                <div>
                                    <?php
                                    // Si los colores están almacenados como string separado por comas
                                    $colores = explode(',', $tela['colores']);
                                    foreach($colores as $color):
                                        $color = trim($color); // Eliminar espacios en blanco
                                        if(!empty($color)):
                                    ?>
                                        <span class="color-badge">
                                            <i class="fas fa-circle me-1"></i>
                                            <?php echo htmlspecialchars($color); ?>
                                        </span>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Botones de acción -->
                        <div class="d-grid gap-2 mt-4">
                            <?php
                            $mensaje = "Hola, me interesa la tela " . $tela['nombre'] . " que tienen disponible";
                            $whatsappLink = "https://wa.me/573212200514?text=" . urlencode($mensaje);
                            ?>
                            
                            <a href="<?php echo $whatsappLink; ?>" 
                               class="btn btn-success btn-lg" 
                               target="_blank">
                                <i class="fab fa-whatsapp"></i> Comprar por WhatsApp
                            </a>
                            
                            <a href="index.php?controller=catalog&action=index" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left"></i> Volver al Catálogo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>