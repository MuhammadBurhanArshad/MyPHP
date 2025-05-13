<?php
    $marks = 129;

    if($marks >= 80 && $marks <= 100){
        echo "You have Grade A With $marks%";
    }else if($marks >= 60 && $marks <80){
        echo "You have Grade B With $marks%";
    }else if($marks >= 40 && $marks <60){
        echo "You have Grade C With $marks%";
    }else if($marks < 40){
        echo "You are fail with $marks%";
    }else{
        echo "Please enter the rite value";
    }

    


?>