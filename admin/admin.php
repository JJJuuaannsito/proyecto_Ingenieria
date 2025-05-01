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
        body {
            background: #f4f4f4;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }

        .ticket {
            background: white;
            border: 2px dashed #444;
            padding: 20px;
            margin: 20px auto;
            width: 350px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            position: relative;
            border-radius: 8px;
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
            width: 100%;
            font-weight: bold;
        }

        .boton:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .acciones {
            text-align: center;
            margin-top: 40px;
        }

        .acciones a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
            margin: 0 10px;
        }

        .acciones a:hover {
            text-decoration: underline;
        }

        .admin-link {
            color: green;
            font-weight: bold;
        }

        .revoke-link {
            color: red;
            font-weight: bold;
        }

        .self-note {
            color: gray;
            font-style: italic;
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

<h2>Usuarios Registrados</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Rol</th>
        <th>Acción</th>
        <th>Acción extra</th>
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
                <a class="admin-link" href="hacer_admin.php?id=<?= $user['id'] ?>">Hacer admin</a>
            <?php else: ?>
                <span class="self-note">Ya es admin</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($user['id'] !== $_SESSION['usuario']['id']): ?>
                <?php if ($user['rol'] === 'admin'): ?>
                    <a class="revoke-link" href="revocar_admin.php?id=<?= $user['id'] ?>">Revocar admin</a>
                <?php else: ?>
                    <a class="admin-link" href="hacer_admin.php?id=<?= $user['id'] ?>">Hacer admin</a>
                <?php endif; ?>
            <?php else: ?>
                <span class="self-note">Sos vos</span>
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
