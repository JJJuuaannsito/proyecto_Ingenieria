<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $query = $conexion->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, ?, 'user')");
    $query->bind_param("ss", $username, $password);

    if ($query->execute()) {
        echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
        exit;
    } else {
        echo "Error al registrar.";
    }
}
?>

<link rel="stylesheet" href="estilo.css">

<form method="POST">
    <h2>Registro</h2>
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
</form>
