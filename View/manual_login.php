<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual de Usuario - Textilandia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .manual-section {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .step {
            margin: 15px 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center mb-4">Manual de Usuario - Textilandia</h1>

                <div class="manual-section">
                    <h3><i class="fas fa-sign-in-alt"></i> Inicio de Sesión</h3>
                    <div class="step">
                        <h5>1. Acceder al Sistema</h5>
                        <ul>
                            <li>Ingrese su nombre de usuario registrado</li>
                            <li>Ingrese su contraseña</li>
                            <li>Opcionalmente, puede marcar "Recordar contraseña"</li>
                            <li>Haga clic en el botón "Ingresar"</li>
                        </ul>
                    </div>
                </div>

                <div class="manual-section">
                    <h3><i class="fas fa-user-plus"></i> Registro de Nueva Cuenta</h3>
                    <div class="step">
                        <h5>2. Crear una Nueva Cuenta</h5>
                        <ul>
                            <li>Haga clic en el botón "Registrarse"</li>
                            <li>Complete todos los campos requeridos:
                                <ul>
                                    <li>Nombre</li>
                                    <li>Apellido</li>
                                    <li>Celular (10 dígitos obligatorios)</li>
                                    <li>Usuario</li>
                                    <li>Contraseña</li>
                                </ul>
                            </li>
                            <li>Asegúrese de que el número de celular tenga 10 dígitos</li>
                            <li>Haga clic en "Registrarse" para crear su cuenta</li>
                        </ul>
                    </div>
                </div>

                <div class="manual-section">
                    <h3><i class="fas fa-exclamation-circle"></i> Solución de Problemas</h3>
                    <div class="step">
                        <h5>3. Problemas Comunes</h5>
                        <ul>
                            <li>Si no puede iniciar sesión, verifique que su usuario y contraseña sean correctos</li>
                            <li>Para el registro, asegúrese de que el número de celular tenga exactamente 10 dígitos</li>
                            <li>Si olvida su contraseña, contacte al administrador del sistema</li>
                        </ul>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="index.php?controller=user&action=login" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Volver al Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>