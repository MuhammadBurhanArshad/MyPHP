<?php 

// Recursive display function: prints numbers from 1 to 5
function display($number){
    if($number <= 5) {
        echo "$number <br />";
        display($number + 1); // or use ++$number
    }
}

// Calling display function
display(1);

// Recursive factorial function
function factorial($number) {
    if($number == 0) {
        return 1;
    } else {
        return ($number * factorial($number - 1));
    }
}

// Display factorial result
echo "Factorial of 5 is: " . factorial(5);
