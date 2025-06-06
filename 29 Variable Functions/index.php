<?php  


function wow(){
    echo "Hello";
}

$func = "wow";

//this is the variable function
$func();

//here is another way for variable function  (anonymous function)
$sayHello = function($name){
    echo "Hello $name";
};


$sayHello("Muhammad Burhan");