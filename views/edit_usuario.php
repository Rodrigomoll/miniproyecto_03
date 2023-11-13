<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/dashboard.css"> <!-- Agrega un archivo CSS para estilizar la tabla si lo deseas -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
        // No hay usuario logueado ni creado
        echo "Usuario no logueado ni creado";
        exit; // Terminar la ejecución del script
    }

    $result = $mysqli->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
    ?>
                <header>
                    <div>
                        <!-- Aquí puedes poner la imagen en la esquina izquierda -->
                        <img src="../assets/devchallenges.svg" alt="User Image" height="20" style="margin-right: 10px">
                    </div>
                    <div>
                        <!-- Aquí muestra la información del usuario -->
                        <?php if (isset($fila['photo'])) : ?>
                            <img src="../assets/<?= $fila['photo'] ?>" alt="User Photo" height="40" style="border-radius: 10%;">
                        <?php endif; ?>
                        <span><?= $fila['name'] ?></span>
                        <!-- Agrega el dropdown para cerrar sesión y volver al login -->
                        <select onchange="location = this.value;" class="arrow-select">
                            <option value="#" selected disabled>Acciones</option>
                            <option value="../scripts_php/logout.php">Cerrar Sesión</option>
                            <!-- Agrega más opciones según tus necesidades -->
                        </select>
                    </div>
                </header>
                <div>
                    <button type="button" class="btn btn-link" onclick="location.href='../views/dashboard.php'">Back</button>

                </div>
                <form action="../scripts_php/update_usuario.php" method="post" enctype="multipart/form-data">
                    <table>
                        <thead>
                            <!-- <tr>
                                <th>Field</th>
                                <th>Value</th>
                            </tr> -->
                        </thead>
                        <tbody>
                            <?php if (isset($fila['photo'])) : ?>
                                <tr>
                                    <td>Photo</td>
                                    <td>
                                        <?php if (isset($fila['photo'])) : ?>
                                            <label for="fileInput">
                                                <img src="../assets/<?= $fila['photo'] ?>" height="50" alt="photoDefault" style="cursor: pointer;">
                                            </label>
                                        <?php endif; ?>
                                        <input type="file" accept="image/*" name="new_photo" id="fileInput" style="display:none">
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" name="name" value="<?= $fila['name'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Bio</td>
                                <td>
                                    <input type="text" name="bio" value="<?= $fila['bio'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>
                                    <input type="text" name="phone" value="<?= $fila['phone'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" name="email" value="<?= $fila['email'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <input type="password" name="password" value="<?= $fila['contrasena'] ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                    <button type="submit">Save</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                <script>
                    const fileInput = document.getElementById('fileInput');
                    const image = document.querySelector('img');

                    image.addEventListener('click', () => {
                        fileInput.click();
                    })
                </script>
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