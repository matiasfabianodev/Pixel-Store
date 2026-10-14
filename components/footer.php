<?php
    $raiz_footer = (basename(dirname($_SERVER['SCRIPT_NAME'])) === 'views') ? '../' : './';
?>

<footer class="custom-footer pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row text-center text-md-start justify-content-between">
            
            <div class="col-md-4 mb-4 mb-md-0">
                <h5 class="text-uppercase fw-bold mb-3 tracking-wider text-white">
                    <span style="color: #d9db45;">PIXEL</span><span style="color: #00f2fe;">STORE</span>
                </h5>
            <p class="small text-white-50 lh-base" style="max-width: 320px;">
                El catálogo definitivo de videojuegos para la comunidad dev. Guardá tus títulos favoritos, gestioná inventarios y disfrutá de la experiencia gaming.
            </p>
            </div>

            <div class="col-md-3 mb-4 mb-md-0">
                <h5 class="text-uppercase fw-bold mb-3 small-title text-uppercase">Navegación</h5>
                <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                    <li><a href="<?= $raiz_footer ?>index.php" class="footer-link">- Inicio</a></li>
                    <li><a href="<?= $raiz_footer ?>views/informacion.php" class="footer-link">- Información</a></li>
                    <li><a href="<?= $raiz_footer ?>views/contacto.php" class="footer-link">- Contacto</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5 class="text-uppercase fw-bold mb-3 small-title text-uppercase">Servidor</h5>
                <p class="small text-white-50 mb-2">Estado del sistema: <span class="badge status-badge">ONLINE</span></p>
                <div class="d-flex gap-2 justify-content-center justify-content-md-start mt-3">
                    <span class="social-tag">Discord</span>
                    <span class="social-tag">Twitch</span>
                    <span class="social-tag">Steam</span>
                </div>
            </div>

        </div>

        <hr class="border-secondary my-4 opacity-10">

        <div class="row align-items-center">
            <div class="col text-center">
                <p class="small text-muted mb-0" style="font-size: 0.8rem;">
                    &copy; 2026 <span style="color: #00f2fe;" class="fw-semibold">Pixel Store</span>. Programación Web II — Facultad Da Vinci.
                </p>
            </div>
        </div>
    </div>
</footer>