<?php
session_start();
if(isset($_SESSION['email'])){
    echo "Jestes w koszyku!!!!";

    echo
    "
    <form method='post' action='wyloguj.php'>
    <input type='submit' value='Wyloguj się!'> 
    </form>
    ";


}else{
    header('Location: zaloguj.php');
}



?>