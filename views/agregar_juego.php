<?php
    session_start();

    if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') 
        {
            header("Location: bienvenida.php");
            exit();
        }

    require_once("../class/conexion.php"); 
    $mensaje_error = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_juego'])) 
        {
            $nombre      = trim($_POST['nombre_juego']);
            $genero      = trim($_POST['genero']);
            $plataforma  = trim($_POST['plataforma']);
            $precio      = floatval($_POST['precio']);
            $descripcion = trim($_POST['descripcion']);

            $imagen_db = "img/default.png"; 

            if (isset($_FILES['imagen_archivo']) && $_FILES['imagen_archivo']['error'] === UPLOAD_ERR_OK) 
                {
                    
                    $ruta_temporal = $_FILES['imagen_archivo']['tmp_name'];
                    $nombre_original = $_FILES['imagen_archivo']['name'];
                    
                    $nombre_limpio = time() . "_" . basename($nombre_original); 

                    $carpeta_destino = "../img/" . $nombre_limpio;

                    if (move_uploaded_file($ruta_temporal, $carpeta_destino)) 
                        {
                            $imagen_db = "img/" . $nombre_limpio; 
                        } else {
                            $mensaje_error = "Error al subir la imagen físicamente a la carpeta.";
                        }
                } else {
                    $mensaje_error = "Por favor, seleccioná una imagen válida.";
                }

            if (empty($mensaje_error)) 
                {
                    try 
                        {
                            $conexion = new Conexion();
                            $pdo = $conexion->conectar();

                            $query_insert = "INSERT INTO juegos (Nombre_juego, Genero, Plataforma, Precio, imagen, descripcion) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt_insert = $pdo->prepare($query_insert);
                            
                            if ($stmt_insert->execute([$nombre, $genero, $plataforma, $precio, $imagen_db, $descripcion])) 
                                {
                                    header("Location: admin_juegos.php");
                                    exit();
                                } else {
                                    $mensaje_error = "No se pudo registrar el videojuego en la base de datos.";
                                }

                        } catch (PDOException $e) {
                            $mensaje_error = "Error en la base de datos: " . $e->getMessage();
                        }
                }
    }
?>

<!DOCTYPE html>
<html lang="es" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pixel Store[A-Agregar Articulo]</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/estilos.css">
</head>
<body class="d-flex flex-column h-100 text-white" style="background-color: #121318 !important;">

    <?php include '../components/nav.php'; ?>

    <main class="container my-5 pt-4 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="mb-4">
                    <h2 class="fw-bold m-0" style="color: #00f2fe;">➕ AGREGAR NUEVO JUEGO</h2>
                    <p class="text-white-50 m-0">Subí la portada y completá los datos del nuevo videojuego.</p>
                </div>

                <?php if (!empty($mensaje_error)): ?>
                    <div class="alert alert-danger border-0 shadow" role="alert">
                        ⚠️ <?php echo $mensaje_error; ?>
                    </div>
                <?php endif; ?>

                <div class="card border-0 shadow-lg" style="background-color: #1c1d24; border-radius: 8px;">
                    <div class="card-body p-4">
                        
                        <form action="agregar_juego.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label class="form-label text-white-50 fw-bold small">Nombre del Juego</label>
                                <input type="text" name="nombre_juego" class="form-control bg-dark text-white border-secondary" placeholder="Ej: Resident Evil 4" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label text-white-50 fw-bold small">Género</label>
                                    <input type="text" name="genero" class="form-control bg-dark text-white border-secondary" placeholder="Ej: Survival Horror" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-white-50 fw-bold small">Plataforma</label>
                                    <input type="text" name="plataforma" class="form-control bg-dark text-white border-secondary" placeholder="Ej: PlayStation 5" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label text-white-50 fw-bold small">Precio (AR$)</label>
                                    <input type="number" step="0.01" name="precio" class="form-control bg-dark text-white border-secondary" placeholder="0.00" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-white-50 fw-bold small">Portada del Juego</label>
                                <input type="file" name="imagen_archivo" class="form-control bg-dark text-white border-secondary" accept="image/*" required>
                                <div class="form-text text-white-50" style="font-size: 0.75rem;">Seleccioná una imagen (.jpg, .jpeg, .png). El sistema la guardará automáticamente en el proyecto.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-white-50 fw-bold small">Descripción / Reseña</label>
                                <textarea name="descripcion" rows="4" class="form-control bg-dark text-white border-secondary" placeholder="Escribí una breve descripción del videojuego..." required></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="admin_juegos.php" class="btn btn-secondary fw-bold">Cancelar</a>
                                <button type="submit" name="agregar_juego" class="btn fw-bold text-dark" style="background-color: #00f2fe;">➕ Guardar Videojuego</button>
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