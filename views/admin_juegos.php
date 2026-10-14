<?php
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') 
        {
            header("Location: bienvenida.php");
            exit();
        }

    require_once("../class/conexion.php"); 

    $mensaje = "";
    $tipo_alerta = "";
    $lista_juegos = [];

    try 
        {
            $conexion = new Conexion();
            $pdo = $conexion->conectar();

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_juego'])) 
                {
                    $juego_id = intval($_POST['juego_id']);
                    $query_del = "DELETE FROM juegos WHERE ID = ?";
                    $stmt_del = $pdo->prepare($query_del);
                    if ($stmt_del->execute([$juego_id])) 
                        {
                            $mensaje = "Videojuego eliminado correctamente.";
                            $tipo_alerta = "success";
                        } else {
                            $mensaje = "Error al intentar eliminar el videojuego.";
                            $tipo_alerta = "danger";
                        }
            }

            $query_juegos = "SELECT ID AS id, Nombre_juego AS titulo, Precio AS precio, Genero AS categoria, imagen, descripcion FROM juegos ORDER BY ID DESC";
            $stmt_juegos = $pdo->prepare($query_juegos);
            $stmt_juegos->execute();
            $lista_juegos = $stmt_juegos->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        $mensaje = "Error en la base de datos: " . $e->getMessage();
        $tipo_alerta = "danger";
        }

    $pagina_actual = 'admin_juegos'; 
?>

<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store[A-Catalogo]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilos.css">

    <style>
        .table-gamer {
            background-color: #1c1d24 !important;
            color: #ffffff !important;
            border-radius: 8px;
            overflow: hidden;
        }
        .table-gamer th {
            background-color: #252630 !important;
            color: #00f2fe !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }
        .table-gamer td {
            background-color: #1c1d24 !important;
            border-color: #2d2f3b !important;
            vertical-align: middle;
        }
    </style>
    
</head>
<body class="d-flex flex-column h-100 text-white" style="background-color: #121318 !important;">

    <?php include '../components/nav.php'; ?>

    <main class="container my-5 pt-4 flex-grow-1">
        
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show border-0 shadow" role="alert">
                <?php echo $mensaje; ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h1 class="fw-bold text-uppercase m-0" style="font-size: 2rem;">
                    GESTIÓN DE <span style="color: #00f2fe;">CATÁLOGO</span>
                </h1>
                <p class="text-white-50 small m-0">Agregá, editá o eliminá los videojuegos de la tienda.</p>
            </div>
            
            <a href="agregar_juego.php" class="btn fw-bold text-dark px-4 py-2 text-uppercase" style="background-color: #00f2fe; border: none; border-radius: 6px;">
                ➕ Nuevo Juego
            </a>
        </div>

        <div class="table-responsive shadow-lg">
            <table class="table table-gamer m-0">
                <thead>
                    <tr>
                        <th width="80">ID</th>
                        <th width="100">Miniatura</th>
                        <th>Título</th>
                        <th>Género</th>
                        <th>Precio</th>
                        <th width="180" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($lista_juegos)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-white-50 py-4">No hay videojuegos registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($lista_juegos as $juego): ?>
                            <tr>
                                <td class="fw-bold text-white-50">#<?php echo $juego['id']; ?></td>
                                <td>
                                    <img src="../<?php echo htmlspecialchars($juego['imagen'] ?? 'img/default.png'); ?>" alt="Portada" class="img-fluid rounded border border-secondary" style="max-height: 50px; object-fit: cover;">
                                </td>
                                <td class="fw-bold text-white-50"><?php echo htmlspecialchars($juego['titulo']); ?></td>
                                <td><span class="badge bg-secondary text-uppercase px-2 py-1"><?php echo htmlspecialchars($juego['categoria']); ?></span></td>
                                <td class="text-success fw-bold">$<?php echo number_format($juego['precio'], 2, ',', '.'); ?></td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="editar_juego.php?id=<?php echo $juego['id']; ?>" class="btn btn-sm btn-warning fw-bold text-dark">
                                            ✏️ Editar
                                        </a>
                                        <form action="" method="POST" onsubmit="return confirm('¿Estás seguro de que querés borrar permanentemente este juego?');" style="margin: 0;">
                                            <input type="hidden" name="juego_id" value="<?php echo $juego['id']; ?>">
                                            <button type="submit" name="eliminar_juego" class="btn btn-sm btn-danger fw-bold text-dark">
                                                🗑️ Borrar
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include '../components/footer.php'; ?>
</body>
</html>