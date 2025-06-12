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