<?php
require_once 'bd.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "DELETE FROM celulares WHERE id = $1";
    $result = eliminar($query, [$id]);
    
    if($result) {
        header('Location: index.php?deleted=1');
        exit;
    } else {
        die("Error al eliminar el registro");
    }
}

$celular = seleccionar("SELECT * FROM celulares WHERE id = $1", [$id]);

if(empty($celular)) {
    die("Registro no encontrado");
}

$celular = $celular[0];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Celular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Eliminar Celular</h1>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </div>
        
        <div class="card shadow">
            <div class="card-body">
                <p>¿Estás seguro de que deseas eliminar este celular?</p>
                
                <dl class="row">
                    <dt class="col-sm-3">Marca:</dt>
                    <dd class="col-sm-9"><?= htmlspecialchars($celular['marca']) ?></dd>
                    
                    <dt class="col-sm-3">Modelo:</dt>
                    <dd class="col-sm-9"><?= htmlspecialchars($celular['modelo']) ?></dd>
                </dl>
                
                <form method="POST">
                    <button type="submit" class="btn btn-danger">Confirmar Eliminación</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>