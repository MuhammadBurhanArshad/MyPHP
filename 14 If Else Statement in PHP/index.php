<?php

$x = 15;

if($x > 10) {
    echo "x is greater than 10";
} elseif($x == 10) {
    echo "x is equal to 10";
} else {
    echo "x is less than 10";
}


$name = 'Burhan';
$gender = "male";

if($gender == "male") {
    echo "Hello Mr. $name";
} else {
    echo "Hello Ms. $name";
}