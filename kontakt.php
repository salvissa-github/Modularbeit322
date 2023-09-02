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
        <li><a href="kontakt.php"><u>Kontakt</u></a></li>
        <li><a href="login.php">Login</a></li>
        </ul>
    </div>
    </nav>

    <div class="form-container"> <!-- der container für das form -->
    <form class="kontaktform" action="send_form.php" method="post">
        <h2>Kontaktformular</h2>
        <label for="vorname">Vorname:</label> <!-- diverse texteingabe fenster -->
        <input type="text" class="kontakttext" id="vorname" name="vorname" required>

        <label for="nachname">Nachname:</label>
        <input type="text" class="kontakttext" id="nachname" name="nachname" required>

        <label for="email">Email:</label>
        <input type="text" class="kontakttext" id="email" name="email" required>

        <label>Geschlecht:</label>
        <div class="geschlecht-container">
            <div class="geschlecht-option">
                <label for="maennlich">Männlich</label>
                <input type="radio" id="maennlich" name="geschlecht" value="männlich">
            </div>
            <div class="geschlecht-option">
                <label for="weiblich">Weiblich</label>
                <input type="radio" id="weiblich" name="geschlecht" value="weiblich">
            </div>
            <div class="geschlecht-option">
                <label for="divers">Divers</label>
                <input type="radio" id="divers" name="geschlecht" value="divers">
            </div>
        </div>



        <label for="adresse">Adresse:</label>
        <input type="text" class="kontakttext" id="adresse" name="adresse" required>

        <label for="ort">Ort:</label>
        <input type="text" class="kontakttext" id="ort" name="ort" required>

        <label for="nachricht">Nachricht an uns:</label>
        <textarea id="nachricht" name="nachricht" required></textarea>
        <!-- submit und reset button -->
        <input type="submit" class="kontakt-submit" value="Senden">
        <input type="reset" value="Reset">
    </form>
    <div class="social"> <!-- social media verknüpfung inform von Bildern -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3844.178090556795!2d7.608055788783671!3d47.54651368482815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4791b835d222d62b%3A0x814b4fe25746cb8e!2sWirtschaftsgymnasium%20und%20Wirtschaftsmittelschule%20Basel!5e0!3m2!1sde!2sch!4v1679652392155!5m2!1sde!2sch" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div class="anr-view">
            <p><a href="https://www.facebook.com/WGWMSBasel" target="_blank"><img src="pictures/facebook.png" width="70" alt="facebook"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="https://www.instagram.com/ww_basel/" target="_blank"><img src="pictures/insta.png" width="70" alt="instagram"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="http://45plus.blog/" target="_blank"><img src="pictures/45.png" width="70" alt="45pluslogo"></a>&nbsp;&nbsp;&nbsp; &nbsp;
            <a href="https://www.youtube.com/channel/UCALKE6AsY6I8pgSVcVAaH6w" target="_blank"><img src="pictures/yt.png" width="70" alt="youtube logo"></a> 
        </div>
    </div>
    </div>

    <footer>
        <p>&copy; 2023 Plumencre. All rights reserved.</p>
    </footer>
</body>
</html>