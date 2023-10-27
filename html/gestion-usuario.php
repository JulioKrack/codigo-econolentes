<?php
include("../config/bd.php");
function getUsuarios($conn) {
    $sql = "SELECT Id,nombre,contrasena,(select rol from roles where Id=rol_id) as roles,telefono,email,apellidos FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}


// Obtener todas las reservas existentes
$usuarios = getUsuarios($conn);

// Cerrar la conexión después de obtener los datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Usuario</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
    <header>
        <div class="enlaces">
            <a href="Perfil empleado.html">Mi perfil</a>
            <a href="login.html">Salir</a>
        </div>

        <h1 class = "titulo">Panel de Administración</h1>
    </header>
    <hr>

    <div class="contenedor">
        <div class="gestiones">
            <h2 class="usuario"><a href="gestion-usuario.html">Gestionar Usuarios</a></h2>
            <h2><a href="gestion-producto.html">Gestionar Productos</a></h2>
        </div>


        <div class="tabla" >
            <label>Buscar: <input type="text" id="buscar" name="buscar" /></label>
            <p>Resultados</p>
            <table>
                <tr>
                    <th hidden>Código</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Apellidos</th>
                </tr>
                <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td hidden><?php echo $usuario['Id']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['contrasena']; ?></td>
                    <td><?php echo $usuario['roles']; ?></td>
                    <td><?php echo $usuario['telefono']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['apellidos']; ?></td>
                </tr>
                    
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</body>
</html>