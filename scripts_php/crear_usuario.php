<?php

require_once "../config/database.php";

$email = $_POST["email"];
$password = $_POST["password"];

// Definir valores predeterminados para campos
$defaultPhoto = '../assets/default.png';
$defaultName = 'Nombre por defecto';
$defaultBio = 'Bio por defecto';
$defaultPhone = 0;

//Comprobar si los campos están vacios y asignar los valores predeterminados
$photo = empty($_POST["photo"]) ? 'default.png' : $_POST["photo"];
$name = empty($_POST["name"]) ? $defaultName : $_POST["name"];
$bio = empty($_POST["bio"]) ? $defaultBio : $_POST["bio"];
$phone = empty($_POST["phone"]) ? $defaultPhone : $_POST["phone"];

//Hashear la contraseña antes de almacenarla 
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$queryString = "insert into usuarios (email, contrasena, photo, name, bio, phone)
values ('$email','$hashedPassword', '$photo', '$name', '$bio','$phone')";
$mysqli->query($queryString);

echo "El usuario ha sido creado";

//VARIABLE DE SESION
session_start();
$_SESSION["newUserEmail"] = $email;
header("Location: /views/dashboard.php");

?>