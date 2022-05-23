<html>
<head>
    <meta charset="UTF-8">
    <title> TopMovies</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
<div class="container">
 <p class="title_text">TopMovies</p>

    <form action="index.php" method="POST">
        <label for="garunki">Wybierz gatunek:</label>
        <select id="gatunki" name="gatunki">
            <option value="Drama">Drama</option>
            <option value="Crime/Drama">Crime/Drama</option>
            <option value="Action/Sci-Fi">Action/Sci-Fi</option>
        </select><br><br>
        <input name="formsub" type="submit" value="Sortuj">
    </form>


<!-- TWORZY POLACZENIE Z BAZA DANYCH, SQL TO ZAPYTANIE A WHILE PRINTUJE PO KOLEI RZECZY Z TABELI WYBRANE SELECTEM -->
<?php

$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$GatunekSet=true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gatunek = $_POST["gatunki"];
    $res1 = mysqli_query($polaczenie, "SELECT title,genre,quantity,price FROM filmy WHERE genre LIKE '$gatunek'");
    $GatunekSet = false;
    while($r=mysqli_fetch_row($res1)) {
        echo "<div class='movies'><h3>Tytul: $r[0] <br> Gatunek: $r[1] <br> Ilośc w magazynie: $r[2] <br> Cena: $r[3] PLN<br></h3></div>";
    }
}
if($GatunekSet) {
    $res = mysqli_query($polaczenie, "SELECT title, genre, quantity,price FROM filmy");
    while ($r = mysqli_fetch_row($res)) {
        echo "<div class='movies'><h3>Tytul: $r[0] <br> Gatunek: $r[1] <br> Ilośc w magazynie: $r[2] <br> Cena: $r[3] PLN<br></h3></div>";
    }
}


?>
<!-- ------------------------------------------------------------------------>

</div>
</body>

</html>

