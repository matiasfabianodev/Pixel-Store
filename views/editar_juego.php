<?php
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') 
        {
            header("Location: bienvenida.php");
            exit();
        }

    require_once("../class/conexion.php"); 
    $conexion = new Conexion();
    $pdo = $conexion->conectar();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) 
        {
            $id_juego   = intval($_POST['id']);
            $nombre     = $_POST['nombre_juego'];
            $genero     = $_POST['genero'];
            $plataforma = $_POST['plataforma'];
            $precio     = $_POST['precio'];
            $imagen     = $_POST['imagen'];
            $descripcion= $_POST['descripcion'];

            $query_update = "UPDATE juegos SET Nombre_juego = ?, Genero = ?, Plataforma = ?, Precio = ?, imagen = ?, descripcion = ? WHERE ID = ?";
            $stmt_update = $pdo->prepare($query_update);
            
            if ($stmt_update->execute([$nombre, $genero, $plataforma, $precio, $imagen, $descripcion, $id_juego])) 
                {
                    header("Location: admin_juegos.php");
                    exit();
                } else {
                    $error = "Error al intentar actualizar el juego.";
                }
        }   

    if (!isset($_GET['id'])) 
        {
            header("Location: admin_juegos.php");
            exit();
        }

    $id_juego = intval($_GET['id']);
    $query = "SELECT * FROM juegos WHERE ID = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id_juego]);
    $juego = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$juego) 
        {
            header("Location: admin_juegos.php");
            exit();
        }
?>

<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store[A-Editar Articulo]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 text-white" style="background-color: #121318 !important;">

    <?php include '../components/nav.php'; ?>

    <main class="container my-5 pt-4 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="d-flex align-items-center mb-4 gap-3">
                    <img src="../<?php echo htmlspecialchars($juego['imagen']); ?>" alt="Portada" class="rounded border border-secondary" style="width: 80px; height: 80px; object-fit: cover;">
                    <div>
                        <h2 class="fw-bold m-0" style="color: #00f2fe;">EDITAR JUEGO</h2>
                        <p class="text-white-50 m-0">Estás editando: <strong><?php echo htmlspecialchars($juego['Nombre_juego']); ?></strong></p>
                    </div>
                </div>

                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="card border-0 shadow-lg" style="background-color: #1c1d24;">
                    <div class="card-body p-4">
                        <form action="editar_juego.php?id=<?php echo $juego['ID']; ?>" method="POST">
                            
                            <!-- ID oculto para saber qué juego actualizar -->
                            <input type="hidden" name="id" value="<?php echo $juego['ID']; ?>">

                            <div class="mb-3">
                                <label class="form-label text-white-50 fw-bold small">Nombre del Juego</label>
                                <input type="text" name="nombre_juego" class="form-control bg-dark text-white border-secondary" value="<?php echo htmlspecialchars($juego['Nombre_juego']); ?>" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label text-white-50 fw-bold small">Género</label>
                                    <input type="text" name="genero" class="form-control bg-dark text-white border-secondary" value="<?php echo htmlspecialchars($juego['Genero']); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-white-50 fw-bold small">Plataforma</label>
                                    <input type="text" name="plataforma" class="form-control bg-dark text-white border-secondary" value="<?php echo htmlspecialchars($juego['Plataforma']); ?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-white-50 fw-bold small">Precio (AR$)</label>
                                    <input type="number" step="0.01" name="precio" class="form-control bg-dark text-white border-secondary" value="<?php echo $juego['Precio']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white-50 fw-bold small">Ruta de la Imagen</label>
                                <input type="text" name="imagen" class="form-control bg-dark text-white border-secondary" value="<?php echo htmlspecialchars($juego['imagen']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white-50 fw-bold small">Descripción</label>
                                <textarea name="descripcion" rows="4" class="form-control bg-dark text-white border-secondary" required><?php echo htmlspecialchars($juego['descripcion']); ?></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="admin_juegos.php" class="btn btn-secondary fw-bold">Cancelar</a>
                                <button type="submit" name="actualizar" class="btn btn-warning fw-bold text-dark">💾 Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <?php include '../components/footer.php'; ?>

</body>
</html>