<!-- View/catalog.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Textilandia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .tela-card {
            transition: transform 0.3s;
        }
        .tela-card:hover {
            transform: translateY(-5px);
        }
        .tela-image {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center display-4 mb-4">Textilandia</h1>
        
        <!-- Redes sociales -->
        <div class="text-center mb-5">
            <a href="https://web.whatsapp.com/send/?phone=%2B573212200514&text&type=phone_number&app_absent=0" class="social-icon text-decoration-none">
                <i class="fab fa-whatsapp text-success fa-2x mx-2"></i>
            </a>
            <a href="https://www.facebook.com/profile.php?id=100067708824347&mibextid=LQQJ4d" class=" class="social-icon text-decoration-none">
                <i class="fab fa-facebook text-primary fa-2x mx-2"></i>
            </a>
            <a href="https://www.instagram.com/text.ilandia/profilecard/?igsh=ZDJpN3g4bnRpMjNz" class="social-icon text-decoration-none">
                <i class="fab fa-instagram text-danger fa-2x mx-2"></i>
            </a>
        </div>

        <!-- Lista de telas -->
        <div class="row">
            <?php if (isset($telas) && is_array($telas)): ?>
                <?php foreach ($telas as $tela): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card tela-card h-100">
                            <img src="uploads/<?php echo htmlspecialchars($tela['imagen']); ?>" 
                                 class="card-img-top tela-image" 
                                 alt="<?php echo htmlspecialchars($tela['nombre']); ?>">
                            <!-- View/catalog.php (sección de la tarjeta de tela) -->
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($tela['nombre']); ?></h5>
                                <p class="card-text">
                                    <small class="text-muted">Metraje disponible: 
                                        <span class="fw-bold"><?php echo number_format($tela['metraje'], 2); ?> metros</span>
                                    </small>
                                </p>
                                    <p class=  "card-text">
                                        <small class="text-muted">Precio por metro: 
                                        <span class="fw-bold text-success">$<?php echo number_format($tela['precio'], 0); ?></span>
                                    </small>
                                </p>
                                <?php if (isset($tela['colores'])): ?>
                                <p class="card-text">
                                    <small class="text-muted">Colores disponibles: 
                                        <span class="fw-bold"><?php echo htmlspecialchars($tela['colores']); ?></span>
                                    </small>
                                </p>
                                <?php endif; ?>
                                    <a href="index.php?controller=catalog&action=detail&id=<?php echo $tela['id']; ?>" 
                                class="btn btn-outline-primary">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        No hay telas disponibles en este momento.
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Manual de usuario y cerrar sesión -->
        <div class="text-center mt-4 mb-4">
            <a href="index.php?controller=catalog&action=showManual" class="btn btn-info me-2">
                <i class="fas fa-book"></i> Manual de Usuario
            </a>
            <a href="index.php?controller=user&action=logout" class="btn btn-danger">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>

        <!-- Footer -->
        <footer class="text-center py-3 mt-4 border-top">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> Textilandia. Todos los derechos reservados.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>