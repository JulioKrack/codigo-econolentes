<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_SESSION["user_id"]; 

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"]; 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_econolentes";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $checkEmailQuery = "SELECT id FROM usuarios WHERE email='$email' AND id!=$userId";
    $result = $conn->query($checkEmailQuery);
    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado en la base de datos";
    } else {
        $updateQuery = "UPDATE usuarios SET nombre='$nombre', apellidos='$apellidos', telefono='$telefono', email='$email', contrasena='$contrasena' WHERE id=$userId";
        if ($conn->query($updateQuery) === TRUE) {
            echo "Datos actualizados correctamente";
        } else {
            echo "Error al actualizar la base de datos";
        }
    }
    $conn->close();
}
?>
