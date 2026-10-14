<?php
    session_start();

    require_once("../class/conexion.php");

    $error = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) 
                {
                    $error = "Por favor, completá todos los campos.";
                } else {
                    $conexion = new Conexion();
                    $pdo = $conexion->conectar();
                    
                    $sql = "SELECT * FROM usuarios WHERE email = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$email]);
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($usuario && password_verify($password, $usuario['password'])) 
                    {
                        $_SESSION['usuario_id'] = $usuario['ID'];
                        $_SESSION['usuario_nombre'] = $usuario['nombre'];
                        $_SESSION['usuario_rol'] = $usuario['rol'];

                        header("Location: bienvenida.php");
                        exit();
                        } else {
                            $error = "El correo electrónico o la contraseña son incorrectos.";
                        }
            }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store [Login]</title>
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">
    <?php 
        $pagina_actual = 'login';
        require_once("../components/header.php");
        require_once("../components/nav.php");
    ?>

    <main class="container my-5 flex-grow-1 d-flex align-items-center justify-content-center">
        <div class="p-4 p-md-5 rounded text-white shadow" style="background-color: #252525; max-width: 450px; width: 100%; border-top: 4px solid #37d6db;">
            
            <h3 class="text-uppercase fw-bold mb-4" style="color: #d9db45; letter-spacing: 1px;">
                Iniciar Sesión
            </h3>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger py-2 px-3 mb-4 small" style="background-color: rgba(220, 53, 69, 0.2); border: 1px solid #dc3545; color: #ea868f;">
                    ⚠️ <?= $error ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label Invisible for="email" class="form-label small fw-semibold text-light mb-1">Correo Electrónico:</label>
                    <input type="email" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="email" name="email" placeholder="ejemplo@correo.com" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-light mb-1">Contraseña:</label>
                    <input type="password" class="form-control bg-dark border-secondary text-white py-2 px-3 input-custom-gamer" id="password" name="password" placeholder="********" required>
                </div>

                <button type="submit" class="btn fw-bold text-uppercase w-100 py-2 mb-3" style="background-color: #37d6db; color: #000; border-radius: 8px; transition: all 0.2s;">
                    LISTO
                </button>

                <div class="text-center mt-3 small">
                    <span style="color: #cfcfcf;">No tenés cuenta?</span> 
                    <a href="registro.php" style="color: #d9db45; text-decoration: none;" class="fw-semibold ms-1">Registrarse</a>
                </div>
            </form>

        </div>
    </main>

    <?php 
        require_once("../components/footer.php");
    ?>
</body>
</html>