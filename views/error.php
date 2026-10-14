<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store - Error de Conexión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #3d3d3d; min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: Verdana, sans-serif; margin: 0;">

    <div class="container text-center px-4">
        <div class="p-5 mx-auto shadow-lg text-white" style="background-color: #252525; max-width: 580px; border-radius: 15px; border-top: 5px solid #d9db45;">
            
            <div class="mb-4" style="font-size: 4.5rem; filter: drop-shadow(0 0 10px rgba(217, 219, 111, 0.2));">
                📡❌
            </div>

            <h1 class="fw-bold text-uppercase mb-3" style="color: #d9db45; font-size: 2.2rem; letter-spacing: 1px;">
                CONEXIÓN PERDIDA
            </h1>

            <h5 class="fw-semibold mb-4" style="color: #37d6db; letter-spacing: 0.5px;">
                ¡Ups! Algo salió mal
            </h5>

            <p class="mb-5 px-2 lh-base" style="color: #cfcfcf; font-size: 0.95rem; text-align: justify;">
                No pudimos establecer la conexión con la base de datos de la tienda. Es posible que el servidor se encuentre en mantenimiento o experimentando una sobrecarga temporal. Por favor, intentá recargar la página en unos minutos.
            </p>

            <a href="../index.php" class="btn px-5 py-3 fw-bold text-uppercase shadow-sm" 
                style="background-color: #37d6db; color: #000000; border-radius: 8px; font-size: 0.85rem; letter-spacing: 1px; transition: all 0.25s ease-in-out;"
                onmouseover="this.style.backgroundColor='#d9db45'; this.style.transform='translateY(-2px)';" 
                onmouseout="this.style.backgroundColor='#37d6db'; this.style.transform='translateY(0)';">
                🎮 Volver al inicio
            </a>
            
        </div>
    </div>

</body>
</html>