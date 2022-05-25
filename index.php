<html>
<head>
    <meta charset="UTF-8">
    <title> TopMovies</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

 <p class="title_text">TopMovies</p>
 <p class="subtitle_text">Najlepsze filmy w zasięgu twojej ręki!</p><br><br><br>

    <form action="index.php" method="POST" class="sortowanie_form">
        <label for="gatunki">Wybierz gatunek:</label>
        <select id="gatunki" name="gatunki">
            <option value="LEAK' OR 1=1-- "> Wszystkie</option>
            <option value="Drama">Drama</option>
            <option value="Crime/Drama">Crime/Drama</option>
            <option value="Action/Sci-Fi">Action/Sci-Fi</option>
            <option value="Biography">Biography</option>
            <option value="Horror">Biography</option>

        </select>
        <input name="formsub" type="submit" value="Sortuj">
    </form>






<!-- TWORZY POLACZENIE Z BAZA DANYCH, SQL TO ZAPYTANIE A WHILE PRINTUJE PO KOLEI RZECZY Z TABELI WYBRANE SELECTEM -->
<?php
echo "<div class='wrapper'>";
$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$GatunekSet=true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gatunek = $_POST["gatunki"];
    $res1 = mysqli_query($polaczenie, "SELECT title,genre,quantity,price, img_src FROM filmy WHERE genre LIKE '$gatunek'");
    $GatunekSet = false;
    while($r=mysqli_fetch_row($res1)) {
        echo "<div class='movies' ><img src='$r[4]'width='200px' height='270px'><h3>$r[0] <br>$r[1] <br> Ilośc w magazynie: $r[2] <br> Cena: $r[3] PLN<br></h3></div>";
    }
}
if($GatunekSet) {
    $res = mysqli_query($polaczenie, "SELECT title, genre, quantity,price, img_src FROM filmy");
    while ($r = mysqli_fetch_row($res)) {
        echo "<div class='movies'><img src='$r[4]' width='200px' height='270px'><h3>$r[0] <br>$r[1] <br> Ilośc w magazynie: $r[2] <br> Cena: $r[3] PLN<br></h3></div>";
    }
}
echo "</div>";
?>
<!-- ------------------------------------------------------------------------>


</body>

</html>

