function MainPage(){
    window.location.href="index.php";
}
function Logowanie(){
    window.location.href="logowanie.php";
}
function Koszyk(){
    window.location.href="koszyk.php";
}
function Wyloguj(){
    window.location.href="wyloguj.php";
}
function Profil(){
    window.location.href="profil.php";
}
function Onas(){
    window.location.href="onas.html";
}
function Dostawa(){
    window.location.href="dostawa.html";
}
function Admin(){
    window.location.href="AdminPanel.php";
}
function sprawdz_haslo(){
    if(document.getElementById("haslo").value == document.getElementById("phaslo").value){
        document.getElementById("warning").style.color = 'green';
        document.getElementById("warning").innerHTML = 'Hasła się zgadzają';
        document.getElementById("zarejestrujbutt").disabled =false;
    }else {
        document.getElementById("warning").style.color = 'red';
        document.getElementById("warning").innerHTML = 'Hasła muszą być identyczne!';
        document.getElementById("zarejestrujbutt").disabled =true;
    }
}
function powiadomienie(powiadomienie){
    document.getElementById("alert").style.color = "red";
    document.getElementById("alert").innerHTML = powiadomienie;

}
function user_istnieje(){
    document.getElementById("useristnieje").style.color = 'red';
    document.getElementById("useristnieje").innerHTML = 'Taki użytkownik już istnieje!';


}
function Zmiendane(){
    document.getElementById("noweimie").disabled=false;
    document.getElementById("nowenazwisko").disabled=false;
    document.getElementById("nowyemail").disabled=false;
    document.getElementById("zmiendanebutton").disabled =false;


}
function suwakcen(){
    var x = document.getElementById("zakrescen").value;
    document.getElementById("zakrescenlabel").innerHTML = x;
}
function ZablokujFormularzDostawy(){
    document.getElementById("formularzID").style.visibility = 'hidden';
}