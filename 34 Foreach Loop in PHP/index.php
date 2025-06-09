<?php 

$colors = [
    "red",
    "green",
    "blue"
];

foreach($colors as $color) {
    echo "$color <br />";
}

$ages = [
    "burhan" => 21,
    "usman" => 50,
    "sara" => 30,
];

foreach($ages as $key => $age){
    echo "$key's age is $age";
}