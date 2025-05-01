<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $query = $conexion->prepare("INSERT INTO usuarios (username, password, rol) VALUES (?, ?, 'user')");
    $query->bind_param("ss", $username, $password);

    if ($query->execute()) {
        echo "<div class='success'>Registro exitoso. <a href='login.php'>Iniciar sesión</a></div>";
        exit;
    } else {
        echo "<div class='error'>Error al registrar.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        form {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            width: 300px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background: #2ecc71;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background: #27ae60;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
        }

        .success a {
            color: #155724;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form method="POST">
    <h2>Registro</h2>
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Registrarse</button>
</form>

</body>
</html>
