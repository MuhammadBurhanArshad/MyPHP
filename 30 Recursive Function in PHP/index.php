<?php 


// this function it recursive function it will call it self by updated value each time
function display($number){
    if($number <= 5) {
        echo "$number <br />";
        display($number++);
    }
}

// calling display function with initial value 
display(1);

