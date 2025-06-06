<?php 



function testingWithArgument($string){
    $string .= " and something extra.";
}

function testingWithArgumentByReference(&$string){
    $string .= " and something extra.";
}

$str = "This is a string";

testingWithArgument($str);

echo "The value with argument to function : $str";

echo "<br /> ";

testingWithArgumentByReference($str);

echo "The value with argument by reference to function : $str";
