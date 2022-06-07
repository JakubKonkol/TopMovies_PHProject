<?php
include "dbconnect.php";
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

