<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap">


    <title>Mostrar Información de Usuarios</title>
</head>

<body>
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
                        <img src="../assets/devchallenges.svg" alt="User Image" height="20" style="margin-right: 10px">
                    </div>
                    <div>
                        <!-- Aquí muestra la información del usuario -->
                        <?php if (isset($fila['photo'])) : ?>
                            <img src="../assets/<?= $fila['photo'] ?>" alt="User Photo" height="40" style="border-radius: 10%;">
                        <?php endif; ?>
                        <span><?= $fila['name'] ?></span>
                        <!-- Quité el dropdown de Bootstrap y cambié por un enlace simple -->
                        <select onchange="location = this.value;" class="arrow-select">
                            <option value="#" selected disabled>Acciones</option>
                            <option value="../scripts_php/logout.php">Cerrar Sesión</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                </header>
                <div class="infoHeader" style="text-align: center;">
                    <h1 style="margin-bottom: 5px">Información de Usuarios</h1>
                    <h4 style="font-weight: normal; margin-top: 0;">Basic info, like your name and photo</h4>
                </div>
                <table>
                    <!-- <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <!-- <td><?= $fila['name'] ?></td> -->
                            <td>
                                <div>
                                    <h3>Profile</h3>
                                    <h4>Some info may be visible to other people</h4>
                                </div>
                            </td>
                            <td style="text-align: center;" colspan="2">
                                <!-- Cambié el estilo para que se asemeje a un botón -->
                                <a href="../views/edit_usuario.php?id=<?= $fila['id'] ?>" style=" border: 1px solid #ddd; padding: 10px; color: gray; text-decoration: none; margin-top: 40px; display: inline-block; line-height: 30px; border-radius: 10px">Edit</a>
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
                            <td><?= str_repeat('*', strlen($fila['contrasena'])) ?></td>
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