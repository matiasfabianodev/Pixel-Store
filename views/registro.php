<?php
    session_start();

    if (isset($_SESSION['usuario_id'])) 
        {
            header("Location: bienvenida.php");
            exit();
        }

    require_once("../class/conexion.php");
    $error = "";
    $exito = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($nombre) || empty($email) || empty($password)) 
                {
                    $error = "Por favor, completá todos los campos.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error = "Por favor, ingresá un correo electrónico válido.";
                } else {
                    try 
                        {
                            $conexion = new Conexion();
                            $pdo = $conexion->conectar();

                            $sql_check = "SELECT ID FROM usuarios WHERE email = ?";
                            $stmt_check = $pdo->prepare($sql_check);
                            $stmt_check->execute([$email]);
                            
                            if ($stmt_check->fetch()) 
                                {
                                    $error = "El correo electrónico ya está registrado. Intentá iniciar sesión.";
                                } else {
                                    $password_encriptada = password_hash($password, PASSWORD_DEFAULT);

                                    $sql_insert = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
                                    $stmt_insert = $pdo->prepare($sql_insert);
                                    
                                    if ($stmt_insert->execute([$nombre, $email, $password_encriptada])) 
                                        {
                                            $exito = "¡Registro completado con éxito! Ya podés iniciar sesión.";
                                            $nombre = $email = "";
                                        } else {
                                            $error = "Hubo un error al guardar tu cuenta. Por favor, intentá de nuevo.";
                                        }
                                }
                        } catch (PDOException $e) {
                            $error = "Error en la base de datos: " . $e->getMessage();
                        }
                }
        }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store [Registro]</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">
    <?php 
        $pagina_actual = 'registro';
        require_once("../components/header.php");
        require_once("../components/nav.php");
    ?>

    <main class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="p-4 p-md-5 rounded text-white shadow" style="background-color: #252525; max-width: 450px; width: 100%; border-top: 4px solid #37d6db;">
            
            <h3 class="text-uppercase fw-bold mb-4" style="color: #d9db45; letter-spacing: 1px;">
                Crear Cuenta
            </h3>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger py-2 px-3 mb-4 small" style="background-color: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #ea868f;">
                    ⚠️ <?= $error ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($exito)): ?>
                <div class="alert alert-success py-2 px-3 mb-4 small" style="background-color: rgba(25, 135, 84, 0.2); border: 1px solid #198754; color: #a3cfbb;">
                    ✅ <?= $exito ?>
                </div>
            <?php endif; ?>

            <form action="registro.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label small fw-semibold text-light mb-1">Nombre Completo:</label>
                    <input type="text" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="nombre" name="nombre" placeholder="Tu nombre" required value="<?= isset($nombre) ? htmlspecialchars($nombre) : '' ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-light mb-1">Correo Electrónico:</label>
                    <input type="email" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="email" name="email" placeholder="ejemplo@correo.com" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-light mb-1">Contraseña:</label>
                    <input type="password" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="password" name="password" placeholder="Mínimo 6 caracteres" required>
                </div>

                <button type="submit" class="btn fw-bold text-uppercase w-100 py-2 mb-3" style="background-color: #37d6db; color: #000; border-radius: 8px; transition: all 0.2s;">
                    Registrarme
                </button>

                <div class="text-center mt-3 small">
                    <span style="color: #cfcfcf;">Ya tenés una cuenta?</span> 
                    <a href="login.php" style="color: #d9db45; text-decoration: none;" class="fw-semibold ms-1">Iniciar Sesión</a>
                </div>
            </form>

        </div>
    </main>

    <?php 
        require_once("../components/footer.php");
    ?>
</body>
</html>