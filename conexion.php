<?php
$conexion = new mysqli("localhost", "root", "", "restaurante");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
session_start();
?>
