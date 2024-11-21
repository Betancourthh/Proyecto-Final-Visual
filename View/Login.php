<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Textilandia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Textilandia</h2>
                        
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form action="index.php?controller=user&action=login" method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="recordar" name="recordar">
                                <label class="form-check-label" for="recordar">Recordar contraseña</label>
                            </div>
                            
                            <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                            <a href="index.php?controller=user&action=showRegister" class="btn btn-secondary">Registrarse</a>
                            </div>
                        </form>
                        
                        <div class="text-center mt-3">
                            <a href="index.php?controller=user&action=showManual">Ver manual de usuario</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>