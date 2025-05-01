<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    $query = $conexion->prepare("SELECT * FROM usuarios WHERE username=? AND password=?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $resultado = $query->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit;
    } else {
        echo "<div class='error'>Login incorrecto.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
            background: #3498db;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            background: #ffcccc;
            color: #990000;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #990000;
            border-radius: 6px;
            text-align: center;
        }
    </style>
</head>
<body>

<form method="POST">
    <label>Usuario:</label>
    <input type="text" name="username" required>
    <label>Contraseña:</label>
    <input type="password" name="password" required>
    <button type="submit">Ingresar</button>
    <a href="registro.php">Registro</a>
</form>

</body>
</html>
