<?php
session_start();

require "../dbconnect.php";
$idfilmu = $_GET['id'];
$zapytanie = "SELECT * FROM filmy where id = '$idfilmu'";
$wynik = mysqli_query($polaczenie, $zapytanie);
$film = mysqli_fetch_assoc($wynik);

if(isset($_POST['dodanaopinia']) && $_POST['random'] == $_SESSION['rand']){
    if(isset($_SESSION['email'])){
        include "Dodawanie_opini.php";
        $email = $_SESSION['email'];
        $opinia =mysqli_real_escape_string($polaczenie, $_POST['opinia']);
        $opinia = new Dodawanie_opini($email, $opinia, $idfilmu);
        $opinia->dodajopinie();
        unset($_POST['dodanaopinia']);
    }else{
        echo "<script src='navbar.js'> powiadomienie('Musisz być zalogowany'); </script>";
    }
}

?>


<!doctype html>
<html lang="pl">
<head>
    <link rel="stylesheet" href="../cssy/szczegoly.css">
    <script src="navbar.js"> </script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $film['title'];?></title>
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

<div class="container">
    <div class="moviecontainer">
        <div class="photo">
            <img src="../<?php echo $film['img_src'];?>" width='200px' height='270px' alt='zdjecie produktu'>
        </div>
        <div class="opis">
            <h2> <?php echo $film['title'];?> </h2>
            <h3> <?php echo $film['genre'];?> </h3>
            <h3> <?php echo $film['price'];?> PLN </h3>
            <h4> <?php echo $film['description'];?> </h4>

        </div>

    </div>
    <div class="dodajopinie">
        <form action="<?php echo "szczegoly.php?id=$idfilmu";?>" method="post" name="dodawanieopini" id="dodawanieopini">
            <?php
            $rand=rand();
            $_SESSION['rand']=$rand; ?>
            <input type="hidden" name="random" value="<?php echo $rand;?>">
            <textarea maxlength="200" name="opinia" rows="5" cols="50" form="dodawanieopini"> </textarea>  <br>
            <input type="submit" name="dodanaopinia" value="DODAJ OPINIE">
        </form>

    </div>

    <div class="opinie" name="opinieuzytkownikow">
        <h2> Opinie użytkowników </h2>
    <?php
    $select_opini = "SELECT user_email, opinia FROM opinie WHERE id_filmu='$idfilmu'";
    $wynik_select = mysqli_query($polaczenie, $select_opini);
    if(mysqli_num_rows($wynik_select)<=0){
        echo "<h3> Nie ma opini dla tego produktu </h3>";
    }else{

    while($r=mysqli_fetch_assoc($wynik_select)) {
        $opiniafiltered = htmlspecialchars($r['opinia']);
        echo "
        <div class='pojedynczaopinia'>
        <table> 
            <tr>
                <th>$r[user_email]</th>
            </tr>
            <tr>
                <td> $opiniafiltered </td>
            </tr>
        </table>
        </div>
        ";

    }

    }

    ?>


    </div>
</div>
</body>
</html>
