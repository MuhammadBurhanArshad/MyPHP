<?php

$array = [
    [
        'id' => 2201,
        'first_name' => 'Ali',
        'last_name' => 'Raza'
    ],
    [
        'id' => 2202,
        'first_name' => 'Salman',
        'last_name' => 'Khan'
    ],
    [
        'id' => 2203,
        'first_name' => 'Ahmed',
        'last_name' => 'Hassan'
    ],
];


$newArray = array_column($array, 'first_name', 'id'); // create the another array for the first name only, if we want to create the associative array so we can give the third parameter for key

echo "<pre>";
print_r($newArray);
echo "</pre>";


$colors = ["red", "green", "blue", "orange", "brown"];


$newArray = array_chunk($colors, 2); // it will create the indexed array to associative array by dividing the array into small chunks for the given length that is in second parameter, but if we provide it associative array so it will change the keys into indexes for preserving key we pass third parameter for preserved key or not that is boolean (by default false)