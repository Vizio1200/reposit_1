<?php
require_once 'bd.php';

if(!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
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
    <title>Detalles del Celular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Detalles del Celular</h1>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </div>
        
        <div class="card shadow">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9"><?= $celular['id'] ?></dd>
                    
                    <dt class="col-sm-3">Marca:</dt>
                    <dd class="col-sm-9"><?= htmlspecialchars($celular['marca']) ?></dd>
                    
                    <dt class="col-sm-3">Modelo:</dt>
                    <dd class="col-sm-9"><?= htmlspecialchars($celular['modelo']) ?></dd>
                    
                    <dt class="col-sm-3">Precio:</dt>
                    <dd class="col-sm-9">$<?= number_format($celular['precio'], 2) ?></dd>
                </dl>
                
                <div class="mt-4">
                    <a href="update.php?id=<?= $celular['id'] ?>" class="btn btn-warning">Editar</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>