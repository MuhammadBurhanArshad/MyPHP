<?php 

$age = array(
    "burhan" => 21,
    "usman" => 50,
    "sara" => 30,
);

// anohter way to assign array

// $age = [
//     "burhan" => 21,
//     "usman" => 50,
//     "sara" => 30,
// ];

echo $age['burhan'] . "<br />";
echo $age['usman'] . "<br />";
echo $age['sara'] . "<br />";

echo "<pre>";
print_r($age);
echo "</pre>";

echo "<pre>";
var_dump($age);
echo "</pre>";


// for reassigning value

$age["sara"] = 33;


// we can also store multiple data types