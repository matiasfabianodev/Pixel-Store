<?php
    session_start();

    if (!isset($_SESSION['usuario_id'])) 
        {
            header("Location: login.php");
            exit();
        }

    require_once("../class/conexion.php"); 

    $usuario_id = $_SESSION['usuario_id'];
    $mensaje = "";
    $tipo_alerta = "";

    try 
        {
            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
                {
                    $nombre = trim($_POST['nombre']);
                    $email = trim($_POST['email']);
                    $password_nueva = trim($_POST['password']);

                    if (empty($nombre) || empty($email)) 
                        {
                            $mensaje = "El nombre y el email son obligatorios.";
                            $tipo_alerta = "danger";
                        } else {
                            if (!empty($password_nueva)) 
                                {
                                    $password_encriptada = password_hash($password_nueva, PASSWORD_DEFAULT);
                                    $query = "UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE ID = ?";
                                    $stmt = $pdo->prepare($query);
                                    $resultado_exec = $stmt->execute([$nombre, $email, $password_encriptada, $usuario_id]);
                                } else {
                                    $query = "UPDATE usuarios SET nombre = ?, email = ? WHERE ID = ?";
                                    $stmt = $pdo->prepare($query);
                                    $resultado_exec = $stmt->execute([$nombre, $email, $usuario_id]);
                                }

                        if ($resultado_exec) 
                            {
                                $mensaje = "¡Perfil actualizado correctamente!";
                                $tipo_alerta = "success";
                                $_SESSION['usuario_nombre'] = $nombre; 
                            } else {
                                $mensaje = "Error al actualizar los datos.";
                                $tipo_alerta = "danger";
                            }
                    }
                }

            $query_buscar = "SELECT nombre, email, rol FROM usuarios WHERE ID = ?";
            $stmt_buscar = $pdo->prepare($query_buscar);
            $stmt_buscar->execute([$usuario_id]);
            $user_data = $stmt_buscar->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) 
        {
            $mensaje = "Error de conexión: " . $e->getMessage();
            $tipo_alerta = "danger";
        }

    $pagina_actual = 'perfil'; 
?>

<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store [Perfil]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">

    <?php include '../components/nav.php'; ?>

    <main class="container my-5 pt-4">
        
        <div class="row mb-4">
            <div class="col">
                <h1 class="fw-black text-uppercase tracking-wider m-0" style="font-size: 2rem;">
                    Configuración de <span style="color: #00f2fe;">Cuenta</span>
                </h1>
            </div>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?= $tipo_alerta ?> alert-dismissible fade show text-center py-3 mb-4 fw-medium" role="alert">
                <?= $mensaje ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            
            <div class="col-lg-4">
                <div class="card border-0 p-4 h-100 text-center text-lg-start" style="background-color: #1c1d24; border-radius: 12px; border-top: 4px solid #d9db45 !important;">
                    
                    <div class="d-flex flex-column align-items-center py-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3 shadow-lg" 
                            style="width: 100px; height: 100px; background: linear-gradient(135deg, #181920, #2b2d37); border: 3px solid #d9db45;">
                            <span style="font-size: 3rem;">👾</span>
                        </div>
                        
                        <h4 class="fw-bold mb-1 text-white text-center">
                            <?= htmlspecialchars($user_data['nombre'] ?? 'Usuario') ?>
                        </h4>
                            <p class="text-white-50 small mb-3"><?= htmlspecialchars($user_data['email'] ?? '') ?></p>
                        
                        <?php if (($user_data['rol'] ?? '') === 'admin'): ?>
                            <span class="badge px-3 py-2 fw-bold text-uppercase shadow-sm" style="background-color: #d9db45; color: #0f1015; letter-spacing: 1px;">
                                👑 Administrador
                            </span>
                        <?php else: ?>
                            <span class="badge px-3 py-2 fw-bold text-uppercase shadow-sm" style="background-color: rgba(0, 242, 254, 0.1); color: #00f2fe; border: 1px solid rgba(0, 242, 254, 0.3);">
                                🕹️ Cliente
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if (($user_data['rol'] ?? '') === 'admin'): ?>
                        <hr class="border-secondary opacity-15 my-4">
                        <a href="admin_juegos.php" class="btn btn-dark text-start border-0 py-2.5 px-3 rounded d-flex align-items-center justify-content-between" style="background-color: #15161c;">
                            <span>📦 Gestionar Catálogo</span>
                            <span style="color: #d9db45;">★</span>
                        </a>
                        <hr>
                        <a href="admin_usuarios.php" class="btn btn-dark text-start border-0 py-2.5 px-3 rounded d-flex align-items-center justify-content-between" style="background-color: #15161c;">
                            <span>✏️ Gestionar Permisos</span>
                            <span style="color: #d9db45;">★</span>
                        </a>
                    <?php endif; ?>

                </div>
            </div>

            <div class="col-lg-8">
                <div class="card border-0 p-4 h-100" style="background-color: #1c1d24; border-radius: 12px; border-left: 4px solid #00f2fe !important;">
                    
                    <h3 class="fw-bold mb-4 text-uppercase tracking-wide" style="color: #00f2fe; font-size: 1.3rem;">
                        Editar Datos Personales
                    </h3>

                    <form action="perfil.php" method="POST" class="row g-3">
                        
                        <div class="col-md-6">
                            <label for="nombre" class="form-label small fw-semibold text-white-50">Nombre en Pantalla</label>
                            <input type="text" class="form-control bg-dark text-white p-2.5" id="nombre" name="nombre" 
                                value="<?= htmlspecialchars($user_data['nombre'] ?? '') ?>" required 
                                style="border: 1px solid #2b2d37 !important;">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label small fw-semibold text-white-50">Dirección de Email</label>
                            <input type="email" class="form-control bg-dark text-white p-2.5" id="email" name="email" 
                                value="<?= htmlspecialchars($user_data['email'] ?? '') ?>" required 
                                style="border: 1px solid #2b2d37 !important;">
                        </div>

                        <div class="col-12">
                            <hr class="border-secondary opacity-15 my-3">
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label small fw-semibold text-white-50">Cambiar Contraseña (Opcional)</label>
                            <input type="password" class="form-control bg-dark text-white p-2.5" id="password" name="password" 
                                placeholder="Dejar este campo vacío para conservar la actual"
                                style="border: 1px solid #2b2d37 !important;">
                        <div class="form-text mt-2" style="font-size: 0.75rem; color: #a5aab5 !important;">
                            💡 Solo completa este casillero si realmente deseas renovar tu clave de seguridad.
                        </div>
                        </div>

                        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 pt-2">
                            <a href="../index.php" class="text-decoration-none small fw-semibold order-2 order-sm-1" style="color: #6c7284; transition: color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#6c7284'">
                                ←Volver
                            </a>
                            <button type="submit" class="btn fw-bold text-uppercase px-4 py-2.5 btn-register order-1 order-sm-2 w-100 w-sm-auto shadow">
                                Guardar Cambios
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </main>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>