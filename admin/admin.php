<?php
include '../conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$resultado = $conexion->query("SELECT o.id, o.pedido, o.fecha, u.username 
    FROM ordenes o JOIN usuarios u ON o.usuario_id = u.id ORDER BY o.fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos - Admin</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .ticket {
            background: white;
            border: 2px dashed #444;
            padding: 20px;
            margin-bottom: 20px;
            width: 300px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            position: relative;
        }
        .ticket::before, .ticket::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            background: #eef2f5;
            border-radius: 50%;
        }
        .ticket::before {
            top: -10px;
            left: -10px;
        }
        .ticket::after {
            bottom: -10px;
            right: -10px;
        }
        .boton {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }
        .boton:hover {
            background-color: #218838;
        }
        .acciones {
            margin-top: 40px;
        }
        .acciones a {
            margin-right: 20px;
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>

<h1>Órdenes Recibidas</h1>

<?php while ($fila = $resultado->fetch_assoc()): ?>
    <div class="ticket">
        <strong>Usuario:</strong> <?= htmlspecialchars($fila['username']) ?><br>
        <strong>Pedido:</strong> <?= nl2br(htmlspecialchars($fila['pedido'])) ?><br>
        <strong>Fecha:</strong> <?= $fila['fecha'] ?><br>
        <button class="boton" onclick="finalizar(<?= $fila['id'] ?>)">Finalizado</button>
    </div>
<?php endwhile; ?>

<h2>Usuarios registrados</h2>

<table border="1" cellpadding="8" cellspacing="0" style="background:white; border-collapse: collapse; margin-top: 20px;">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
    <?php
    $usuarios = $conexion->query("SELECT id, username, rol FROM usuarios");
    while ($user = $usuarios->fetch_assoc()):
    ?>
    <tr>
        <td><?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['username']) ?></td>
        <td><?= $user['rol'] ?></td>
        <td>
            <?php if ($user['rol'] !== 'admin'): ?>
                <a href="hacer_admin.php?id=<?= $user['id'] ?>" style="color:green;">Hacer admin</a>
            <?php else: ?>
                <span style="color:gray;">Ya es admin</span>
            <?php endif; ?>
        </td>

        <td>
    <?php if ($user['id'] !== $_SESSION['usuario']['id']): ?>
        <?php if ($user['rol'] === 'admin'): ?>
            <a href="revocar_admin.php?id=<?= $user['id'] ?>" style="color:red;">Revocar admin</a>
        <?php else: ?>
            <a href="hacer_admin.php?id=<?= $user['id'] ?>" style="color:green;">Hacer admin</a>
        <?php endif; ?>
    <?php else: ?>
        <span style="color:gray;">Sos vos</span>
    <?php endif; ?>
</td>


    </tr>
    <?php endwhile; ?>
</table>


<div class="acciones">
    <a href="../logout.php">Cerrar sesión</a>
</div>

<script>
function finalizar(id) {
    if (confirm("¿Estás seguro de que este pedido fue realizado?")) {
        window.location.href = "eliminar_pedido.php?id=" + id;
    }
}
</script>

</body>
</html>
