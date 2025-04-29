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
        echo "Login incorrecto.";
    }
}
?>

<form method="POST">
    Usuario: <input type="text" name="username"><br>
    Contraseña: <input type="password" name="password"><br>
    <button type="submit">Ingresar</button>
</form>
<a href="registro.php">Registro</a>
