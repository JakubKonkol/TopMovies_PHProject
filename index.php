<html>
<head>
    <meta charset="UTF-8">
    <title> TopMovies</title>
    <link rel="stylesheet" href="css.css">
</head>
<div class="container">
 <p class="title_text">TopMovies</p>
<!-- TWORZY POLACZENIE Z BAZA DANYCH, SQL TO ZAPYTANIE A WHILE PRINTUJE PO KOLEI RZECZY Z TABELI WYBRANE SELECTEM -->
<?php
$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$res = mysqli_query($polaczenie, "SELECT title, genre, quantity,price FROM filmy");
while($r=mysqli_fetch_row($res)) {
    echo "<div class='movies'><h3>Tytul: $r[0] <br> Gatunek: $r[1] <br> Ilośc w magazynie: $r[2] <br> Cena: $r[3] PLN<br></h3></div>";
}
?>
<!-- ------------------------------------------------------------------------>

</div>
</body>

</html>

