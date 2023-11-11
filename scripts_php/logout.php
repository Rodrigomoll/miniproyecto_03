<?php
// Iniciar la sesión si no está iniciada
session_start();

session_unset();

// Destruir la sesión
session_destroy();
header("Location: ../views/login.php");
exit();
?>
