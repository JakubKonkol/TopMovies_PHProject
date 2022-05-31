<?php
class Dodawanie_opini{
    public $email;
    public $opinia;
    public $idfilmu;

    /**
     * @param $email
     * @param $opinia
     * @param $idfilmu
     */
    public function __construct($email, $opinia, $idfilmu)
    {
        $this->email = $email;
        $this->opinia = $opinia;
        $this->idfilmu = $idfilmu;
    }

    public function dodajopinie(): void
    {
        $polaczenie = mysqli_connect("127.0.0.1", "root", "", "TopMovies");
        $zapytanie = "INSERT INTO opinie (user_email, opinia, id_filmu) VALUES ('$this->email','$this->opinia','$this->idfilmu' )";
        $polaczenie->query($zapytanie);
    }


}