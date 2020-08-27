<?php
    // Database Settings
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = 'word-generator';

    // Connect to db
    $conn = new mysqli($servername, $username, $password, $database);

    if (mysqli_connect_error()) {
        die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
    }

    // Receive Data from ajax
    $levels = json_decode($_GET["l"]);      
    $categories = json_decode($_GET["c"]);

    $levelsStr = implode(", ", $levels);
    $categoriesStr = implode(", ", $categories);

    // Get Random Word
    $sql = "SELECT * FROM Words WHERE category IN(" . $categoriesStr . ") AND level IN (" . $levelsStr . ") ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);

    // If result, print it
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h2>" . $row['word'] . "</h2>";
    }

    $conn->close();
?>