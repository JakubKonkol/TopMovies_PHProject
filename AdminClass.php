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
            while ($r=mysqli_fetch_assoc($select)){
                echo "
        <div class='pojedynczaopinia'>
        <table> 
            <tr>
                <th>$r[id_filmu]</th>
            </tr>
            <tr>
                <td>$r[user_email]</td>
            </tr>
            <tr>
                <td>$r[opinia]</td>
            </tr>
            <tr>
                <td><form action='AdminPanel.php?panel=opinie' method='post'> <input type='hidden' value='$r[id]'>  <input name='delopinia' type='submit' value='usun'> </form></td>
            </tr>
        </table>
        </div>
        ";
            }
        }

    }
    public function wyswietluserow():void{
        include "dbconnect.php";
        $query = "SELECT id, imie, nazwisko, email, isadmin FROM users WHERE email != '$this->user'";
        $select = mysqli_query($polaczenie, $query);
        if(mysqli_num_rows($select)<=0){
            echo "Poza tobą nie ma żadnego innego użytkownika";
        }else{
            while ($r=mysqli_fetch_assoc($select)){
                echo "
        <div class='pojedynczaopinia'>
        <table> 
            <tr>
                <th>$r[imie]</th>
            </tr>
            <tr>
                <td>$r[nazwisko]</td>
            </tr>
            <tr>
                <td>$r[email]</td>
            </tr>
            
            <tr>
                <td><form action='AdminPanel.php?panel=uzytkownicy' method='post'> <input type='hidden' value='$r[id]'>  <input name='deluser'type='submit' value='usun'> </form></td>
            </tr>
        </table>
        </div>
        ";
            }
        }
    }
}