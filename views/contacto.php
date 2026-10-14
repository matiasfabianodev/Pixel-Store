<?php
    $errores = [];
    $exito = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $edad = trim($_POST['edad'] ?? '');
            $motivo = trim($_POST['motivo'] ?? '');
            $mensaje = trim($_POST['mensaje'] ?? '');

            // PHP revisa todo minuciosamente
            if (empty($nombre)) 
                {
                    $errores[] = "Ingrese un nombre válido.";
                }
            if (empty($email)) 
                {
                    $errores[] = "Ingrese un correo electrónico.";
                } 
            elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $errores[] = "Ingrese un correo electrónico válido (ejemplo@correo.com).";
                }
            if (!empty($edad) && (!is_numeric($edad) || $edad < 0 || $edad > 120)) 
                {
                    $errores[] = "La edad debe ser un número válido entre 0 y 120 años.";
                }
            if (empty($mensaje)) 
                {
                    $errores[] = "Ingrese un mensaje.";
                }

            if (empty($errores)) 
                {
                    $exito = true;
                    $nombre = $email = $edad = $mensaje = "";
                }
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store [Contacto]</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">
    <?php
        $pagina_actual = 'contacto';
        require_once("../components/header.php");
        require_once("../components/nav.php");
    ?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            
            <div class="card border-0 shadow-lg p-4 p-md-5 text-white" style="background-color: #252525; border-radius: 15px; border-top: 4px solid #d9db45 !important;">
                
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-uppercase" style="color: #d9db45; letter-spacing: 1px; font-size: 2.2rem;">
                        Formulario de Contacto
                    </h2>
                    <p class="mb-4" style="color: #cfcfcf; font-size: 0.95rem;">¿Tenés alguna duda o consulta? Dejanos tu mensaje al toque.</p>
                    
                    <?php if (!empty($errores)): ?>
                        <div class="alert alert-danger border-0 shadow-sm mb-4 text-start" style="background-color: #f8d7da; color: #842029; border-radius: 8px;">
                            <p class="fw-bold mb-2">⚠️ Por favor corregí los siguientes errores:</p>
                            <ul class="mb-0 ps-3">
                                <?php foreach ($errores as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ($exito): ?>
                        <div class="alert alert-success border-0 shadow-sm mb-4 text-center fw-bold" style="background-color: #d1e7dd; color: #0f5132; border-radius: 8px;">
                            ¡Consulta enviada con éxito! El equipo de Pixel Store se contactará con usted en unos días.
                        </div>
                    <?php endif; ?>
                </div>

                <form action="" method="POST">
                    <div class="row g-3">
                        
                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label fw-semibold text-light small mb-1">Nombre completo:</label>
                            <input type="text" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="nombre" name="nombre" placeholder="Ej: Juan Pérez" value="<?= isset($nombre) ? htmlspecialchars($nombre) : '' ?>">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label fw-semibold text-light small mb-1">Correo electrónico:</label>
                            <input type="text" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="email" name="email" placeholder="nombre@correo.com" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="edad" class="form-label fw-semibold text-light small mb-1">Edad (Opcional):</label>
                            <input type="number" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="edad" name="edad" placeholder="Ej: 21" value="<?= isset($edad) ? htmlspecialchars($edad) : '' ?>">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="motivo" class="form-label fw-semibold text-light small mb-1">Motivo de contacto:</label>
                            <select class="form-select bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="motivo" name="motivo">
                                <option value="general" <?= (isset($motivo) && $motivo == 'general') ? 'selected' : '' ?>>Consulta general</option>
                                <option value="soporte" <?= (isset($motivo) && $motivo == 'soporte') ? 'selected' : '' ?>>Soporte técnico / Error</option>
                                <option value="compras" <?= (isset($motivo) && $motivo == 'compras') ? 'selected' : '' ?>>Dudas con una compra</option>
                                <option value="sugerencia" <?= (isset($motivo) && $motivo == 'sugerencia') ? 'selected' : '' ?>>Sugerencias</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="mensaje" class="form-label fw-semibold text-light small mb-1">Mensaje:</label>
                            <textarea class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="mensaje" name="mensaje" rows="5" placeholder="Escribí tu consulta acá..."><?= isset($mensaje) ? htmlspecialchars($mensaje) : '' ?></textarea>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn fw-bold text-uppercase w-100 py-3 btn-enviar-gamer">
                                Enviar Consulta
                            </button>
                        </div>

                    </div>
                </form>

            </div>
            
        </div>
    </div>
</main>
    <?php 
        require_once("../components/footer.php");
    ?>
</body>
</html>