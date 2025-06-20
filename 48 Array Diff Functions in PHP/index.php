<?php 

$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];

$a2 = ["a" => "red", "f" => "green", "d" => "purple"];


$newArray = array_diff($a1, $a2); // compare the values from array one that is not is array two or more

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_diff_key($a1, $a2); // compare the keys from array one that is not is array two or more

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_diff_assoc($a1, $a2); // compare the keys and values from array one that is not is array two or more

echo "<pre>";
print_r($newArray);
echo "</pre>";


function compare($a, $b) {
    if($a === $b){
        return 0;
    }
    return ($a > $b) ? 1 : -1;
}


$newArray = array_diff_uassoc($a1, $a2, "compare"); // compare the keys and values from array one that is not is array two or more using the user define function

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_udiff_assoc($a1, $a2, "compare"); // work as like array_diff_uassoc

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_diff_ukey($a1, $a2, "compare"); // compare the keys from array one that is not is array two or more using the user define function

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_udiff($a1, $a2, "compare"); // compare the values from array one that is not is array two or more using the user define function

echo "<pre>";
print_r($newArray);
echo "</pre>";


$newArray = array_udiff_uassoc($a1, $a2, "compare", "compare"); // compare the keys and values from array one that is not is array two or more using the user define function

echo "<pre>";
print_r($newArray);
echo "</pre>";

