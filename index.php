<?php
    require_once("class/conexion.php");
    $conexion = new Conexion();
    $pdo = $conexion->conectar();

    $porPagina = 6;
    $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($paginaActual - 1) * $porPagina;

    $totalQuery = $pdo->query("SELECT COUNT(*) FROM juegos")->fetchColumn();
    $totalPaginas = ceil($totalQuery / $porPagina);

    $sql = "SELECT * FROM juegos LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $porPagina, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $juegos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Pixel Store</title>
            <link rel="stylesheet" href="CSS/estilos.css">
        </head>

    <body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">

            <?php
                $pagina_actual = 'index';
                require_once("components/header.php");
                require_once("components/nav.php");
            ?>

<main class="container my-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h2 class="fw-bold text-uppercase" style="color: #d9db45; letter-spacing: 2px; font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.4);">
                Catálogo de Juegos
            </h2>
            <p style="color: #cfcfcf; font-size: 1rem;">
                Explorá los títulos más destacados y las últimas novedades
            </p>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        
        <?php foreach ($juegos as $juego): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow card-gamer" style="background-color: #252525; border-radius: 10px; overflow: hidden; display: flex; flex-direction: column;">
                

                    <div class="img-contenedor" style="aspect-ratio: 4 / 4; width: 100%; overflow: hidden; border-bottom: 3px solid #d9db45;">
                        <img 
                            src="<?= $juego['imagen'] ?>" 
                            class="card-img-top w-100 h-100 img-juego" 
                            alt="<?= $juego['Nombre_juego'] ?>"
                            style="object-fit: cover; transition: transform 0.4s ease;"
                        >
                    </div>

                    <div class="card-body d-flex flex-column p-4 text-white">
                        
                        <div class="mb-2">
                            <span class="badge px-3 py-1 text-uppercase font-monospace text-dark fw-bold" style="background-color: #37d6db; border-radius: 5px; font-size: 0.75rem;">
                                <?= $juego['Plataforma'] ?>
                            </span>
                        </div>

                        <h4 class="card-title fw-bold mb-2 text-truncate" title="<?= $juego['Nombre_juego'] ?>" style="color: #ffffff; font-size: 1.4rem;">
                            <?= $juego['Nombre_juego'] ?>
                        </h4>

                        <p class="card-text text-muted small mb-4">
                            <span class="text-light fw-medium"><?= $juego['Genero'] ?></span>
                        </p>

                        <div class="mt-auto d-flex justify-content-between align-items-center pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                            <div class="d-flex flex-column">
                                <span class="text-muted text-uppercase p-0 m-0" style="font-size: 0.65rem; letter-spacing: 1px;">Precio</span>
                                <span class="fs-3 fw-bold" style="color: #d9db45;">
                                    $<?= number_format($juego['Precio'], 0, ',', '.') ?>
                                </span>
                            </div>
                            
                            <a href="views/juego.php?id=<?= $juego['ID'] ?>" class="btn fw-bold text-uppercase px-4 py-2 btn-ver-detalles" style="background-color: #d9db45; color: #252525; border-radius: 8px; font-size: 0.85rem; letter-spacing: 0.5px; border: none; transition: all 0.2s ease;">
                                Ver Detalles
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

    <div class="paginacion-contenedor d-flex justify-content-center align-items-center gap-2">
        
        <?php if ($paginaActual > 1): ?>
            <a href="?page=<?= $paginaActual - 1 ?>" class="btn-pagina">
                <img src="img/izq.png" alt="Anterior" width="25">
            </a>
        <?php else: ?>
            <span class="btn-pagina" style="opacity: 0.3; cursor: not-allowed;">
                <img src="img/izq.png" alt="Anterior" width="25">
            </span>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <?php if ($i == $paginaActual): ?>
                <span class="texto-pagina badge bg-warning text-dark px-3 py-2 fs-5 fw-bold rounded shadow">
                    <?= $i ?>
                </span>
            <?php else: ?>
                <a href="?page=<?= $i ?>" class="btn fw-bold px-3 py-2 fs-5 btn-paginado-num" style="text-decoration: none;">
                    <?= $i ?>
                </a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($paginaActual < $totalPaginas): ?>
            <a href="?page=<?= $paginaActual + 1 ?>" class="btn-pagina">
                <img src="img/dere.png" alt="Siguiente" width="25">
            </a>
        <?php else: ?>
            <span class="btn-pagina" style="opacity: 0.3; cursor: not-allowed;">
                <img src="img/dere.png" alt="Siguiente" width="25">
            </span>
        <?php endif; ?>
        
    </div>

        <?php 
            require_once("components/footer.php");
        ?>
    </body>
</html>