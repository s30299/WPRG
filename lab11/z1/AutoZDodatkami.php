<?php
class AutoZDodatkami extends NoweAuto {
    protected float $alarm;
    protected float $radio;
    protected float $klimatyzacja;
    function __construct(float $alarm,float $radio,float $klimatyzacja,string $model_auta, float $cena_Euro, float $kurs_Euro_PLN) {
        parent::__construct($model_auta,$cena_Euro,$kurs_Euro_PLN);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function ObliczCene(): float {
        return ($this->klimatyzacja+$this->radio+$this->alarm+$this->cena_Euro)*$this->kurs_Euro_PLN;
    }
}