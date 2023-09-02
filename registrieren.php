<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
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
            var emailInput = document.getElementById("email");
            var emailValue = emailInput.value;
            var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

            if (!emailRegex.test(emailValue)) {
                var errorMessage = "Ungültige E-Mail-Adresse";
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
        <h1>Registrierungsseite</h1>
        <form action="registrieren.php" method="post" onsubmit="return validateForm();">
            <label for="benutzername">Benutzername:</label>
            <input type="text" id="benutzername" name="benutzername" required><br>
            <label for="vorname">Vorname:</label>
            <input type="text" id="vorname" name="vorname" required><br>
            <label for="name">Nachname:</label>
            <input type="text" id="nachname" name="nachname" required><br>
            <label for="email">E-Mail-Adresse:</label>
            <input type="text" id="email" name="email" required><br>
            <label for="passwort">Passwort:</label>
            <input type="password" id="passwort" name="passwort" required><br>
            <input type="submit" value="Registrieren" name="registrieren">
        </form>
    </div>

    <footer>
        <p>&copy; 2023 Plumencre. All rights reserved.</p>
    </footer>

    <?php
    if (isset($_POST['registrieren'])) {
        $vorname = $_POST['vorname'];
        $name = $_POST['nachname'];
        $benutzername = $_POST['benutzername'];
        $passwort = $_POST['passwort'];
        $email = $_POST['email'];

        // Verbindung zur Datenbank herstellen
        include("includes.php"); // include for connection
    
        // Überprüfen, ob Benutzername oder E-Mail-Adresse bereits in der Datenbank vorhanden sind
        $check_sql = "SELECT * FROM Benutzer WHERE benutzername='$benutzername' OR email='$email'";
        $check_result = $conn->query($check_sql);
        if ($check_result->num_rows > 0) {
            // Benutzername oder E-Mail-Adresse bereits vorhanden, Fehlermeldung anzeigen
            ?>
            <script>
                var errorMessage = "Benutzername oder E-Mail Adresse bereits vorhanden";
                showErrorMessage(errorMessage);
            </script>
            <?php
            exit();
        }

        // Hashen des Passworts
        $hash = password_hash($passwort, PASSWORD_DEFAULT);

        // Benutzerdaten in die Datenbank einfügen
        $insert_sql = "INSERT INTO Benutzer (vorname, name, email, benutzername, passwort) VALUES ('$vorname', '$name', '$email', '$benutzername', '$hash')";
        if ($conn->query($insert_sql) === TRUE) {
            // Benutzerdaten erfolgreich eingefügt, Benutzersitzung starten
            session_start();
            $_SESSION['benutzer_id'] = $conn->insert_id;
            $_SESSION['vorname'] = $vorname;
            $_SESSION['name'] = $name;
            header("Location: index.php");
            exit();
        } else {
            // Fehler beim Einfügen der Benutzerdaten, Fehlermeldung anzeigen
            echo "Fehler beim Anlegen des Benutzers: " . $conn->error;
        }

        // Datenbankverbindung schließen
        $conn->close();
    }
    ?>

</body>

</html>
