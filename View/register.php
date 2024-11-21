<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Textilandia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2 class="text-center mb-4">Registro - Textilandia</h2>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form action="index.php?controller=user&action=register" method="POST" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                </div>

                <div class="mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" required
                           pattern="[0-9]{10}" title="Debe contener 10 dígitos numéricos">
                    <div class="form-text">El número debe tener 10 dígitos</div>
                </div>

                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                    <a href="index.php?controller=user&action=login" class="btn btn-outline-secondary">Volver al Login</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    function validateForm() {
        const celular = document.getElementById('celular').value;
        if(celular.length !== 10 || !/^\d+$/.test(celular)) {
            alert('El número de celular debe tener exactamente 10 dígitos numéricos');
            return false;
        }
        return true;
    }

    // Prevenir entrada de caracteres no numéricos en el campo celular
    document.getElementById('celular').addEventListener('keypress', function(e) {
        if(!/\d/.test(e.key)) {
            e.preventDefault();
        }
    });
    </script>
</body>
</html>