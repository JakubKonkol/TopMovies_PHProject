<?php
require "dbconnect.php";
$GatunekSet=true;
session_start();

?>

<html lang="PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> TopMovies</title>
    <link rel="stylesheet" href="cssy/css.css">
    <link rel="stylesheet" href="cssy/fajnytext.css">
    <link href="https://fonts.googleapis.com/css?family=Cardo:400,700|Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Archivo:500|Open+Sans:300,700" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script src="https://kit.fontawesome.com/a9c3b869ed.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="cssy/footer.css">
    <script src="scripts/functions.js"> </script>
</head>
<body>
<div class="nawigacyjny">
    <a onclick="Koszyk()"><i class="fi fi-rr-shopping-cart"></i> Koszyk</a>
    <a onclick="Profil()"><i class="fi fi-rr-user"></i> Profil</a>
    <p onClick="MainPage()"><i class="fi fi-rr-home"></i> Strona Główna </p>
    <p onclick="Onas()"><i class="fi fi-rr-info"></i> O nas </p>
    <p onclick="Dostawa()"><i class="fi fi-rr-credit-card"></i> Dostawa/Płatnośc </p>
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
    <div class="sortowanie_div1" id="pokazsortowanie"><button onclick="Sortujpokaz()"> <span> Sortuj filmy</span> </button></div>
    <div class="sortowanie_div" id="sortowanie">
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

        <input name="formsub" type="submit" value="Sortuj po gatunku">
    </form>
        <form action="index.php" method="post">
            <label for="zakrescen"> Maksymalna cena produktu (PLN): </label>
            <input name="zakrescen" id="zakrescen" value="<?php if(isset($_POST['clickedceny'])){echo $_POST['zakrescen'];} else{echo 500;}?>" type="number" min="0" max="500"  >
            <input type="submit" name="clickedceny" value="Sortuj po cenach">
            <input name="reset" type="submit" value="reset">
        </form>
    </div>
    <div class="content-filmy">
<?php
if(isset($_POST['dodaj_do_koszyka'])){
    if(isset($_SESSION['email'])){
        $tytul = $_POST["tytul"];
        $gatunek = $_POST["gatunek"];
        $cena = $_POST["cena"];
        $mail = $_SESSION['email'];
        $do_koszyka_sql = "INSERT INTO cart (tytul, gatunek, cena, user) VALUES ('$tytul', '$gatunek', '$cena','$mail')";
        $polaczenie->query($do_koszyka_sql);
        header("Location: index.php");
    }else{
        echo "<script> powiadomienie('Musisz być zalogowany'); </script>";
    }


}


?>
<?php

if (isset($_POST['formsub']) OR isset($_POST['clickedceny'])) {

    if(isset($_POST['reset'])){
        $GatunekSet=True;
    }

    if(!isset($_POST['clickedceny'])) {
        $gatunek = $_POST["gatunki"];
        $GatunekSet = false;
        $zapytaniesortowanie = "SELECT title,genre,quantity,price, img_src,id FROM filmy WHERE genre LIKE '$gatunek'";
    }

    if(!isset($_POST['formsub'])){
        $maxcena = $_POST['zakrescen'];
        $GatunekSet = false;
        $zapytaniesortowanie = "SELECT title,genre,quantity,price,img_src,id FROM filmy WHERE price BETWEEN 0 and $maxcena";

    }
    $res1 = mysqli_query($polaczenie, $zapytaniesortowanie);
    while($r=mysqli_fetch_assoc($res1)) {
        echo "
                <div class='movies'>
                    
                    <img src='$r[img_src]' alt='zdjecie produktu'>
                
                  <div class='overlay'>
                    <h3>$r[title] <br>
                    $r[genre] <br> 
                    Ilośc w magazynie: $r[quantity] <br>
                    Cena: $r[price] PLN<br></h3>
                    
                    <form method='POST' action='index.php'> 
                    <input type='hidden' value='$r[title]' name='tytul'> 
                    <input type='hidden' value='$r[genre]' name='gatunek'>
                    <input type='hidden' value='$r[price]' name='cena'>
                 
                    <input class='dodaj_do_koszyka_butt' type='submit' value='Do koszyka!' name='dodaj_do_koszyka'>
                    </form>
                    <form action='filmy/szczegoly.php?id=$r[id]' method='post'>
                    <input type='hidden' value='$r[id]' name='nazwastr'>  
                    <input type='submit' class='szczegolybutt' name='szczegoly' value='szczegoly'>
                    </form>
                    </div>
                 </div>";
    }


}
if($GatunekSet) {
    $res = mysqli_query($polaczenie, "SELECT title, genre, quantity,price, img_src,id FROM filmy");
    while ($r = mysqli_fetch_assoc($res)) {
        echo "
                <div class='movies'>
                    
                    <img src='$r[img_src]' alt='zdjecie produktu'>
                
                  <div class='overlay'>
                    <h3>$r[title] <br>
                    $r[genre] <br> 
                    Ilośc w magazynie: $r[quantity] <br>
                    Cena: $r[price] PLN<br></h3>
                    
                    <form method='POST' action='index.php'> 
                    <input type='hidden' value='$r[title]' name='tytul'> 
                    <input type='hidden' value='$r[genre]' name='gatunek'>
                    <input type='hidden' value='$r[price]' name='cena'>
                 
                    <input class='dodaj_do_koszyka_butt' type='submit' value='Do koszyka!' name='dodaj_do_koszyka'>
                    </form>
                    <form action='filmy/szczegoly.php?id=$r[id]' method='post'>
                    <input type='hidden' value='$r[id]' name='nazwastr'>  
                    <input type='submit' class='szczegolybutt' name='szczegoly' value='szczegoly'>
                    </form>
                    </div>
                 </div>";
    }
}
?>
    </div>
<footer>
        <p> Strona powstała jako projekt programistyczny na warsztaty programistyczne. To nie jest prawdziwy sklep z filmami. Jakub Konkol S24406 &copy;2022 <a href="https://github.com/JakubKonkol"> Github </p>

</footer>

</body>

</html>

