<?php
    class NoweAuto{
        protected string $model_auta;
        protected float $cena_Euro;
        protected float $kurs_Euro_PLN;
        function __construct($model_auta,$cena_Euro,$kurs_Euro_PLN){
        $this->model_auta = $model_auta;
        $this->cena_Euro = $cena_Euro;
        $this->kurs_Euro_PLN = $kurs_Euro_PLN;
    }
        public function  ObliczCene(): float
        {
            return $this->cena_Euro*$this->kurs_Euro_PLN;
        }
        public function GetKurs(): float{
            return $this->kurs_Euro_PLN;
        }
        public function GetModel(): string{
            return $this->model_auta;
        }
        public function GetCena(): float{
            return $this->cena_Euro;
        }
    }