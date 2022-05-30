<?php
session_start();
if(isset($_SESSION['email'])){
    echo "<script>window.close();</script>";
    
}

?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="cssy/logowanie_css.css">
    <script src="scripts/functions.js"> </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body class="text-center">
<div class="container" >
    <form class="form-signin" action="zaloguj.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Zaloguj się!</h1>
        <label for="polemail" class="sr-only">Adres e-mail</label>
        <input type="email" id="polemail" class="form-control" name="email" placeholder="Adres e-mail" required autofocus>
        <label for="polehaslo" class="sr-only">Hasło</label>
        <input type="password" id="polehaslo" name="password" class="form-control" placeholder="Hasło" required>
        <input type="submit" class="btn btn-lg btn-primary btn-block" name="ClickZaloguj" value="Zaloguj!">
    </form>
    <button class="btn btn-danger" onClick="MainPage()"> Strona główna </button> <br>
    Nie masz konta? <a href="rejestracja.php">Załóż teraz! </a>
</div>

</body>

</html>