<?php 


for($a = 1; $a <= 10; $a++){
    if($a == 3){
        echo "No. : $a <br />"; // specially for 3
        continue; // here we will skip the loop for number 3 
    }
    echo "Number $a <br />";
}

for($a = 1; $a <= 10; $a++){
    if($a == 3){
        break; // here we will stop the loop for number 3, break is mostly used for switch statement
    }
    echo "Number $a <br />";
}