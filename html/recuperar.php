<?php
session_start(); 

if(isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_econolentes";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query = "SELECT nombre, apellidos, telefono, email, contrasena FROM usuarios WHERE id = $userId";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $telefono = $row["telefono"];
            $email = $row["email"];
            $contrasena = $row["contrasena"];
        }
        $response = array(
            "nombre" => $nombre,
            "apellidos" => $apellidos,
            "telefono" => $telefono,
            "email" => $email,
            "contrasena" => $contrasena,
        );
        
        echo json_encode($response);
    } else {
        echo "No se encontraron datos del usuario.";
    }
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>


