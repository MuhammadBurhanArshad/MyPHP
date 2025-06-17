<?php

$color = ["red", "green", "blue", "yellow", "brown"];

$newArray = array_keys($color); // return the array keys

echo "<pre>";
print_r($newArray);
echo "</pre>";


// we mostly use this with associative array

$color = [
    "first" => "red",
    "second" => "green",
    "third" => "blue",
    "fourth" => "yellow",
    "fifth" => "brown"
];

$newArray = array_keys($color); // return the array keys

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_key_first($color); // return the array's first key

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_key_first($color); // return the array's last key

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_key_exists('third', $color); // return 1 or 0 for key exist or not, the array_key_exists() is also the same

if($newArray) {
    echo "Key Exists";
} else {
    echo "Key Does not Exists";
}

