<?php
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

if ($usuario['rol'] === 'admin') {
    header("Location: admin/admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú</title>
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            resize: vertical;
            margin-bottom: 15px;
        }

        button {
            background: #e67e22;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background: #d35400;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Hola, <?= htmlspecialchars($usuario['username']) ?>!</h1>

    <form action="admin/pedido.php" method="POST">
        <label>¿Qué querés pedir?</label>
        <textarea name="pedido" rows="4" cols="40" required></textarea>
        <button type="submit">Hacer orden</button>
    </form>

    <a href="logout.php">Cerrar sesión</a>
</div>

</body>
</html>
