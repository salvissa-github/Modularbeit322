<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css"> <!-- connect stylesheet CSS -->

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

</head>
<body>
    <nav>
    <div class="logo"> <!-- Navbar with logo and menu -->
        <a href="index.php"><img src="pictures/logo2.png" alt="Logo"></a>
    </div>
    <div class="menu">
        <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="katalog.php"><u>Katalog</u></a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
        <li><a href="login.php">Login</a></li>
        </ul>
    </div>
    </nav>

    <?php
       include("includes.php"); //include for connection
        // Set variables for pagination
        $results_per_page = 20;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start_from = ($current_page - 1) * $results_per_page;

        // Set variable for search
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Query to get total number of rows in the table
        $sql_count = "SELECT COUNT(*) FROM buecher WHERE katalog LIKE '%$search%' OR kurztitle LIKE '%$search%' OR kategorie LIKE '%$search%' OR autor LIKE '%$search%' OR zustand LIKE '%$search%'";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_array($result_count)[0];
        $total_pages = ceil($row_count / $results_per_page);
        
        echo "<div class='kata'>";
        //menu to filter
        echo "<form method='GET' action='katalog.php' class='search-form' >";
        echo "<input type='text' name='search' class='search-input' placeholder='Search...' value='".$search."'>";
            echo '<select name="category" class="search-select">
                <option value="0">Alle Kategorien</option>
                <option value="1">Alte Drucke</option>
                <option value="2">Geographie und Reisen</option>
                <option value="3">Geschichtswissenschaften</option>
                <option value="4">Naturwissenschaften</option>
                <option value="5">Kinderbücher</option>
                <option value="6">Moderne Literatur und Kunst</option>
                <option value="7">Moderne Kunst und Künstlergraphik</option>
                <option value="8">Kunstwissenschaften</option>
                <option value="9">Architektur</option>
                <option value="10">andere Sprachen</option>
                <option value="11">Naturwissenschaften - Medizin</option>
                <option value="12">Ozeanien</option>
                <option value="13">Afrika</option>
            </select>';
            echo '<input type="submit" class="search-submit" value="Search" name="submit">';
        echo '</form>';

        
        //where as a variable
        $where = "buecher.kategorie = kategorien.id AND buecher.zustand = zustaende.zustand AND(katalog LIKE '%$search%' OR kurztitle LIKE '%$search%' OR kategorien.kategorie LIKE '%$search%' OR autor LIKE '%$search%' OR zustaende.zustand LIKE '%$search%')";
       
           if(isset($_GET['category'])) {
                $category = $_GET['category'];
                $_SESSION['myKat'] = '$category';
                if($category != "0"){
                    $where.= "AND (buecher.kategorie = '$category')";
                }
            }
         
        // Query to get rows for the current page
            $sql = "SELECT
            buecher.*,
            kategorien.kategorie,
            zustaende.beschreibung
        FROM
            buecher,
            kategorien,
            zustaende
        WHERE
            $where
        ORDER BY
            buecher.id
        LIMIT $start_from, $results_per_page";
        $result = mysqli_query($conn, $sql);
            

        // Query to get total number of rows in the table
        $sql_count = "SELECT COUNT(*) FROM buecher WHERE katalog LIKE '%$search%' OR kurztitle LIKE '%$search%' OR kategorie LIKE '%$search%' OR autor LIKE '%$search%' OR zustand LIKE '%$search%'";
        $result_count = mysqli_query($conn, $sql_count);
        $row_count = mysqli_fetch_array($result_count)[0];
        $total_pages = ceil($row_count / $results_per_page);



        echo "<div class='kata'>";
        // Display table


        echo "<table><tr><th>ID</th><th>Katalog</th><th>Titel</th><th>Kategorie</th><th>Autor</th><th>Zustand</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><a href='details.php?id=".$row['id']."'>".$row['id']."</a></td>";
            echo "<td><a href='details.php?id=".$row['id']."'>".$row['katalog']."</a></td>";
            echo "<td><a href='details.php?id=".$row['id']."'>".$row['kurztitle']."</a></td>";
            echo "<td><a href='details.php?id=".$row['id']."'>".$row['kategorie']."</a></td>";
            echo "<td><a href='details.php?id=".$row['id']."'>".$row['autor']."</a></td>";
            echo "<td><a href='details.php?id=".$row['id']."'>".$row['beschreibung']."</a></td>";
            echo "</tr>";
          }
        echo "</table>";

        // Display pagination links
        echo "<div class='pagination'>";
        if ($current_page > 1) {
            if (isset($_GET['category'])){
                echo "<a href='katalog.php?page=".($current_page-1)."&category=".$category."&search=".$search."' class='previous'>Previous</a>";
            } else {
                echo "<a href='katalog.php?page=".($current_page-1)."' class='previous'>Previous</a>";
            }
        } else {
            echo "<a href='katalog.php?page=1' class='empty'></a>";
        }

        if ($current_page < $total_pages) {
            echo "<form method='GET' action='katalog.php' onsubmit='event.preventDefault(); this.submit();'>";
            echo "<input type='text' name='page' value='".$current_page."' class='current-page' pattern='[0-9]+' title='Please enter a valid page number'>";
            echo "</form>";
        }

        if ($current_page < $total_pages) {
            if (isset($_GET['category'])){
                echo "<a href='katalog.php?page=".($current_page+1)."&category=".$category."&search=".$search."' class='next'>Next</a>";
            } else {
                echo "<a href='katalog.php?page=".($current_page+1)."' class='next'>Next</a>";
            }
        
        } 
        echo "</div>";

        // Close database connection
        mysqli_close($conn);
        echo "</div>"
    ?>

    <footer> <!-- footer aus style-gründen -->
        <p>&copy; 2023 Plumencre. All rights reserved.</p>
    </footer>
</body>
</html>