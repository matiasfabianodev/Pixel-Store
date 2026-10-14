<?php
    if (session_status() === PHP_SESSION_NONE) 
        {
            session_start();
        }
    $raiz = (basename(dirname($_SERVER['SCRIPT_NAME'])) === 'views') ? '../' : './';
?>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar py-3">
    <div class="container">
        <a class="navbar-brand fw-black text-uppercase tracking-wider" href="<?php echo $raiz; ?>index.php">
            <span style="color: #d9db45;">Pixel</span><span style="color: #00f2fe;">Store</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#pixelNavbar" aria-controls="pixelNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="pixelNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-1 align-items-center">
                <li class="nav-item">
                    <a class="nav-link custom-link <?= (isset($pagina_actual) && $pagina_actual == 'index') ? 'active' : '' ?>" href="<?php echo $raiz; ?>index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link <?= (isset($pagina_actual) && $pagina_actual == 'informacion') ? 'active' : '' ?>" href="<?php echo $raiz; ?>views/informacion.php">Información</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link custom-link <?= (isset($pagina_actual) && $pagina_actual == 'contacto') ? 'active' : '' ?>" href="<?php echo $raiz; ?>views/contacto.php">Contacto</a>
                </li>
            </ul>

            <div class="vr bg-secondary mx-3 d-none d-lg-inline-block opacity-25" style="height: 24px;"></div>
            <hr class="text-secondary d-lg-none my-3 opacity-25 w-100">

            <ul class="navbar-nav gap-2 align-items-center">
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link custom-link px-3" href="<?php echo $raiz; ?>views/perfil.php">
                            👤 Perfil
                        </a>
                    </li>
                    
                    <?php if ($_SESSION['usuario_rol'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-catalogo px-3 fw-bold" href="<?php echo $raiz; ?>views/admin_juegos.php">
                                📦 Catalogo
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($_SESSION['usuario_rol'] === 'admin'): ?>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-permisos btn-warning text-dark px-3 fw-bold ms-1" href="<?php echo $raiz; ?>views/admin_usuarios.php">
                                ✏️ Permisos
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="btn btn-sm btn-logout btn-danger fw-bold text-dark" href="<?php echo $raiz; ?>views/logout.php">
                            🚪 Cerrar Sesion
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-login px-3 fw-bold text-uppercase" href="<?php echo $raiz; ?>views/login.php">
                            Ingresar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-register px-3 fw-bold text-uppercase" href="<?php echo $raiz; ?>views/registro.php">
                            Registrarse
                        </a>
                    </li>
                <?php endif; ?>

                
            </ul>
        </div>
    </div>
</nav>

<div style="margin-top: 76px;"></div>