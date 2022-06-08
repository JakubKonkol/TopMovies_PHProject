<?php
include "dbconnect.php";
include "AdminClass.php";
session_start();
$username = $_SESSION['email'];
$isadminquery = "SELECT * FROM users WHERE email = '$username'";
$select = mysqli_query($polaczenie, $isadminquery);
while ($res = mysqli_fetch_assoc($select)){
    if($res['isadmin'] != 1){
        header("Location: notadmin.html ");
    }
}
if(isset($_POST['dodajfilm'])){
    $getid = "SELECT id from filmy ORDER BY id DESC LIMIT 0,1";
    $getidselect = mysqli_query($polaczenie, $getid);
    $getidres = mysqli_fetch_assoc($getidselect);
    $newmovieid = intval($getidres['id']) + 1;

    $imgname = $_FILES['zdj']['name'];
    $extension = pathinfo($imgname, PATHINFO_EXTENSION);
    $nowanazwa = $newmovieid.'.'.$extension;

    $filename = $_FILES['zdj']['tmp_name'];
    move_uploaded_file($filename, 'assets/'.$nowanazwa);
    $tytul = $_POST['tytul'];
    $gatunek = $_POST['gatunek'];
    $cena = $_POST['cena'];
    $opis = $_POST['opis'];
    $ilosc = $_POST['ilosc'];
    $path = "assets/".$nowanazwa;
    $dodaniefilmuquery = "INSERT INTO filmy (id, title,genre,price,description,quantity,img_src) VALUES ('$newmovieid','$tytul', '$gatunek','$cena','$opis','$ilosc','$path')";
    $polaczenie->query($dodaniefilmuquery);
    header("Location: AdminPanel.php?panel=dodajfilm");
}
if(isset($_POST['delopinia'])){
    $idopini = $_POST['idopini'];
    $polaczenie->query("DELETE FROM opinie WHERE id = '$idopini'");
    header("Location:AdminPanel.php?panel=opinie");
}
if(isset($_POST['deluser'])){
    $iduser = $_POST['iduser'];
    $polaczenie->query("DELETE FROM users WHERE id = '$iduser'");
    header("Location:AdminPanel.php?panel=uzytkownicy");
}



?>
<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="scripts/functions.js"></script>
    <link rel="stylesheet" href="cssy/admin.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>Panel administratora</title>
</head>
<body>
<div class="nawigacyjny">

    <a onclick="Wyloguj()"> <i class="fi fi-rr-sign-out-alt"></i> Wyloguj</a>
    <a onclick="Koszyk()"><i class="fi fi-rr-shopping-cart"></i> Koszyk</a>
    <p onClick="MainPage()"> <i class="fi fi-rr-home"></i> Strona Główna </p>
    <span id="alert" onclick="powiadomienie('')">  </span>
</div>
<div class="container">
    <div class="kategorie">

        <a href="AdminPanel.php?panel=uzytkownicy"> <h3> Użytkownicy</h3></a>
        <a href="AdminPanel.php?panel=opinie"> <h3> Opinie </h3></a>
        <a href="AdminPanel.php?panel=dodajfilm"> <h3> Dodaj film </h3></a>
    </div>
    <div class="tools">
        <?php
        $admin = new AdminClass($username);
        if(isset($_GET['panel'])){
            if($_GET['panel'] == "opinie"){
                $admin->wyswietlopinie();
            }
            if($_GET['panel'] == "uzytkownicy"){
                $admin->wyswietluserow();
            }
            if($_GET['panel'] == "dodajfilm"){
                $admin ->dodajfilm();
            }
        }else{
            echo "<h1> wybierz panel </h1>";
        }
        ?>
    </div>


</div>


</body>
</html>
