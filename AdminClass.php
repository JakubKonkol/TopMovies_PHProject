<?php
class AdminClass{
    public $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }


    public function wyswietlopinie():void{
        include "dbconnect.php";
        $query = "SELECT id, id_filmu, user_email, opinia FROM opinie";
        $select = mysqli_query($polaczenie, $query);
        if(mysqli_num_rows($select)<=0){
            echo "Nikt nie dodal zadnej opini";
        }else{
            echo"<div class='tabela'> 
                <table>
                <thead>
                            <tr>
                            <th scope = 'col' > ID FILMU </th >
                            <th scope = 'col' > użytkownik </th >
                            <th scope = 'col' > Treść opini </th >
                            <th scope = 'col' > Usuń opinie </th >
                        </tr>
                        </thead>
                        <tbody>
                ";
            while ($r=mysqli_fetch_assoc($select)){
                $opinia = htmlspecialchars($r['opinia']);
                echo "
            <tr>
                <td>$r[id_filmu]</td>
                <td>$r[user_email]</td>
                <td>$opinia</td>
                <td><form action='AdminPanel.php?panel=opinie' method='post'> <input type='hidden' name='idopini' value='$r[id]'>  <input name='delopinia' type='submit' value='usun'> </form></td>
            </tr>
        ";
            }
            echo "</tbody> </table> </div>";
        }

    }
    public function wyswietluserow():void{
        include "dbconnect.php";
        $query = "SELECT id, imie, nazwisko, email, isadmin FROM users WHERE email != '$this->user'";
        $select = mysqli_query($polaczenie, $query);
        if(mysqli_num_rows($select)<=0){
            echo "Poza tobą nie ma żadnego innego użytkownika";
        }else{
            echo"<div class='tabela'> 
                <table>
                <thead>
                            <tr>
                            <th scope = 'col' > imie </th >
                            <th scope = 'col' > nazwisko </th >
                            <th scope = 'col' > email </th >
                            <th scope = 'col' > Usuń konto </th >
                        </tr>
                        </thead>
                        <tbody>
                ";
            while ($r=mysqli_fetch_assoc($select)){
                echo "
            <tr>
                <td>$r[imie]</td>  
                <td>$r[nazwisko]</td>
                <td>$r[email]</td>
                <td><form action='AdminPanel.php?panel=uzytkownicy' method='post'> <input type='hidden' name='iduser' value='$r[id]'>  <input name='deluser'type='submit' value='usun'> </form></td>
            </tr>
        ";
            } echo "</tbody> </table> </div>";
        }
    }
    public function dodajfilm():void{
        include "dbconnect.php";
        echo "
        <form id='dodajfilm' action='AdminPanel.php?panel=dodajfilm' method='post' enctype='multipart/form-data'> 
       Tytul: <input type='text' name='tytul'> <br>
        Gatunek: <select id='gatunki' name='gatunek'> <br>
            <option value='Drama'>Drama</option> 
            <option value='Crime/Drama'>Crime/Drama</option>
            <option value='Action/Sci-Fi'>Action/Sci-Fi</option>
            <option value='Biography'>Biography</option>
            <option value='Horror'>Horror</option>
            <option value='Comedy'>Comedy</option>
            <option value='Thriller'>Thriller</option>
        </select> <br>
        Cena: <input type='number' name='cena'> <br>
         Opis: <textarea maxlength='200' name='opis' rows='5' cols='50' form='dodajfilm'> </textarea> <br>
        Ilosc w magazynie: <input type='number' name='ilosc'> <br>
        Zdjecie: <input type='file' name='zdj' accept='image/png, image/jpeg'>  <br>
        <input type='submit' name='dodajfilm' value='Dodaj film!'> 
        </form>
        ";
    }

}