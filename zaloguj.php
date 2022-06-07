<?php
session_start();
require "dbconnect.php";
if(isset($_POST['ClickZaloguj'])){
    $email = mysqli_real_escape_string($polaczenie, $_POST['email']);
    $password = mysqli_real_escape_string($polaczenie, md5($_POST['password']));
    $zapytanie = mysqli_query($polaczenie, "SELECT email FROM users WHERE email='$email' AND password = '$password'");
    if(mysqli_num_rows($zapytanie) > 0){
        $r = mysqli_fetch_assoc($zapytanie);
        $_SESSION['email'] =$r['email'];
        header("Location: koszyk.php");
    }else{
        echo "Nie ma takiego użytkownika!";
    }

}else{
    header('Location: logowanie.php');
}
