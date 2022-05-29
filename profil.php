<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: logowanie.php");
}
$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$email = $_SESSION['email']['email'];
$wybieranieuserasql = "SELECT imie,nazwisko,email,isadmin from users WHERE email= '$email'";
$wynik = mysqli_query($polaczenie, $wybieranieuserasql);
$profil = mysqli_fetch_assoc($wynik);

?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title> Mój profil </title>
    <link rel="stylesheet" href="profil.css">
    <script src="functions.js"></script>
</head>
<body>
<div class="nawigacyjny">
    <a onclick="Wyloguj()"> Wyloguj</a>
    <a onclick="Koszyk()"> Koszyk</a>
    <p onClick="MainPage()"> Strona Główna </p>
    <span id="alert" onclick="powiadomienie('')">  </span>
</div>
<div class="bodyprofilu">
<form>
<input type="text" disabled value="<?php echo $profil['imie']?>"> <br>
<input type="text" disabled value="<?php echo $profil['nazwisko']?>"> <br>
<input type="text" disabled value="<?php echo $profil['email']?>"> <br>

</form>
</div>
</body>

</html>