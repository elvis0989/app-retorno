<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "reportes_db");

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Capturar datos del formulario
$rma = $_POST['rma'];
$caja = $_POST['numero_caja'];
$categoria = $_POST['categoria'];
$producto = $_POST['producto'];
$faltante = $_POST['cantidad_faltante'];
$sobrante = $_POST['cantidad_sobrante'];

// Preparar la consulta
$sql = "INSERT INTO novedades (rma, numero_caja, categoria, producto, cantidad_faltante, cantidad_sobrante)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssii", $rma, $caja, $categoria, $producto, $faltante, $sobrante);

// Ejecutar y verificar
if ($stmt->execute()) {
    echo "Registro guardado exitosamente.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
