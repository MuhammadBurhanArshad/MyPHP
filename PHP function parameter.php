<?php
    function sum($a, $b){
        return $a + $b;
    }
    
    function sum2(){
        echo sum(10,20);
    }

    $sum3 = sum2();
    $sum3();

?>