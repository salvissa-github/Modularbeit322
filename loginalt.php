<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <nav>
    <div class="logo">
        <a href="index.php"><img src="pictures/logo2.png" alt="Logo"></a>
    </div>
    <div class="menu">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="katalog.php">Katalog</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
        <li><a href="login.php"><u>Login</u></a></li>
        </ul>
    </div>
    </nav>

    <div class="login">
        <h2>Login</h2>
        <form>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Submit">
        <input type="button" value="Reset Password">
        </form>
    </div>

    <footer>
        <p>&copy; 2023 My Website. All rights reserved.</p>
    </footer>


</body>
</html>