<?php 

$color = ["a" => "red", "b" => "green", "c" => "red", "d" => "yellow"];

$newArray = array_values($color); // makes index array from associative array

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_unique($color); // just get the unique values from an array

echo "<pre>";
print_r($newArray);
echo "</pre>";