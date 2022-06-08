<?php
session_start();
if(!isset($_SESSION['email'])){
    header("Location: logowanie.php");
}
require "dbconnect.php";
$email = $_SESSION['email'];
$wybieranieuserasql = "SELECT id,imie,nazwisko,email,isadmin from users WHERE email= '$email'";
$wynik = mysqli_query($polaczenie, $wybieranieuserasql);
$profil = mysqli_fetch_assoc($wynik);

if(isset($_POST['zmiendane'])){
    $noweimie = $_POST['noweimie'];
    $nowenazwisko = $_POST['nowenazwisko'];
    $nowymail = $_POST['nowyemail'];
    $obecnymail = $_SESSION['email'];

    $zmianasql = " UPDATE users SET imie='$noweimie', nazwisko='$nowenazwisko', email='$nowymail' WHERE email='$obecnymail'";
    $zmianacart = "UPDATE cart SET user = '$nowymail' WHERE user='$obecnymail'";
    $zmianaopinie = "UPDATE opinie SET user_email = '$nowymail' WHERE user_email = '$obecnymail'";
    $zmianaorders = "UPDATE orders SET email = '$nowymail' WHERE email = '$obecnymail'";
    $polaczenie->query($zmianasql);
    $polaczenie->query($zmianacart);
    $polaczenie->query($zmianaopinie);
    $polaczenie->query($zmianaorders);
    header("Location: logowanie.php");

}
if(isset($_POST['usunkonto'])){
    $usun_konto_query = "DELETE FROM users WHERE email='$email'";
    $polaczenie->query($usun_konto_query);
    header("Location: wyloguj.php");
}

?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title> Mój profil </title>
    <link rel="stylesheet" href="cssy/profil.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="scripts/functions.js"></script>

</head>
<body>
<div class="nawigacyjny">

    <a onclick="Wyloguj()"> <i class="fi fi-rr-sign-out-alt"></i> Wyloguj</a>
    <a onclick="Admin()"><i class="fi fi-rr-settings"></i> Admin</a>
    <a onclick="Koszyk()"><i class="fi fi-rr-shopping-cart"></i> Koszyk</a>
    <p onClick="MainPage()"> <i class="fi fi-rr-home"></i> Strona Główna </p>
    <span id="alert" onclick="powiadomienie('')">  </span>
</div>
<div class="bodyprofilu">
<form action="profil.php" method="post" class="formularzzmiany">
        <label for="noweimie" class="sr-only">Imię</label>
    <input type="text" class="form-control" id="noweimie" name="noweimie" disabled value="<?php echo $profil['imie']?>"> <br>
        <label for="nowenazwisko" class="sr-only">Nazwisko</label>
    <input type="text" class="form-control" id="nowenazwisko" name="nowenazwisko" disabled value="<?php echo $profil['nazwisko']?>"> <br>
        <label for="nowyemail" class="sr-only">E-mail:</label>
    <input type="text" class="form-control" id="nowyemail" name="nowyemail" disabled value="<?php echo $profil['email']?>"> <br>
        <button type='button' onclick="Zmiendane()" class="zmiendanebutt"> <i class="fi fi-rr-refresh"></i> Zmień dane</button>
    <input id="zmiendanebutton" type="submit" name="zmiendane" value="Zaaktualizuj dane!" class="zaaktualizujdanebutt" disabled>
    <input type="submit" name="usunkonto" onclick="return confirm('Czy napewno chcesz usunąć konto? Tej operacji nie można cofnąć')" class="usunkontobutt" value="USUŃ KONTO">

</form>
<?php
$zapytaniezamowienia = "SELECT id_zamowienia, sposob_dostawy, metoda_platnosci, koszt_zamowienia, data_zamowienia FROM orders WHERE email='$email'";
$zamowienieselect = mysqli_query($polaczenie, $zapytaniezamowienia);
?>
</div>
<div class="historiazamowien">
    <h2> Historia zamówień</h2>
    <table class="table">
        <thead>
            <tr>
            <th scope = "col" > ID ZAMÓWIENIA </th >
            <th scope = "col" > Metoda Płatności </th >
            <th scope = "col" > Sposób dostawy </th >
            <th scope = "col" > koszt zamówienia </th >
            <th scope = "col" > Data zamówienia </th >
        </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($zamowienieselect)>0){
            while($zamowienie = mysqli_fetch_assoc($zamowienieselect)) {
                echo"
                <tr>
            <th scope = 'row' >$zamowienie[id_zamowienia] </th >
            <td > $zamowienie[metoda_platnosci]</td >
            <td > $zamowienie[sposob_dostawy]</td >
            <td > $zamowienie[koszt_zamowienia]</td >
            <td > $zamowienie[data_zamowienia]</td >
        </tr >
        ";
                }
}
?>
        </tbody>
    </table>
</div>

</body>

</html>