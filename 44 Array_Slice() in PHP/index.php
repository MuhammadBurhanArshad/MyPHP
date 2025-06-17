<?php 

$color= ["red", "green", "blue", "yellow", "brown"];

$newArray = array_slice($color, 1, 2); // green and blue, from index 1 to length 2

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_slice($color,-2, 1); // yellow, we can also use minus indexing

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_slice($color,1, 2, true); // green and blue, the fourth parameter is for preserving index from original array

echo "<pre>";
print_r($newArray);
echo "</pre>";


// in numeric key value it replace the keys with 0,1,2... if we dont apply the preserve parameter
