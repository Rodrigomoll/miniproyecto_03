<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/index.css">
    <title>Document</title>
</head>
<body>

    <div class="containerLogin">
        <div class="devImage">
            <img src="../assets/devchallenges.svg" alt="">
        </div>
        <h2>Login</h2>
        <form action="../scripts_php/entrar_usuario.php" method="post">
            <div>
                <input type="text" class="formInput" name="email" placeholder="Email">
            </div>
            <div>
                <input type="password" class="formInput" name="password" placeholder="Password">
            </div>

            <button class="loginBoton" type="submit">Login</button>
            <p class="texto">or continue with these social profile</p>
            <div class="socialIcons">
                <a href=""><img src="../assets/Google.svg" alt=""></a>
                <a href=""><img src="../assets/Facebook.svg" alt=""></a>
                <a href=""><img src="../assets/Twitter.svg" alt=""></a>
                <a href=""><img src="../assets/Gihub.svg" alt=""></a>
            </div>
            <p>Don't have an account yet?<a class="loginUp" href="/index.php">Register</a></p>
        </form>
    </div>
</body>
</html>