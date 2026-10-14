<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store [Informacion]</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">
    <?php
        $pagina_actual = 'informacion'; 
        require_once("../components/header.php");
        require_once("../components/nav.php");
    ?>

<main class="container my-5 text-white">
    <div class="row mb-5 justify-content-center text-center">
        <div class="col-12 col-lg-8">
            <h2 class="fw-bold text-uppercase mb-3" style="color: #d9db45; letter-spacing: 2px; font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.4);">
                Sobre Nosotros
            </h2>
            <p class="fs-5 lead" style="color: #cfcfcf; line-height: 1.6;">
                Bienvenido a <span style="color: #d9db45; font-weight: bold;">Pixel Store</span>, una tienda dedicada por y para los amantes de los videojuegos. Nuestro espacio está pensado para que descubras, explores y adquieras tus títulos favoritos de manera simple y accesible.
            </p>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
        
        <div class="col">
            <div class="card h-100 border-0 p-4" style="background-color: #252525; border-radius: 15px; border-left: 4px solid #37d6db !important;">
                <div class="card-body p-0">
                    <div class="mb-3 fs-1" style="color: #37d6db;">🎯</div>
                    <h4 class="card-title fw-bold mb-3" style="color: #37d6db;">Nuestra Misión</h4>
                    <p class="card-text text-muted small" style="color: #cfcfcf !important; line-height: 1.7; text-align: justify;">
                        Acercar a cada jugador el título ideal para sus gustos e intereses. Ya sea que prefieras aventuras épicas, desafíos de estrategia, experiencias multijugador o historias llenas de emoción, acá vas a encontrar opciones para todos los estilos.
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 p-4" style="background-color: #252525; border-radius: 15px; border-left: 4px solid #d9db45 !important;">
                <div class="card-body p-0">
                    <div class="mb-3 fs-1" style="color: #d9db45;">🎮</div>
                    <h4 class="card-title fw-bold mb-3" style="color: #d9db45;">Pasión Gamer</h4>
                    <p class="card-text text-muted small" style="color: #cfcfcf !important; line-height: 1.7; text-align: justify;">
                        Creemos que los videojuegos son una forma única de entretenimiento, capaz de unir personas, fomentar la creatividad y brindar experiencias inolvidables. Por eso, nuestro catálogo incluye desde los tanques triple A hasta joyas independientes.
                    </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-100 border-0 p-4" style="background-color: #252525; border-radius: 15px; border-left: 4px solid #ee8e21 !important;">
                <div class="card-body p-0">
                    <div class="mb-3 fs-1" style="color: #ee8e21;">🚀</div>
                    <h4 class="card-title fw-bold mb-3" style="color: #ee8e21;">Experiencia Clara</h4>
                    <p class="card-text text-muted small" style="color: #cfcfcf !important; line-height: 1.7; text-align: justify;">
                        Buscamos brindar una navegación clara e intuitiva. Nos esforzamos por mantener nuestros productos actualizados y organizados de manera impecable, facilitando tu búsqueda por género, plataforma y características clave.
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="p-4 p-md-5 rounded text-center shadow" style="background-color: #1a1a1a; border: 1px solid #333;">
                <span class="badge bg-secondary mb-3 text-uppercase px-3 py-2 font-monospace" style="font-size: 0.75rem;">Nota del Proyecto</span>
                <p class="fs-6 mb-4 mx-auto" style="color: #cfcfcf; max-width: 800px; line-height: 1.8; text-align: justify;">
                    Aunque Pixel Store es un proyecto ficticio desarrollado con fines académicos, representa la visión de una empresa moderna enfocada en la satisfacción de sus clientes y en la pasión por el mundo gamer. Nuestro compromiso es simular una comunidad donde los videojuegos sean el punto de encuentro definitivo.
                </p>
                <hr class="w-25 mx-auto my-4" style="border-color: rgba(255,255,255,0.2);">
                <h5 class="fw-bold mb-3" style="color: #d9db45;">¡Gracias por visitar Pixel Store!</h5>
                <a href="../index.php" class="btn btn-sm fw-bold text-uppercase px-4 py-2" style="background-color: #d9db45; color: #1a1a1a; border-radius: 6px; font-size: 0.85rem;">
                    Catálogo
                </a>
            </div>
        </div>
    </div>
</main>

    <?php 
        require_once("../components/footer.php");
    ?>
</body>

</html>
