<?php
session_start();
require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos del formulario
    $id = $_POST["id"];
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validar y actualizar los datos en la base de datos
    if ($name !== "" && $bio !== "" && $phone !== "" && $email !== "" && $password !== "") {
        // Aquí deberías realizar cualquier validación adicional que necesites

        // Actualizar la base de datos
        $updateQuery = "UPDATE usuarios SET name='$name', bio='$bio', phone='$phone', email='$email', contrasena='$password' WHERE id=$id";
        if ($_FILES["new_photo"]["size"] > 0) {
            // Si se proporciona una nueva imagen, procesa la carga
            $newPhotoName = $_FILES["new_photo"]["name"];
            $newPhotoTemp = $_FILES["new_photo"]["tmp_name"];
            $newPhotoPath = "../assets/$newPhotoName";

            move_uploaded_file($newPhotoTemp, $newPhotoPath);
            $updateQuery = "UPDATE usuarios SET name='$name', bio='$bio', phone='$phone', email='$email', contrasena='$password', photo='$newPhotoName' WHERE id=$id";
        }
        $result = $mysqli->query($updateQuery);

        if ($result) {
            header("Location: ../views/dashboard.php");
            exit();
        } else {
            echo "Error al actualizar los datos: " . $mysqli->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
