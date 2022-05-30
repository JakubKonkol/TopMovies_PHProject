<?php
session_start();
if(isset($_SESSION['email'])){

}else{
    header('Location: zaloguj.php');
}



?>
<html lang="pl">
<head>
    <link rel="stylesheet" href="cssy/koszyk.css">
    <script src="scripts/functions.js"> </script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>Koszyk</title>
</head>
<body>
<div class="nawigacyjny">
    <a onclick="Wyloguj()"><i class="fi fi-rr-sign-out-alt"></i> Wyloguj</a>
    <a onclick="Profil()"> <i class="fi fi-rr-user"></i> Profil</a>
    <p onClick="MainPage()"><i class="fi fi-rr-home"></i> Strona Główna </p>
</div>
<div class="bodykoszyka">
<table class="koszyktab">
    <thead>
    <th>tytul</th>
    <th>gatunek</th>
    <th>cena</th>
    <th>usuń</th>
    </thead>
    <tbody>
<?php
$polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
$user = $_SESSION['email']['email'];
$zapytanie = "SELECT tytul, gatunek, cena FROM cart WHERE user = '$user'";
$wynik = mysqli_query($polaczenie,$zapytanie);
$cena_calkowita = 0;
while($r=mysqli_fetch_row($wynik)) {
    $cena_calkowita = $cena_calkowita + intval($r[2]);
    echo
    "
    <form action='koszyk.php' method='post'>
    <tr>
        <td> $r[0] </td>
        <td> $r[1] </td>
        <td> $r[2] </td>
        <td> <input type='submit' value='usuń' name='usun_z_koszyka' class='usunbutt'> </td>
    </tr>   
     <input type='hidden' value='$r[0]' name='tytul'>
     <input type='hidden' value='$r[1]' name='gatunek'>
     <input type='hidden' value='$r[2]' name='cena'>
    </form>
    ";

}
echo "
<tr>
<td colspan='3'> Cena całkowita </td>
<td> $cena_calkowita PLN</td>
</tr>
</tbody>
</table>
"
?>
</div>
<?php
if (isset($_POST['usun_z_koszyka'])){
    $tytul = $_POST['tytul'];
    $gatunek = $_POST['gatunek'];
    $cena = $_POST['cena'];
    $usuwanie_sql = "DELETE from cart WHERE tytul = '$tytul' AND gatunek = '$gatunek' AND cena = '$cena' AND user='$user'";
    $polaczenie->query($usuwanie_sql);
    header('Location: koszyk.php');
}
?>

</body>


</html>
