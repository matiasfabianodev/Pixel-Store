<?php
    session_start();

    if (!isset($_SESSION['usuario_id']))   
        {
            header("Location: login.php");
            exit();
        }

    $nombre_usuario = $_SESSION['usuario_nombre'];
    $rol_usuario = $_SESSION['usuario_rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store [Bienvenida]</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">
    <?php 
        $pagina_actual = 'bienvenida';
        require_once("../components/header.php");
        require_once("../components/nav.php");
    ?>

    <main class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="p-5 rounded text-white text-center shadow" style="background-color: #252525; max-width: 600px; width: 100%; border-top: 4px solid #d9db45;">
            
            <div class="mb-4" style="font-size: 4rem;">
                👋👋
            </div>

            <h2 class="text-uppercase fw-bold mb-3" style="color: #d9db45; letter-spacing: 1px;">
                Bienvenido, <?= htmlspecialchars($nombre_usuario) ?>!
            </h2>
            
            <h5 class="fw-semibold mb-4" style="color: #37d6db;">
                Has ingresado correctamente al sistema.
            </h5>

            <hr class="border-secondary my-4">

            <div class="d-flex flex-wrap gap-3 justify-content-center">
                <a href="../index.php" class="btn fw-bold text-uppercase px-4 py-2" style="background-color: #37d6db; color: #000; border-radius: 6px;">
                    Volver al Inicio
                </a>
                
                <?php if ($rol_usuario === 'admin'): ?>
                    <a href="admin_juegos.php" class="btn fw-bold text-uppercase px-4 py-2" style="background-color: #d9db45; color: #000; border-radius: 6px;">
                        📦 Gestión de Catálogo
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </main>

    <?php 
        require_once("../components/footer.php");
    ?>
</body>
</html>