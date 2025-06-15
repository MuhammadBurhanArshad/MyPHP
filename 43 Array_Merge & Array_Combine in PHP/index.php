<?php 

$fruit = ['orange', 'banana', ' apple'];

$veggie = ['carrot', 'pea'];

$color = ['red', 'green', 'blue'];

$newArray = array_merge($fruit, $veggie, $color); // it will merge all three arrays

echo "<pre>";
print_r($newArray);
echo "</pre>";


$fruit = ['a' => 'orange', 'b' => 'banana', 'c' => 'apple'];

$veggie = ['b' => 'carrot', 'e' => 'pea', 55, 60];

$newArray = array_merge($fruit, $veggie); // it will replace over the same keys preferring to second array's key value

// but if we want to give preferring to first array's key we use the plus athematic operation
$newArray = $fruit + $veggie;

echo "<pre>";
print_r($newArray);
echo "</pre>";

// the array merge recursive make the array of the same key elements in array
$newArray = array_merge_recursive($fruit, $veggie); // it will replace over the same keys preferring to second array's key value


echo "<pre>";
print_r($newArray);
echo "</pre>";


$name = ['burhan', 'salman', 'usman'];

$age = [20, 22, 34];

// array combine will make the first array as key and the second one is as value
$newArray = array_combine($name, $age);


echo "<pre>";
print_r($newArray);
echo "</pre>";
