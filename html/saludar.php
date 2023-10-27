<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_econolentes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if (isset($_SESSION["user_id"])) {

    $userId = $_SESSION["user_id"];


    $query = "SELECT nombre FROM usuarios WHERE id = $userId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $nombre = $row["nombre"];
            echo $nombre;
        }
    } else {
        echo "No se encontraron datos del usuario.";
    }
} else {
    echo "ID de usuario no encontrado en la sesión.";
}

$conn->close();
?>
