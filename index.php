<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Document</title>
</head>

<body>
    <div class="containerLogin">
        <div class="devImage">
            <img src="./assets/devchallenges.svg" alt="">
        </div>
        <h2>Join thousands of learners from around the world</h2><br>
        <h3>Master web development by making real life projects. There are multiple paths for you to choose</h3>
        <form action="/scripts_php/crear_usuario.php" method="post">
            <div>
                <input type="text" class="formInput" name="email" placeholder="Email">
            </div>
            <div>
                <input type="password" class="formInput" name="password" placeholder="Password">
            </div>

            <button class="loginBoton" type="submit">Enviar</button>
            <p class="texto">or continue with these social profile</p>
            <div class="socialIcons">

                <a href=""><img src="./assets/Google.svg" alt=""></a>
                <a href=""><img src="./assets/Facebook.svg" alt=""></a>
                <a href=""><img src="./assets/Twitter.svg" alt=""></a>
                <a href=""><img src="./assets/Gihub.svg" alt=""></a>
            </div>
            <p>Already a member? <a class="loginUp" href="./views/login.php">Login</a></p>
        </form>
    </div>
</body>

</html>