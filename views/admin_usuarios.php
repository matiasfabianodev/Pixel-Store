<?php
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
        header("Location: bienvenida.php");
        exit();
    }

    require_once("../class/conexion.php"); 

    $admin_actual_id = $_SESSION['usuario_id']; 
    $mensaje = "";
    $tipo_alerta = "";

    try 
        {
            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_rol'])) 
                {
                    $usuario_mod_id = intval($_POST['usuario_id']);
                    $nuevo_rol = trim($_POST['nuevo_rol']);

                    if ($nuevo_rol === 'admin' || $nuevo_rol === 'cliente') 
                        {
                            if ($usuario_mod_id === $admin_actual_id) 
                                {
                                    $mensaje = "¡Cuidado! No podés cambiar tu propio rol para no perder acceso al panel.";
                                    $tipo_alerta = "warning";
                                } else {
                                    $query_update = "UPDATE usuarios SET rol = ? WHERE ID = ?";
                                    $stmt_update = $pdo->prepare($query_update);
                                    
                                    if ($stmt_update->execute([$nuevo_rol, $usuario_mod_id])) 
                                        {
                                            $mensaje = "Permisos actualizados con éxito.";
                                            $tipo_alerta = "success";
                                        } else {
                                            $mensaje = "Error al intentar actualizar los permisos.";
                                            $tipo_alerta = "danger";
                                        }
                                    }
                            }
                    }
            $query_usuarios = "SELECT ID, nombre, email, rol FROM usuarios ORDER BY ID DESC";
            $stmt_usuarios = $pdo->prepare($query_usuarios);
            $stmt_usuarios->execute();
            $lista_usuarios = $stmt_usuarios->fetchAll(PDO::FETCH_ASSOC);
        }
    catch (PDOException $e) 
        {
            $mensaje = "Error en la base de datos: " . $e->getMessage();
            $tipo_alerta = "danger";
        }

    $pagina_actual = 'admin_usuarios'; 
?>

<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store [A-Permisos]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 bg-dark text-white" style="background-color: #121318 !important;">

    <?php include '../components/nav.php'; ?>

    <main class="container my-5 pt-4">
        
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h1 class="fw-black text-uppercase tracking-wider m-0" style="font-size: 2rem;">
                    Control de <span style="color: #d9db45;">Permisos</span>
                </h1>
                <p class="text-white-50 small m-0">Modificá los rangos de acceso de los usuarios registrados en Pixel Store.</p>
            </div>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?= $tipo_alerta ?> alert-dismissible fade show text-center py-3 mb-4 fw-medium" role="alert">
                <?= $mensaje ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-lg" style="background-color: #1c1d24; border-radius: 12px; border-bottom: 4px solid #00f2fe !important;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover align-middle m-0" style="--bs-table-bg: transparent; --bs-table-hover-bg: #23252f;">
                        
                        <thead style="border-bottom: 2px solid #2b2d37;">
                            <tr class="text-uppercase text-white-50" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                                <th class="ps-4 py-3">ID</th>
                                <th class="py-3">Usuario</th>
                                <th class="py-3">Email</th>
                                <th class="py-3 text-center">Rango Actual</th>
                                <th class="pe-4 py-3 text-end">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (empty($lista_usuarios)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        No hay usuarios registrados en el sistema.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($lista_usuarios as $user): ?>
                                    <tr style="border-bottom: 1px solid #2b2d37;">
                                        
                                        <td class="ps-4 fw-bold text-white-50" style="font-size: 0.9rem;">
                                            #<?= $user['ID'] ?>
                                        </td>
                                        
                                        <td class="fw-bold text-white">
                                            <?= htmlspecialchars($user['nombre']) ?>
                                            <?php if ($user['ID'] === $admin_actual_id): ?>
                                                <small class="text-muted d-block" style="font-size: 0.7rem; color: #d9db45 !important;">(Vos)</small>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="text-white-50" style="font-size: 0.9rem;">
                                            <?= htmlspecialchars($user['email']) ?>
                                        </td>
                                        
                                        <td class="text-center">
                                            <?php if ($user['rol'] === 'admin'): ?>
                                                <span class="badge px-2 py-1.5 fw-bold text-uppercase" style="background-color: #d9db45; color: #0f1015; font-size: 0.7rem;">
                                                    👑 Admin
                                                </span>
                                            <?php else: ?>
                                                <span class="badge px-2 py-1.5 fw-bold text-uppercase" style="background-color: rgba(0, 242, 254, 0.1); color: #00f2fe; border: 1px solid rgba(0, 242, 254, 0.3); font-size: 0.7rem;">
                                                    🕹️ Cliente
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="pe-4 text-end">
                                            <form action="admin_usuarios.php" method="POST" class="d-inline-flex gap-2 align-items-center justify-content-end">
                                                
                                                <input type="hidden" name="usuario_id" value="<?= $user['ID'] ?>">
                                                
                                                <select name="nuevo_rol" class="form-select form-select-sm text-white bg-dark border-secondary" style="width: 120px; font-size: 0.85rem; border-color: #3b3e4f !important;">
                                                    <option value="cliente" <?= $user['rol'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                                                    <option value="admin" <?= $user['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                </select>
                                                
                                                <button type="submit" name="actualizar_rol" class="btn btn-sm btn-info fw-bold text-uppercase py-1" style="background-color: #00f2fe; border: none; color: #0f1015; font-size: 0.75rem;">
                                                    Guardar
                                                </button>
                                                
                                            </form>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </main>

    <?php include '../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>