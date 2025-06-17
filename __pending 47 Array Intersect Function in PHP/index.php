<?php 

$a1 = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];

$a2 = ["a" => "red", "f" => "green", "d" => "purple"];

$newArray = array_intersect($a1, $a2);

print_r($newArray);