<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "../config/database.php";

    $res = $mysqli->query("select * from usuarios where email = '$email'");

    //ver si el usuario existe con ese nombre
    if ($res->num_rows === 1) {
        $userData = $res->fetch_assoc();

        if (password_verify($password, $userData["contrasena"])) {
            //Guardar los datos del usuario en una variable de sesión
            session_start();
            $_SESSION["email"] = $userData["email"];
            header("Location: ../views/dashboard.php");
        }else{
            echo "Contraseña incorrecta";
        }
    } else {
        echo "No existe ese usuario";
    }
}
