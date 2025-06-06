<?php 


function hello(String $first_name = "First", String $last_name = "Last") {
    return "Hello $first_name $last_name! <br />";
}

echo hello("Muhammad Burhan", "Arshad");


function getSum(int $first_number = 0, int $second_number = 0) {
    return $first_number + $second_number;
}

echo "The sum is ".getSum(4,7);