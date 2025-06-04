<?php 


function sum(int $a, int $b): void {
    echo $a + $b;
}

sum(2,3); // will return 5

echo '<br/>';

sum(5,9); // will return 14

echo '<br/>';

function hello(String $name): void {
    echo "Hello $name";
}

hello("Muhammad Burhan");

echo '<br/>';

// function with default value

function helloFullName(String $first_name = "first", String $last_name = 'last'): void {
    echo "Hello $first_name $last_name";
}

echo '<br/>';

// call with params
helloFullName("Muhammad", "Burhan");

echo '<br/>';

// call with out params
helloFullName();