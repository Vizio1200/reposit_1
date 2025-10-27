<?php
// Función de conexión a la base de datos
function conectarBD() {
    $connection = pg_connect(
        "host=localhost 
        port=5432 
        dbname=crud_bootstrap 
        user=postgres 
        password=221206"
    );
    
    if(!$connection) {
        die("Error de conexión: " . pg_last_error());
    }
    return $connection;
}

// Insertar registros
function insertar($query, $datos) {
    $connection = conectarBD();
    $result = pg_query_params($connection, $query, $datos);
    pg_close($connection);
    return $result;
}

// Eliminar registros
function eliminar($query, $datos) {
    $connection = conectarBD();
    $result = pg_query_params($connection, $query, $datos);
    pg_close($connection);
    return $result;
}

// Actualizar registros
function modificar($query, $datos) {
    $connection = conectarBD();
    $result = pg_query_params($connection, $query, $datos);
    pg_close($connection);
    return $result;
}

// Seleccionar registros
function seleccionar($query, $datos = []) {
    $connection = conectarBD();
    $result = pg_query_params($connection, $query, $datos);
    $data = pg_fetch_all($result);
    pg_close($connection);
    return $data ?: [];
}
?>