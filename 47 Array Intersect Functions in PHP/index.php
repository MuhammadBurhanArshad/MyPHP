<?php 

$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];

$a2 = ["a" => "red", "f" => "green", "d" => "purple"];

$newArray = array_intersect($a1, $a2);


echo "<pre>";
print_r($newArray); // it will match the value by case sensitive and return the intersected array, i match the value from all the given array (two or more)
echo "</pre>";


$newArray = array_intersect_key($a1, $a2);

echo "<pre>";
print_r($newArray); // it will match the key by case sensitive and return the intersected array and the matched key value should be from first array, i match the value from all the given array (two or more)
echo "</pre>";


$newArray = array_intersect_assoc($a1, $a2);

echo "<pre>";
print_r($newArray); // it will match the key and value both by case sensitive and return the intersected array, i match the value from all the given array (two or more)
echo "</pre>";


function compare($a, $b){
    if($a === $b){
        return 0; // zero if $a and $b matched
    }

    return ($a > $b) ? 1 : -1; // 1 when $a is greater than $b, -1 when $a is lesser than the $b
}

$newArray = array_intersect_uassoc($a1, $a2, "compare");

echo "<pre>";
print_r($newArray); // it will match the key and value both by the uer defined function
echo "</pre>";


$newArray = array_uintersect_assoc($a1, $a2, "compare");

echo "<pre>";
print_r($newArray); // work as like array_intersect_uassoc()
echo "</pre>";


$newArray = array_intersect_ukey($a1, $a2, "compare");

echo "<pre>";
print_r($newArray); // also uses the use defined function to compare the keys of arrays
echo "</pre>";


$newArray = array_uintersect($a1, $a2, "compare");

echo "<pre>";
print_r($newArray); // also uses the use defined function to compare the values of arrays
echo "</pre>";


$newArray = array_uintersect_uassoc($a1, $a2, "compare", "compare"); // the first function is for comparing values and the second one is for compare keys 

echo "<pre>";
print_r($newArray); // also uses the use defined function to compare the values of arrays
echo "</pre>";

