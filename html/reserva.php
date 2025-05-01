<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $personas = $_POST['personas'];

    // Guardar en archivo (puedes cambiar por base de datos)
    $reserva = "$nombre, $email, $fecha, $hora, $personas personas\n";
    file_put_contents("reservas.txt", $reserva, FILE_APPEND);

    echo "<h1>Reserva Confirmada</h1>";
    echo "<p>Gracias, $nombre. Tu reserva para $personas persona(s) el $fecha a las $hora ha sido registrada.</p>";
    echo "<a href='index.html'>Volver al inicio</a>";
} else {
    echo "<p>Acceso no permitido.</p>";
}
?>
