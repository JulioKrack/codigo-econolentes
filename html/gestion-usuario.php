<?php
include("../config/bd.php");
function getUsuarios($conn) {
    $sql = "SELECT Id,nombre,contrasena,(select rol from roles where Id=rol_id) as roles,telefono,email,apellidos,(case when estado= 1 then 'Disponible' when estado= 2 then 'Baneado' else 'no hallado' END) as estados  FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

if(isset($_GET['Id'])){
    $id= $_GET['Id'];
    $sql="SELECT estado FROM usuarios WHERE Id='$id'";
    $result = $conn->query($sql);   
    $row = $result->fetch_assoc();
    $estado = $row["estado"];
    if ($estado == 2) {
        $sql = "UPDATE usuarios Set estado=1 WHERE Id = '$id'";
        if ($conn->query($sql) === TRUE) {
            header("Location:./gestion-usuario.php");
        } else {
            echo "Error: Este usuario esta asignado con otras tablas " . $sql . "<br>" . $conn->error;
        }
    } else {
        $sql = "UPDATE usuarios Set estado=2 WHERE Id = '$id'";
        if ($conn->query($sql) === TRUE) {
            header("Location:./gestion-usuario.php");
        } else {
            echo "Error: Este usuario esta asignado con otras tablas " . $sql . "<br>" . $conn->error;
        }
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
        <div class="contenedor">
        <div class="gestiones">
            <a href="gestion-usuario.php">Gestionar Usuarios</a>
            <a href="gestion-producto.html">Gestionar Productos</a>
        </div>
    </header>



    <div class="contenido">
        <label class=buscar>Buscar: <input type="text" id="buscar" name="buscar" /></label>
        <div class="tabla" >
            <table>
                <tr>
                    <th hidden>Código</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                </tr>
                <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td hidden><?php echo $usuario['Id']; ?></td>
                    <td><?php echo $usuario['nombre']; ?></td>
                    <td><?php echo $usuario['apellidos']; ?></td>
                    <td><?php echo $usuario['contrasena']; ?></td>
                    <td><?php echo $usuario['roles']; ?></td>
                    <td><?php echo $usuario['telefono']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['estados'];?></td>
                    <td>
                        <a href="gestion-usuario.php?Id=<?php echo $usuario['Id']; ?>">Cambiar Estado</a>
                    </td>
                </tr>
                    
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</body>
</html>