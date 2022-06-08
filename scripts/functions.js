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
function mess(){
    document.getElementById("mess").remove();
}
function sprawdz_haslo(){
    if(document.getElementById("haslo").value === document.getElementById("phaslo").value){
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
function ZablokujFormularzDostawy(){
    document.getElementById("formularzID").style.visibility = 'hidden';
}
function Sortujpokaz(){
    document.getElementById("sortowanie").style.visibility = "visible";
    document.getElementById("pokazsortowanie").parentNode.removeChild(document.getElementById("pokazsortowanie"));
}
function togglemenu(){
    var koszyk = document.getElementById("koszyk");
    var profil = document.getElementById("profil");
    var main = document.getElementById("main");
    var onas = document.getElementById("onas");
    var dostawa = document.getElementById("dostawa");
    var nawigacyjny = document.getElementById("nawigacyjny");
    if(koszyk.style.display=="none" && profil.style.display=="none" && main.style.display=="none" && onas.style.display=="none" &&  dostawa.style.display=="none"){
        koszyk.style.display="block";
        profil.style.display="block";
        main.style.display="block";
        onas.style.display="block";
        dostawa.style.display="block";

    }else{
        koszyk.style.display="none";
        profil.style.display="none";
        main.style.display="none";
        onas.style.display="none";
        dostawa.style.display="none";
    }
}