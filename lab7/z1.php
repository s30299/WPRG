<html>
<head>
    <meta charset="utf-8" />
    <title>z1</title>
    <style>
        .blue{
            color: blue;
        }
    </style>
</head>
<body>
<?php
$tab = array("Italy"=>"Rome",
    "Luxembourg"=>"Luxembourg",
    "Belgium"=> "Brussels",
    "Denmark"=>"Copenhagen",
    "Finland"=>"Helsinki",
    "France" => "Paris",
    "Slovakia"=>"Bratislava",
    "Slovenia"=>"Ljubljana",
    "Germany" => "Berlin",
    "Greece" => "Athens",
    "Ireland"=>"Dublin",
    "Netherlands"=>"Amsterdam",
    "Portugal"=>"Lisbon",
    "Spain"=>"Madrid",
    "Sweden"=>"Stockholm",
    "United Kingdom"=>"London",
    "Cyprus"=>"Nicosia",
    "Lithuania"=>"Vilnius",
    "Czech Republic"=>"Prague",
    "Estonia"=>"Tallin",
    "Hungary"=>"Budapest",
    "Latvia"=>"Riga","Malta"=>"Valetta",
    "Austria" => "Vienna",
    "Poland"=>"Warsaw");

foreach ($tab as $klucz => $dana)
{
    echo "The capital <span class='blue'>of</span> " .$klucz. " <span class='blue'>is</span> ".$dana. "<br>";
}
?>
</body>
</html>