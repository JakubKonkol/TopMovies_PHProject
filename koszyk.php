<?php
session_start();
require "dbconnect.php";
if(!isset($_SESSION['email'])){
    header('Location: zaloguj.php');
}
$user = $_SESSION['email'];

if (isset($_POST['usun_z_koszyka'])){
    $tytul = $_POST['tytul'];
    $gatunek = $_POST['gatunek'];
    $cena = $_POST['cena'];
    $usuwanie_sql = "DELETE from cart WHERE tytul = '$tytul' AND gatunek = '$gatunek' AND cena = '$cena' AND user='$user'";
    $polaczenie->query($usuwanie_sql);
    header('Location: koszyk.php');
}
if(isset($_POST['update_cart_ilosc'])){
    $ilosc = $_POST['ilosc_w_koszyku'];
    $tytul = $_POST['tytul'];
    mysqli_query($polaczenie, "UPDATE cart SET ilosc = $ilosc WHERE tytul = '$tytul' AND user = '$user'");
    header('Location: koszyk.php');
}
?>
<html lang="pl">
<head>
    <link rel="stylesheet" href="cssy/koszyk.css">
    <script src="scripts/functions.js"> </script>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <script src="https://kit.fontawesome.com/a9c3b869ed.js" crossorigin="anonymous"></script>
    <title>Koszyk</title>
</head>
<body>
<div class="nawigacyjny">
    <a onclick="Wyloguj()"><i class="fi fi-rr-sign-out-alt"></i> Wyloguj</a>
    <a onclick="Profil()"> <i class="fi fi-rr-user"></i> Profil</a>
    <p onClick="MainPage()"><i class="fi fi-rr-home"></i> Strona Główna </p>
</div>
<div class="bodykoszyka">
    <h2> Koszyk dla <?php echo $user; ?> </h2>
<table class="koszyktab">
    <thead>
    <th>tytul</th>
    <th>gatunek</th>
    <th>cena</th>
    <th>ilosc</th>
    <th>usuń</th>
    </thead>
    <tbody>
<?php

$zapytanie = "SELECT tytul, gatunek, cena, ilosc FROM cart WHERE user = '$user'";
$wynik = mysqli_query($polaczenie,$zapytanie);
$cena_calkowita = 0;


while($r=mysqli_fetch_row($wynik)) {
    $cena_calkowita = $cena_calkowita + (intval($r[2])*intval($r[3]));
    echo
    "
    <form action='koszyk.php' method='post'>
    <tr>
        <td> $r[0] </td>
        <td> $r[1] </td>
        <td> $r[2] </td>
        <td> 
        <input style='width: 40px'type='number' min='1' max='99' name='ilosc_w_koszyku' value='$r[3]'>
        <input type='submit' value='zmień' name='update_cart_ilosc' class='editbutt'>
        </td>
        <td> <input type='submit' value='usuń' name='usun_z_koszyka' class='usunbutt'> </td>
    </tr>   
     <input type='hidden' value='$r[0]' name='tytul'>
     <input type='hidden' value='$r[1]' name='gatunek'>
     <input type='hidden' value='$r[2]' name='cena'>
     <input type='hidden' value='$r[3]' name='ilosc'>
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
";
?>
</div>
<div class="dostawaform" id="formularzID">
    <h2> Formularz dostawy </h2>
    <form action="koszyk.php" method="post">
        <div class="sposobdostawy">
            <h3> Sposób dostawy</h3>
            <table>
                <tr>
                    <td><input type="radio" name="sposobdostawy" required value="kurier"></td>
                    <td><span><i class="fi fi-rr-truck-side"></i> Kurier</span></td>
                </tr>
                <tr>
                   <th> <input type="radio" name="sposobdostawy" required value="paczkomat">  </th>
                   <th> <span><i class="fi fi-rr-box-alt"></i> Paczkomat</span> </th>
                </tr>
                <tr>
                    <th><input type="radio" name="sposobdostawy" required value="osobisty"></th>
                    <th> <span><i class="fi fi-rr-package"></i> Odbiór osobisty</span></th>
                </tr>

            </table>
        </div>
        <div class="sposobdostawy">
            <h3> Metoda Płatności</h3>
            <table>
                <tr>
                    <td><input type="radio" name="metodaplatnosc" required value="karta"></td>
                    <td><span><i class="fi fi-rr-credit-card"></i> Karta Visa/Mastercard</span></td>
                </tr>
                <tr>
                    <th> <input type="radio" name="metodaplatnosc" required value="paypal">  </th>
                    <th> <span><i class="fa-brands fa-paypal"></i> PayPal</span> </th>
                </tr>
                <tr>
                    <th><input type="radio" name="metodaplatnosc" required value="applepay"></th>
                    <th> <span><i class="fab fa-apple-pay"></i> Apple Pay</span></th>
                </tr>

            </table>
        </div>
        <div class="resztadostawy">
            <span>Imie:</span><input type="text" required name="imie">  <br>
            <span>Nazwisko:</span><input type="text" required name="nazwisko"> <br>
            <span>Adres e-mail:</span><input type="text" required name="email" value="<?php echo $user;  ?>" disabled> <br>
            <span>numer telefonu:</span> <input type="text" required name="telefon"> <br>
        </div>
        <div class="resztadostawy">
            <span>Ulica:</span><input type="text" required name="ulica">  <br>
            <span>Numer domu/mieszkanie:</span><input type="text" required name="nrdomu"> <br>
            <span>Miasto:</span><input type="text" required name="miasto"> <br>
            <span>Kod pocztowy:</span> <input type="text" required name="kodpocztowy"> <br>
        </div>
        <input type="hidden" name="calkowitacena" value="<?php echo $cena_calkowita;?>">
        <input id="formularzdostawy" name="zlozzamowienie" type="submit" value="Złóż zamówienie!">
    </form>



</div>
<?php

if(mysqli_num_rows($wynik) <= 0){
    echo  "<script> ZablokujFormularzDostawy(); </script>";
}
if(isset($_POST['zlozzamowienie'])){
    include "MakeOrder.php";
    $email = $user;
    $sposob_dostawy = mysqli_real_escape_string($polaczenie,$_POST['sposobdostawy']);
    $metoda_platnosci = mysqli_real_escape_string($polaczenie, $_POST['metodaplatnosc']);
    $danepoprawne = True;
    if(preg_match('/^[a-z]$/', $_POST['imie'])){
        $imie = mysqli_real_escape_string($polaczenie, $_POST['imie']);
        $danepoprawne = True;
    }else{
        $danepoprawne = False;
    }
    if(preg_match('/^[a-z]$/', $_POST['nazwisko'])){
        $nazwisko = mysqli_real_escape_string($polaczenie,$_POST['nazwisko']);
        $danepoprawne = True;
    }else{
        $danepoprawne = False;
    }
    if(preg_match('/^[0-9]{9}$/', $_POST['telefon'])){
        $nrtel = mysqli_real_escape_string($polaczenie, $_POST['telefon']);
        $danepoprawne = True;
    }else{
        $danepoprawne = False;
    }
    $koszt_zamowienia = mysqli_real_escape_string($polaczenie, $_POST['calkowitacena']);
    if(preg_match('/^[a-z]$/', $_POST['ulica'])){
        $danepoprawne = True;
        $ulica = mysqli_real_escape_string($polaczenie, $_POST['ulica']);
    }else{
        $danepoprawne = False;
    }
    if(preg_match('/^[0-9]$/', $_POST['nrdomu'])){
        $danepoprawne = True;
        $nrdomu = mysqli_real_escape_string($polaczenie, $_POST['nrdomu']);
    }else{
        $danepoprawne = False;
    }
    if(preg_match('/^[a-z]$/', $_POST['miasto'])){
        $danepoprawne = True;
        $miasto = mysqli_real_escape_string($polaczenie, $_POST['miasto']);
    }else{
        $danepoprawne = False;
    }
    if(preg_match('/^[0-9]{5}$/', $_POST['kodpocztowy'])){
        $danepoprawne = True;
        $postcode = mysqli_real_escape_string($polaczenie, $_POST['kodpocztowy']);
    }else{
        $danepoprawne = False;
    }

    if($danepoprawne){
        $makeorder = new MakeOrder($sposob_dostawy, $metoda_platnosci, $imie, $nazwisko, $email, $nrtel, $koszt_zamowienia,$ulica,$nrdomu,$miasto,$postcode);
        $makeorder->Zamow();
    }else if($danepoprawne == False){
        echo "podaj poprawne dane";
    }


}



?>

</body>


</html>
