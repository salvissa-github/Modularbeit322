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
        <ul> <!-- Navbar mit Menu -->
        <li><a href="index.php">Home</a></li>
        <li><a href="katalog.php">Katalog</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
        <li><a href="login.php">Login</a></li>
        </ul>
    </div>
    </nav>

    <?php
        include("includes.php"); // include for connection

        // Get the ID of the selected row from the query parameter
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        // Query to get the details of the selected row
        $sql = "SELECT buecher.*,
            kategorien.kategorie,
            zustaende.beschreibung
        FROM
            buecher,
            kategorien,
            zustaende 
        WHERE buecher.id = $id AND buecher.kategorie = kategorien.id AND buecher.zustand = zustaende.zustand";
        $result = mysqli_query($conn, $sql);

        // Display the details of the selected row
        echo "<div class='details'>";
            if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<h1>".$row['kurztitle']."</h1>";
            echo "<p><strong>ID:</strong> ".$row['id']."</p>";
            echo "<p><strong>Katalog:</strong> ".$row['katalog']."</p>";
            echo "<p><strong>Titel:</strong> ".$row['kurztitle']."</p>";
            echo "<p><strong>Kategorie:</strong> ".$row['kategorie']."</p>";
            echo "<p><strong>Autor:</strong> ".$row['autor']."</p>";
            echo "<p><strong>Zustand:</strong> ".$row['beschreibung']."</p>";
            } else {
            echo "No details found.";
            }
        echo "</div>";
        // Close database connection
        mysqli_close($conn);
?>


    <footer> <!-- footer für style -->
        <p>&copy; 2023 Plumencre. All rights reserved.</p>
    </footer>
</body>
</html>