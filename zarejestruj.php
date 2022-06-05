<?php
session_start();
require "dbconnect.php";
if(isset($_POST['ClickZarejestruj'])){
    $imie = mysqli_real_escape_string($polaczenie, $_POST['imie']);
    $nazwisko = mysqli_real_escape_string($polaczenie, $_POST['nazwisko']);
    $email = mysqli_real_escape_string($polaczenie, $_POST['email']);
    $haslo = mysqli_real_escape_string($polaczenie, md5($_POST['haslo']));

    $select = mysqli_query($polaczenie,"SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($select) > 0){
        $_SESSION['useristnieje'] = 1;
        header("Location: rejestracja.php");
    }else{
        $adduser = "INSERT INTO users (imie,nazwisko,email,password) VALUES ('$imie', '$nazwisko', '$email','$haslo')";
        $polaczenie->query($adduser);
        header('Location: logowanie.php');
    }


}else{
    header('Location: rejestracja.php');
}