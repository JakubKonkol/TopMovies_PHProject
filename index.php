<?php
$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$GatunekSet=true;
session_start();

?>

<html lang="PL">
<head>
    <meta charset="UTF-8">
    <title> TopMovies</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="fajnytext.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Archivo:500|Open+Sans:300,700" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script src="functions.js"> </script>
</head>
<body>
<div class="nawigacyjny">
    <a onclick="Koszyk()"><i class="fi fi-rr-shopping-cart"></i> Koszyk</a>
    <a onclick="Profil()"><i class="fi fi-rr-user"></i> Profil</a>
    <p onClick="MainPage()"><i class="fi fi-rr-home"></i> Strona Główna </p>
    <p> O nas </p>
    <p> Dostawa/Płatnośc </p>
    <span id="alert" onclick="powiadomienie('')">  </span>
</div>
 <p class="title_text">TopMovies</p>
    <div class="fajnytext"> <div class="scrollowanie-textu">
            <ul>
                <li style="color: white">Najlepsze</li>
                <li style="color: white">Najtańsze</li>
                <li style="color: white">Najnowsze</li>
                <li style="color: white">Nagradzane</li>
                <li style="color: white">Niesamowite</li>
            </ul>
        </div>
        <span class="napisfilmy">Filmy</span></div> <br> <br> <br>

    <form action="index.php" method="POST" class="sortowanie_form">
        <label for="gatunki">Wybierz gatunek:</label>
        <select id="gatunki" name="gatunki">
            <option value="Drama">Drama</option>
            <option value="Crime/Drama">Crime/Drama</option>
            <option value="Action/Sci-Fi">Action/Sci-Fi</option>
            <option value="Biography">Biography</option>
            <option value="Horror">Horror</option>
            <option value="Comedy">Comedy</option>
            <option value="Thriller">Thriller</option>
        </select>
        <input name="formsub" type="submit" value="Sortuj">
        <input name="reset" type="submit" value="reset">
    </form>
<?php
if(isset($_POST['dodaj_do_koszyka'])){
    if(isset($_SESSION['email'])){
        $tytul = $_POST["tytul"];
        $gatunek = $_POST["gatunek"];
        $cena = $_POST["cena"];
        $mail = $_SESSION['email']['email'];
        $do_koszyka_sql = "INSERT INTO cart (tytul, gatunek, cena, user) VALUES ('$tytul', '$gatunek', '$cena','$mail')";
        $polaczenie->query($do_koszyka_sql);
    }else{
        echo "<script> powiadomienie('Musisz być zalogowany'); </script>";
    }


}


?>
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
                <form method='POST' action='index.php'> 
                <img src='$r[4]'width='200px' height='270px'>
                <h3>$r[0] <br>
                $r[1] <br> 
                Ilośc w magazynie: $r[2] <br>
                 Cena: $r[3] PLN<br></h3>
                 <input type='hidden' value='$r[0]' name='tytul'> 
                 <input type='hidden' value='$r[1]' name='gatunek'>
                 <input type='hidden' value='$r[3]' name='cena'>
                 
                 <input class='dodaj_do_koszyka_butt' type='submit' value='Do koszyka!' name='dodaj_do_koszyka'>
                 </form>
                 <form action='index.php' method='post'>
                  <input type='hidden' value='$r[0]'>  
                 <input type='submit' class='szczegolybutt' name='szczegoly' value='szczegoly'>
                 </form>
                 </div>";
    }
}
if($GatunekSet) {
    $res = mysqli_query($polaczenie, "SELECT title, genre, quantity,price, img_src,id FROM filmy");
    while ($r = mysqli_fetch_row($res)) {
        echo "
                <div class='movies' >
                <form method='POST' action='index.php'> 
                <img src='$r[4]'width='200px' height='270px'>
                <h3>$r[0] <br>
                $r[1] <br> 
                Ilośc w magazynie: $r[2] <br>
                 Cena: $r[3] PLN<br></h3>
                 <input type='hidden' value='$r[0]' name='tytul'> 
                 <input type='hidden' value='$r[1]' name='gatunek'>
                 <input type='hidden' value='$r[3]' name='cena'>
                 
                 <input class='dodaj_do_koszyka_butt' type='submit' value='Do koszyka!' name='dodaj_do_koszyka'>
                 </form>
                 <form action='index.php' method='post'>
                 <input type='hidden' value='$r[0]'>  
                 <input type='submit' class='szczegolybutt' name='szczegoly' value='szczegoly'>
                 </form>
                 </div>";
    }
}
echo "</div>";
?>



</body>

</html>

