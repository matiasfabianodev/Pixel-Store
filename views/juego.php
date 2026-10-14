<?php
    require_once("../class/conexion.php");

    $conexion = new Conexion();
    $pdo = $conexion->conectar();

    if (!isset($_GET['id'])) 
        {
            die("Juego no encontrado");
        }

    $id = $_GET['id'];

    $sql = "SELECT * FROM juegos WHERE ID = ?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$id]);

    $juego = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$juego) 
        {
            die("Juego no encontrado");
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $juego['Nombre_juego'] ?></title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">

    <?php 
        require_once("../components/header.php");
        require_once("../components/nav.php");
    ?>
    <main class="container my-5">
    <div class="mb-4">
        <a href="../index.php" class="btn btn-outline-light btn-sm px-3 fw-bold text-uppercase" style="border-radius: 6px; letter-spacing: 0.5px;">
            ← Volver al catálogo
        </a>
    </div>

    <div class="card border-0 shadow-lg p-4 p-md-5" style="background-color: #252525; border-radius: 15px;">
        <div class="row g-5">
            
            <div class="col-12 col-md-5 col-lg-4 text-center">
                <img 
                    src="../<?= $juego['imagen'] ?>" 
                    class="img-fluid rounded shadow-lg" 
                    alt="<?= $juego['Nombre_juego'] ?>"
                    style="max-height: 480px; object-fit: cover; border: 3px solid #d9db45;"
                >
            </div>

            <div class="col-12 col-md-7 col-lg-8 d-flex flex-column text-white">
                
                <div class="mb-2">
                    <span class="badge px-3 py-2 text-uppercase font-monospace text-dark fw-bold" style="background-color: #37d6db; border-radius: 5px; font-size: 0.8rem;">
                        <?= $juego['Plataforma'] ?>
                    </span>
                </div>

                <h1 class="fw-bold mb-3" style="color: #d9db45; font-size: 2.8rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                    <?= $juego['Nombre_juego'] ?>
                </h1>

                <div class="mb-4 p-3 rounded" style="background-color: rgba(255, 255, 255, 0.05); border-left: 4px solid #ee8e21;">
                    <p class="m-0 fs-5">
                        <strong style="color: #ee8e21;">Género:</strong> 
                        <span class="text-light fw-medium"><?= $juego['Genero'] ?></span>
                    </p>
                </div>

                <div class="mb-5">
                    <h5 class="text-uppercase fw-bold mb-2 small tracking-wider" style="color: #37d6db; letter-spacing: 1px;">
                        Reseña / Descripción
                    </h5>
                    <p style="text-align: justify; color: #cfcfcf; line-height: 1.8; font-size: 1.05rem;">
                        <?= $juego['descripcion'] ?>
                    </p>
                </div>

                <div class="mt-auto p-4 rounded d-flex flex-wrap justify-content-between align-items-center shadow-inner" style="background-color: #1a1a1a; border: 1px solid #333;">
                    <div class="my-2">
                        <span class="fs-1 fw-bold" style="color: #d9db45;">
                            $<?= number_format($juego['Precio'], 0, ',', '.') ?>
                        </span>
                    </div>
                    
                    <button class="btn fw-bold text-uppercase px-5 py-3 btn-adquirir my-2" style="background-color: #ee8e21; color: white; border-radius: 8px; border: none; font-size: 1rem; letter-spacing: 1px; transition: all 0.2s ease;">
                        Añadir al Carrito
                    </button>
                </div>

            </div>
        </div>
    </div>
</main>

    <?php 
        require_once("../components/footer.php");
    ?>

</body>
</html>