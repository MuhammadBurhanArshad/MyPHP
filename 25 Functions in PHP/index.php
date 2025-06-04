<?php

function hello() {
    echo "Hello Everyone! <br />";
}

//now we will call this function to execute it
hello();

// we can call the same function for multiple times
hello();
hello();
hello();


function helloWithName($name){
    echo "Hello $name!";
}


helloWithName('Muhammd Burhan');