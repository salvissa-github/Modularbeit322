<?php
session_start();  //include so that connection doesnt need to be made every time       
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "plumencre";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            echo "fff";
        }
        ?>