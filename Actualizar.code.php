<?php
require_once 'bd.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$error = '';
$success = '';

$celular = seleccionar("SELECT * FROM celulares WHERE id = $1", [$id]);

if(empty($celular)) {
    die("Registro no encontrado");
}

$celular = $celular[0];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $marca = $_POST['marca'] ?? '';
    $modelo = $_POST['modelo'] ?? '';
    $precio = $_POST['precio'] ?? '';
    
    if(empty($marca) || empty($modelo) || empty($precio)) {
        $error = 'Todos los campos son obligatorios';
    } else {
        $query = "UPDATE celulares SET marca = $1, modelo = $2, precio = $3 WHERE id = $4";
        $result = modificar($query, [$marca, $modelo, $precio, $id]);
        
        if($result) {
            $success = 'Celular actualizado correctamente';
            // Actualizar datos locales
            $celular['marca'] = $marca;
            $celular['modelo'] = $modelo;
            $celular['precio'] = $precio;
        } else {
            $error = 'Error al actualizar el celular';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Celular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Editar Celular</h1>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </div>
        
        <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        
        <div class="card shadow">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" 
                               value="<?= htmlspecialchars($celular['marca']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" 
                               value="<?= htmlspecialchars($celular['modelo']) ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio ($)</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" 
                               value="<?= htmlspecialchars($celular['precio']) ?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>