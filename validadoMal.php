<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva no válida</title>
    <!--Colores para validaciones correctas o incorrectas-->
    <style>
        .valido {
            color: green;
        }
        .no-valido {
            color:red;
        }
    </style>
</head>
<body>
    <h1>La reserva no es correcta</h1>
    <!--Muestra si validación es correcta o no para cada caso-->
    <p class="<?= $_SESSION['nombreValido'] ? 'valido' : 'no-valido'; ?>">Nombre: <?= $_SESSION['nombre']; ?></p>
    <p class="<?= $_SESSION['apellidoValido'] ? 'valido' : 'no-valido'; ?>">Apellido: <?= $_SESSION['apellido']; ?></p>
    <p class="<?= $_SESSION['dniValido'] ? 'valido' : 'no-valido'; ?>">DNI: <?= $_SESSION['dni']; ?></p>
    <?php if ($_SESSION['usuarioValido']): ?>
        <p class="valido"><strong>Usuario válido</strong></p>
    <?php else: ?>
        <p class="no-valido"><strong>Usuario no válido</strong></p>
    <?php endif; ?>
    <?php if ($_SESSION['fecha_inicioValido']): ?>
        <p class="valido">Fecha inicio: <?= $_SESSION['fecha_inicio']; ?></p>
    <?php else: ?>
        <p class="no-valido">La fecha de inicio <?= $_SESSION['fecha_inicio']; ?> no es posterior a la fecha actual</p>
    <?php endif; ?>
    <p class="<?= $_SESSION['duracionValida'] ? 'valido' : 'no-valido'; ?>">Duración: <?= $_SESSION['duracion']; ?> días</p>
    <?php if ($_SESSION['modeloDisponible']): ?>
        <p class="valido">El modelo <?= $_SESSION['vehiculo']; ?> está disponible</p>
    <?php else: ?>
        <p class="no-valido">El modelo <?= $_SESSION['vehiculo']; ?> no está disponible</p>
    <?php endif; ?>
</body>
</html>
