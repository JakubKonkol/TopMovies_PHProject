<?php
$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$idfilmu = $_POST['nazwastr'];
$zapytanie = "SELECT * FROM filmy where id = '$idfilmu'";
$wynik = mysqli_query($polaczenie, $zapytanie);
$film = mysqli_fetch_assoc($wynik);

//print_r($film);

?>


<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
