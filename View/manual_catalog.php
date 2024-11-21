<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual del Catálogo - Textilandia</title>
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
                <h1 class="text-center mb-4">Manual del Catálogo - Textilandia</h1>

                <div class="manual-section">
                    <h3><i class="fas fa-book-open"></i> Navegación del Catálogo</h3>
                    <div class="step">
                        <h5>1. Visualización de Telas</h5>
                        <ul>
                            <li>En la página principal encontrará todas las telas disponibles</li>
                            <li>Cada tela muestra:
                                <ul>
                                    <li>Una imagen representativa</li>
                                    <li>Nombre de la tela</li>
                                    <li>Metraje disponible</li>
                                    <li>Botón para ver más detalles</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="manual-section">
                    <h3><i class="fas fa-shopping-cart"></i> Compra de Telas</h3>
                    <div class="step">
                        <h5>2. Proceso de Compra</h5>
                        <ul>
                            <li>Para comprar una tela:
                                <ol>
                                    <li>Haga clic en "Ver detalles" de la tela deseada</li>
                                    <li>Verifique el metraje disponible</li>
                                    <li>Haga clic en "Comprar por WhatsApp"</li>
                                    <li>Se abrirá una conversación de WhatsApp donde podrá especificar:
                                        <ul>
                                            <li>Cantidad de metros deseados</li>
                                            <li>Forma de pago preferida</li>
                                            <li>Dirección de envío si es necesario</li>
                                        </ul>
                                    </li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="manual-section">
                    <h3><i class="fas fa-question-circle"></i> Información Adicional</h3>
                    <div class="step">
                        <h5>3. Otros Aspectos Importantes</h5>
                        <ul>
                            <li>Los precios están sujetos a confirmación por WhatsApp</li>
                            <li>El metraje se actualiza periódicamente</li>
                            <li>Puede seguirnos en redes sociales para ver novedades</li>
                            <li>Para cualquier consulta adicional, use los botones de contacto</li>
                        </ul>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="index.php?controller=catalog&action=index" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Volver al Catálogo
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>