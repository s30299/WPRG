<?php
interface Volume{
    function increaseVolume();
    function decreaseVolume();


}
interface Playable{
    function play();
    function stop();
}
class MusicPlayer implements Volume, Playable {
    private int $volume;
    private bool $isPlaying;

    function __construct()
    {
        $this->volume=5;
        $this->isPlaying=false;
    }

    function increaseVolume() {
        $this->volume++;
        if($this->volume > 10) {
            $this->volume = 10;
        }
    }
    function decreaseVolume() {
        $this->volume--;
        if($this->volume < 0) {
            $this->volume = 0;
        }

    }
    function play() {
        $this->isPlaying = true;
    }
    function stop() {
        $this->isPlaying = false;
    }
    function GetStatus() {
        if($this->isPlaying) {
            echo "Odtwarzanie włączone<br>";
            return;
        }
        echo "Odtwarzanie wyłaczone<br>";
    }
    function volume() {
        echo $this->volume."<br>";
    }
}

$testPLAY=new MusicPlayer();
$testPLAY->GetStatus();
$testPLAY->play();
$testPLAY->GetStatus();
$testPLAY->volume();
$testPLAY->stop();
$testPLAY->decreaseVolume();
$testPLAY->increaseVolume();
$testPLAY->increaseVolume();
$testPLAY->increaseVolume();
$testPLAY->increaseVolume();
$testPLAY->increaseVolume();
$testPLAY->increaseVolume();
$testPLAY->increaseVolume();
$testPLAY->increaseVolume();
$testPLAY->GetStatus();
$testPLAY->volume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->decreaseVolume();
$testPLAY->GetStatus();
$testPLAY->volume();
$testPLAY->play();
$testPLAY->GetStatus();
$testPLAY->volume();
