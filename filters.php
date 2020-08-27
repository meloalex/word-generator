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
    
    // Increment each value to match db key
    foreach ($levels as $k => &$val)
        $val = $val + 1;
    $levelsStr = implode(", ", $levels);

    // Get filters
    $sql = "SELECT * FROM Category WHERE level IN(" . $levelsStr . ")";
	$result = mysqli_query($conn, $sql);

    echo "<ul>";

    while ($row = $result->fetch_assoc()) {
        echo '<li><input name="category" type="checkbox" id="' . $row['id'] . '" /><label for="' . $row['id'] . '"><span></span>' . $row['category'] . '</label></li>';
    }

    echo "</ul>";

    $conn->close();
?>