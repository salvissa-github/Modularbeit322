<!-- login.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css?v=1">
    <script>
        function showErrorMessage(message) {
            var popup = document.createElement('div');
            popup.textContent = message;
            popup.style.position = 'fixed';
            popup.style.top = '50%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.padding = '10px 20px';
            popup.style.backgroundColor = 'red';
            popup.style.color = 'white';
            popup.style.fontWeight = 'bold';
            popup.style.borderRadius = '5px';

            document.body.appendChild(popup);

            setTimeout(function () {
                popup.parentNode.removeChild(popup);
            }, 3000);
        }

        function validateForm() {
            var benutzernameInput = document.getElementById("benutzername");
            var benutzernameValue = benutzernameInput.value;
            var passwortInput = document.getElementById("passwort");
            var passwortValue = passwortInput.value;

            if (benutzernameValue.trim() === "" || passwortValue.trim() === "") {
                var errorMessage = "Bitte füllen Sie alle Felder aus";
                showErrorMessage(errorMessage);
                return false;
            }
        }
    </script>
</head>

<body>
    <nav>
        <div class="logo">
            <a href="index.php"><img src="pictures/logo2.png" alt="Logo"></a>
        </div>
        <div class="menu">
            <ul> <!-- Navbar -->
                <li><a href="index.php">Home</a></li>
                <li><a href="katalog.php">Katalog</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
                <li><a href="login.php"><u>Login</u></a></li>
            </ul>
        </div>
    </nav>

    <div class="login">
        <h2>Login</h2>
        <form action="login.php" method="post" onsubmit="return validateForm();">
            <label for="benutzername">Benutzername:</label>
            <input type="text" id="benutzername" name="benutzername"><br><br>
            <label for="passwort">Passwort:</label>
            <input type="password" id="passwort" name="passwort"><br><br>
            <input type="submit" value="Submit" name="submit" id="submit">
        </form>
        <div class="regbutton">
            <a href="registrieren.php" id="registrieren" class="regbutton">Registrieren</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Plumencre. All rights reserved.</p>
    </footer>

    <?php
    include("includes.php"); // include for connection

    if (isset($_POST['submit'])) {

        $benutzername = $_POST['benutzername'];
        $passwort = $_POST['passwort'];

        // Überprüfen, ob Benutzername oder E-Mail-Adresse bereits in der Datenbank vorhanden sind
        $check_user_sql = "SELECT * FROM Benutzer WHERE benutzername = '$benutzername' OR email = '$benutzername'";
        $result = $conn->query($check_user_sql);

        if ($result->num_rows > 0) {
            // Der Benutzer existiert bereits, fahre fort mit der Anmeldung
            $row = $result->fetch_assoc();
            $stored_hash = $row['passwort'];

            if (password_verify($passwort, $stored_hash)) {
                // Benutzersitzung starten
                session_start();
                $_SESSION['benutzer_id'] = $row['id'];
                $_SESSION['vorname'] = $row['vorname'];
                $_SESSION['nachname'] = $row['nachname'];
                header("Location: index.php");
                exit();
            } else {
                $errorMessage = "Falsches Passwort";
                echo "<script>showErrorMessage('$errorMessage');</script>";
            }
        } else {
            $errorMessage = "Benutzer nicht gefunden";
            echo "<script>showErrorMessage('$errorMessage');</script>";
        }
    }

    // Datenbankverbindung schließen
    $conn->close();

    ?>

</body>

</html>
