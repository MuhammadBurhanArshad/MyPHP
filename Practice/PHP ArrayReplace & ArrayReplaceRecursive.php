<?php
    $fruit = ["Apple", "Grapes", "Orange", "Banana"];
    $veggie = ["Carrot", "Pea"];

    $Combination = array_replace($fruit, $veggie);

    echo "<pre>";
    print_r($Combination);
    echo "</pre>";

    $fruit = ["a" => ["Apple"], "b" => ["Grapes"], "c" => ["Orange"], "d" => ["Banana"]];
    $veggie = [["Carrot"], ["Pea"]];

    $Combination = array_replace_recursive($fruit, $veggie);

    echo "<pre>";
    print_r($Combination);
    echo "</pre>";


    
?>