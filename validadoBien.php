<?php

session_start();

//Recupera las variable de SESSION
$vehiculo = $_SESSION['vehiculo'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];

if ($vehiculo == "Lancia Stratos") {
    $imagenVehiculo = "img/lanciaStratos.png";
} elseif ($vehiculo == "Audi Quattro") {
    $imagenVehiculo = "img/audiQuattro.jpg";
} elseif ($vehiculo == "Ford Escort RS1800") {
    $imagenVehiculo = "img/fordEscortRS1800.jpg";
} elseif ($vehiculo == "Subaru Impreza 555") {
    $imagenVehiculo = "img/subaruImpreza555.jpg";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva realizada</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($nombre); ?> <?php echo htmlspecialchars($apellido); ?>, tu reserva ha sido realizada</h1>
    <img src= <?php echo htmlspecialchars($imagenVehiculo);?> alt="Imagen de un coche" width="1200" height="800">
</html>
