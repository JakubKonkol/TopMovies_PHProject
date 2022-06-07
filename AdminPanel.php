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
        <a href="AdminPanel.php?panel=opinie"> <h3>Opinie </h3></a>
    </div>
    <div class="tools">
        <?php
        if(isset($_GET['panel'])){
            if($_GET['panel'] == "opinie"){
                $opinie = new AdminClass($username);
                $opinie->wyswietlopinie();
            }
            if($_GET['panel'] == "uzytkownicy"){
                $users = new AdminClass($username);
                $users->wyswietluserow();
            }
        }else{
            echo "<h1> wybierz panel </h1>";
        }
        ?>



    </div>


</div>


</body>
</html>
