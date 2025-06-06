<?php 


$y = 20;

function test(){
    $x = 10;
    echo "the variable x inside the function $x";
    
    // it will give an error
    // echo "the variable y inside the function $y";
    
    echo "<br />";
    
    //for using the global variable locally we use global keyword
    global $y; // we can also give more than one variable with commas
    echo "the global variable y inside the function $y";

}

test();

//it will give an error
// echo "the variable x inside the function";