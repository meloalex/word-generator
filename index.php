<!DOCTYPE html>
<html>
    
    <script>
        function loadDoc() {
            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("demo2").innerHTML =
                this.responseText;
                }
            };

            xhttp.open("GET", "randomWord.php", true);
            xhttp.send();
        }
    </script>

    <body>
        <div id="demo">
            <h1>The XMLHttpRequest Object</h1>
            <button type="button" onclick="loadDoc()">Random Word</button>
            
            <div id="demo2">

            </div>
        </div>
    </body>
</html>
