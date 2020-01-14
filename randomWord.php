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

    $levels = [2];
    $category = [1, 2, 3];

    // Get Random Word
    $sql = "SELECT word FROM Words WHERE category IN (" . implode(",", array_map('intval', $category)) . ") AND level IN (" . implode(",", array_map('intval', $levels)) . ") ORDER BY RAND() LIMIT 1";

    $result = mysqli_query($conn, $sql);
    $val = $result->fetch_assoc();

    $conn->close();

    echo "<h3>" . $val['word'] . "</h3>";
?>