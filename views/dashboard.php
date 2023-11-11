<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard.css"> <!-- Agrega un archivo CSS para estilizar la tabla si lo deseas -->
    <title>Mostrar Información de Usuarios</title>
</head>

<body>
    <h1>Información de Usuarios</h1>
    <?php
    session_start();
    require_once "../config/database.php";

    if (isset($_SESSION["email"])) {
        $loggedUserEmail = $_SESSION["email"];
        // Recuperar datos de la BD para el usuario logueado
        $query = "SELECT * FROM usuarios WHERE email = '$loggedUserEmail'";
    } elseif (isset($_SESSION["newUserEmail"])) {
        $newUserEmail = $_SESSION["newUserEmail"];
        // Recuperar datos de la BD para el nuevo usuario creado
        $query = "SELECT * FROM usuarios WHERE email = '$newUserEmail'";
    } else {
        echo "Usuario no logueado ni creado";
        exit; 
    }

    $result = $mysqli->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
    ?>

                <header>
                    <div>
                        <!-- Aquí puedes poner la imagen en la esquina izquierda -->
                        <img src="../assets/devchallenges.svg" alt="User Image" height="40">
                    </div>
                    <div>
                        <!-- Aquí muestra la información del usuario -->
                        <?php if (isset($fila['photo'])) : ?>
                            <img src="../assets/<?= $fila['photo'] ?>" alt="User Photo" height="30" style="border-radius: 50%;">
                        <?php endif; ?>
                        <span><?= $fila['name'] ?></span>
                        <!-- Agrega el dropdown para cerrar sesión y volver al login -->
                        <select onchange="location = this.value;">
                            <option value="#" selected disabled>Acciones</option>
                            <option value="../scripts_php/logout.php">Cerrar Sesión</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                </header>
                <table>
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $fila['name'] ?></td>
                            <td colspan="2" style="text-align: center;">
                                <a href="../views/edit_usuario.php?id=<?= $fila['id'] ?>">Editar</a>
                            </td>
                        </tr>
                        <?php if (isset($fila['photo'])) : ?>
                            <tr>
                                <td>Photo</td>
                                <td><img src="../assets/<?= $fila['photo'] ?>" height="50" alt="photoDefault"></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td>Name</td>
                            <td><?= $fila['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Bio</td>
                            <td><?= $fila['bio'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?= $fila['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $fila['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><?= $fila['contrasena'] ?></td>
                        </tr>
                    </tbody>
                </table>
    <?php
            }
        } else {
            echo "No se encontraron registros del usuario.";
        }
    } else {
        echo "Error al recuperar datos de la BD: " . $mysqli->error;
    }

    ?>

</body>

</html>