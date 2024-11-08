<?php

//Inicio la sesión
session_start();

$coches = array(
    array(
        "id" => 1,
        "modelo" => "Lancia Stratos",
        "disponible" => true,
        "fecha_inicio" => null,  // Fecha de inicio en formato Y-M-D
        "fecha_fin" => null      // Fecha de fin en formato Y-M-D
    ),
    array(
        "id" => 2,
        "modelo" => "Audi Quattro",
        "disponible" => true,
        "fecha_inicio" => null,
        "fecha_fin" => null
    ),
    array(
        "id" => 3,
        "modelo" => "Ford Escort RS1800",
        "disponible" => false,
        "fecha_inicio" => "2024-10-25",
        "fecha_fin" => "2024-11-02"
    ),
    array(
        "id" => 4,
        "modelo" => "Subaru Impreza 555",
        "disponible" => true,
        "fecha_inicio" => null,
        "fecha_fin" => null
    )
);

define('USUARIOS',
array(
    array(
        "nombre" => "Iker",
        "apellido" => "Arana",
        "dni" => "12345678Z"
    ),
    array(
        "nombre" => "María",
        "apellido" => "Gómez",
        "dni" => "87654321X"
    ),
    array(
        "nombre" => "Carlos",
        "apellido" => "López",
        "dni" => "13579246P"
    ),
    array(
        "nombre" => "Laura", 
        "apellido" => "Martínez",
        "dni" => "24681357N"
    )
));

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$vehiculo = $_POST['vehiculo'];
$fecha_inicio = $_POST['fecha_inicio'];
$duracion = $_POST['duracion'];

//Guardo las variables en un array de SESSION para poder acceder a ellos desde otro .php
$_SESSION['nombre'] = $nombre;
$_SESSION['apellido'] = $apellido;
$_SESSION['dni'] = $dni;
$_SESSION['vehiculo'] = $vehiculo;
$_SESSION['fecha_inicio'] = $fecha_inicio;
$_SESSION['duracion'] = $duracion;

$nombreValido = $apellidoValido = $dniValido = $usuarioValido = $fecha_inicioValido = $duracionValida = $modeloDisponible = False;

//Comprobación nombre
if (!empty($nombre)) {
    $nombreValido=True;
}
//Comprobación apellido
if (!empty($apellido)) {
    $apellidoValido=True;
}
//Comprobación DNI
$numeros = substr($dni, 0, -1);
$letra = substr($dni, -1);
$letras = "TRWAGMYFPDXBNJZSQVHLCKE";  
if (!empty($dni)){
    if (substr($letras, $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
        $dniValido=True;
    } 
}
//Comprobación usuarios
function usuarioRegistrado($dni,$nombre,$apellido) {
    foreach (USUARIOS as $usuario) {
        if ($usuario['dni'] === $dni && $usuario['nombre'] === $nombre && $usuario['apellido'] === $apellido) {
            return true;
        }
    }
    return false;
}

if ($nombreValido && $apellidoValido && $dniValido && usuarioRegistrado($dni,$nombre,$apellido)) {
    $usuarioValido=True;
}
//Comprobación fecha
$fechaActual = new DateTime();
$fechaReserva = new DateTime($fecha_inicio);
if (!empty($fecha_inicio)){
    if ($fechaReserva >= $fechaActual) {
        $fecha_inicioValido=True;
    }
}
//Comprobación duración
if (is_numeric($duracion) && $duracion >=1 && $duracion <= 30) {
    $duracionValida=True;
}
//Comprobación disponibilidad de coche
foreach ($coches as $coche) {
    if ($coche['modelo'] === $vehiculo) {
        if ($coche['disponible']) {
            if ($coche['fecha_inicio']!=null && $coche['fecha_fin']!=null) {
                $fechaInicioCoche = new DateTime($coche['fecha_inicio']);
                $fechaFinCoche = new DateTime($coche['fecha_fin']);
                if ($fechaReserva > $fechaFinCoche || $fechaReserva < $fechaInicioCoche) {
                    $modeloDisponible=True; 
                }
            } else {
                $modeloDisponible=True;
            }
        } 
    }
}

//Guardar variables en SESSION
$_SESSION['nombreValido'] = $nombreValido;
$_SESSION['apellidoValido'] = $apellidoValido;
$_SESSION['dniValido'] = $dniValido;
$_SESSION['usuarioValido'] = $usuarioValido;
$_SESSION['fecha_inicioValido'] = $fecha_inicioValido;
$_SESSION['duracionValida'] = $duracionValida;
$_SESSION['modeloDisponible'] = $modeloDisponible;

//Redireccionamiento
if ($usuarioValido && $fecha_inicioValido && $duracionValida && $modeloDisponible){
    header("Location: validadoBien.php");
    exit();
} else {
    header("Location: validadoMal.php");
    exit();
}
