<!DOCTYPE HTML>

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
?>

<html>
	<head>
		<title>Word Generator</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Home -->
			<div class="container">
				<div class="logo">
					<p><img src="./images/logo-bonsoleil.png" /></p>
				</div>
				
				<div class="words">
					<h2 id="randomWord">word</h2>
					<p><button href="#" class="btn_word" onclick="getRandomWord()">Word</button></p>
				</div>

				<!-- Generate Checkboxes -->
				<div class="filters level">
					<h3>LEVEL</h3>
					<ul>
						<?php
							$sql = "SELECT * FROM Levels";
							$result = mysqli_query($conn, $sql);

							while ($row = $result->fetch_assoc()) {
								echo '<li><input name="level" onclick="generateFilters()" type="checkbox" id="' . $row['id'] . '" /><label for="' . $row['id'] . '"><span></span>' . $row['level'] . '</label></li>';
							}
						?>
					</ul>
					
					<h3>FILTERS</h3>
					<div id="filters">
					</div>
					
				</div>
				<div class="add">
					<a href="" class="plus"><span class="none">plus</span></a>
				</div>
			</div>

		<!-- Scripts -->
			<script>
				function getRandomWord() 
				{
					var xhttp = new XMLHttpRequest();

					// Get CheckBoxes
					var levelCboxes = document.getElementsByName('level');
					var categoryCboxes = document.getElementsByName('category');

					var levelValues = new Array();
					var categoryValues = new Array();

					// Get checkboxes values
					for (var i = 0; i < levelCboxes.length; i++)
					{
						if (levelCboxes[i].checked)
							levelValues.push(levelCboxes[i].id);
					}

					for (var i = 0; i < categoryCboxes.length; i++)
					{
						if (categoryCboxes[i].checked)
							categoryValues.push(categoryCboxes[i].id);
					}

					// Update text on receive
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("randomWord").innerHTML = this.responseText;
						}
					};

					// JSON encode data
					var levelValuesStr = JSON.stringify(levelValues);
					var categoryValuesStr = JSON.stringify(categoryValues);

					// Send data
					xhttp.open("GET", "randomWord.php?l=" + levelValuesStr + "&c=" + categoryValuesStr, true);
					xhttp.send();
				}

				function generateFilters()
				{
					var xhttp = new XMLHttpRequest();

					var levelCboxes = document.getElementsByName('level');

					var levelValues = new Array();

					// Get checkboxes values
					for (var i = 0; i < levelCboxes.length; i++)
					{
						if (levelCboxes[i].checked)
							levelValues.push(i);
					}

					// Update text on receive
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("filters").innerHTML = this.responseText;
						}
					};

					// JSON encode data
					var levelValuesStr = JSON.stringify(levelValues);

					// Send data
					xhttp.open("GET", "filters.php?l=" + levelValuesStr, true);
					xhttp.send();
				}
    		</script>
	</body>
</html>