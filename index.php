<?php
$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$GatunekSet=true;
session_start();

?>
<html>
<head>
    <meta charset="UTF-8">
    <title> TopMovies</title>
    <link rel="stylesheet" href="css.css">
    <script src="functions.js"> </script>
</head>
<body>
<div class="nawigacyjny">
    <a onclick="Koszyk()"> Koszyk</a>
    <p onClick="MainPage()"> Strona Główna </p>
    <p> O nas </p>
    <p> Dostawa/Płatnośc </p>
</div>
 <p class="title_text">TopMovies</p>
 <p class="subtitle_text">Najlepsze filmy w zasięgu twojej ręki!</p><br><br><br>

    <form action="index.php" method="POST" class="sortowanie_form">
        <label for="gatunki">Wybierz gatunek:</label>
        <select id="gatunki" name="gatunki">
            <option value="Drama">Drama</option>
            <option value="Crime/Drama">Crime/Drama</option>
            <option value="Action/Sci-Fi">Action/Sci-Fi</option>
            <option value="Biography">Biography</option>
            <option value="Horror">Horror</option>
            <option value="Comedy">Comedy</option>
        </select>
        <input name="formsub" type="submit" value="Sortuj">
        <input name="reset" type="submit" value="reset">
    </form>

<?php
echo "<div class='wrapper'>";
if (isset($_POST['formsub'])) {
    if(isset($_POST['reset'])){
        $GatunekSet=True;
    }
    $gatunek = $_POST["gatunki"];
    $res1 = mysqli_query($polaczenie, "SELECT title,genre,quantity,price, img_src,id FROM filmy WHERE genre LIKE '$gatunek'");
    $GatunekSet = false;
    while($r=mysqli_fetch_row($res1)) {
        echo "
                <div class='movies' >
                <form method='POST' action='index.php?id=$r[5]'> 
                <img src='$r[4]'width='200px' height='270px'>
                <h3>$r[0] <br>
                $r[1] <br> 
                Ilośc w magazynie: $r[2] <br>
                 Cena: $r[3] PLN<br></h3>
                 <input class='dodaj_do_koszyka_butt' type='submit' value='Do koszyka!' name='dodaj_do_koszyka'>
                 </form>
                 </div>";
    }
}
if($GatunekSet) {
    $res = mysqli_query($polaczenie, "SELECT title, genre, quantity,price, img_src,id FROM filmy");
    while ($r = mysqli_fetch_row($res)) {
        echo "
                <div class='movies' >
                <form method='POST' action='index.php?id=$r[5]'> 
                <img src='$r[4]'width='200px' height='270px'>
                <h3>$r[0] <br>
                $r[1] <br> 
                Ilośc w magazynie: $r[2] <br>
                 Cena: $r[3] PLN<br></h3>
                 <input class='dodaj_do_koszyka_butt' type='submit' value='Do koszyka!' name='dodaj_do_koszyka'>
                 </form>
                 </div>";
    }
}
echo "</div>";
?>



</body>

</html>

