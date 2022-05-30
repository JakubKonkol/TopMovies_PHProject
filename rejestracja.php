<?php
session_start();

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
    <form class="form-signin" action="zarejestruj.php" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Załóż konto!</h1>
        <span id="useristnieje"> </span>

        <input type="text"  class="form-control" name="imie" placeholder="Imię" required autofocus>
        <input type="text"  class="form-control" name="nazwisko" placeholder="Nazwisko" required>
        <input type="email"  class="form-control" name="email" placeholder="Adres e-mail" required>
        <input type="password"  id="haslo"  name="haslo" class="form-control"  placeholder="Hasło" required>
        <span id="warning"> </span>
        <input type="password"  id="phaslo" onkeyup="sprawdz_haslo()" class="form-control" name="conf_password" placeholder="Powtórz hasło" required>

        <input type="submit" class="btn btn-lg btn-primary btn-block" id="zarejestrujbutt" name="ClickZarejestruj" value="Utwórz konto!">
    </form>
    <button class="btn btn-danger" onClick="MainPage()"> Strona główna </button> <br>
</div>

</body>

</html>
<?php


if(isset($_SESSION['useristnieje'])){
    echo"<script> 
    document.getElementById('useristnieje').style.color = 'red';
    document.getElementById('useristnieje').innerHTML = 'Taki użytkownik już istnieje!';
</script>";
    unset($_SESSION['useristnieje']);
}

?>