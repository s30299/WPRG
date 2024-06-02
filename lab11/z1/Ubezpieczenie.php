<?php
class Ubezpieczenie extends AutoZDodatkami {
    protected float $procentowa_wartosc_ubezpieczenia;
    protected int $liczba_lat_posadania_samochodu;
    function __construct(float $procentowa_wartosc_ubezpieczenia,int $liczba_lat_posadania_samochodu,AutoZDodatkami $auto) {
        parent::__construct($auto->alarm,$auto->radio,$auto->klimatyzacja,$auto->model_auta,$auto->cena_Euro,$auto->kurs_Euro_PLN);
        $this->procentowa_wartosc_ubezpieczenia=$procentowa_wartosc_ubezpieczenia;
        $this->liczba_lat_posadania_samochodu=$liczba_lat_posadania_samochodu;
    }
    public function ObliczCene():float {
        return $this->procentowa_wartosc_ubezpieczenia*(parent::ObliczCene()*((100-$this->liczba_lat_posadania_samochodu)/100));
    }
}