<?php 

$fruit = ['orange', 'banana', 'apple', 'grapes'];

$vaggie = ['carrot', 'pea'];

$newArray = array_replace($fruit, $vaggie); // it will return the another array not change the existing array

echo "<pre>";
print_r($newArray); // [carrot, pea, apple, grapes], we can also use more then 2 arrays, it will replace according to index in indexed array
echo "</pre>";

// for associative array it will replace only by the key other wise it will return merge


// Array Replace Recursive

$array1 = [ 
    "a" => ["red"],
    "b" => ["green", "pink"],
];

$array2 = [
    "a" => ["yellow"],
    "b" => ["black"],
];

// for multidimensional array we use array_replace_recursive 

$anotherNewArray = array_replace_recursive($array1, $array2);

echo "<pre>";
print_r($anotherNewArray);
echo "</pre>";
