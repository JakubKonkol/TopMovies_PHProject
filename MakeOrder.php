<?php
Class MakeOrder{
    public $sposob_dostawy;
    public $metoda_platnosci;
    public $imie;
    public $nazwisko;
    public $email;
    public $nrtel;
    public $koszt_zamowienia;
    public $ulica;
    public $nrdomu;
    public $miasto;
    public $postcode;

    /**
     * @param $sposob_dostawy
     * @param $metoda_platnosci
     * @param $imie
     * @param $nazwisko
     * @param $email
     * @param $nrtel
     * @param $koszt_zamowienia
     * @param $polaczenie
     */
    public function __construct($sposob_dostawy, $metoda_platnosci, $imie, $nazwisko, $email, $nrtel, $koszt_zamowienia,$ulica,$nrdomu,$miasto,$postcode)
    {
        $this->sposob_dostawy = $sposob_dostawy;
        $this->metoda_platnosci = $metoda_platnosci;
        $this->imie = $imie;
        $this->nazwisko = $nazwisko;
        $this->email = $email;
        $this->nrtel = $nrtel;
        $this->koszt_zamowienia = $koszt_zamowienia;
        $this->ulica = $ulica;
        $this->nrdomu = $nrdomu;
        $this->miasto = $miasto;
        $this->postcode = $postcode;
    }

    public function Zamow(): void{
        require "dbconnect.php";
        $zapytanie = "INSERT INTO orders (sposob_dostawy, metoda_platnosci, imie, nazwisko, email, nr_tel, koszt_zamowienia, data_zamowienia, ulica, nrdomu, miasto, kodpocztowy) VALUES ('$this->sposob_dostawy', '$this->metoda_platnosci', '$this->imie', '$this->nazwisko','$this->email','$this->nrtel','$this->koszt_zamowienia',CURDATE(),'$this->ulica','$this->nrdomu','$this->miasto','$this->postcode')";
        $polaczenie->query($zapytanie);
    }


}