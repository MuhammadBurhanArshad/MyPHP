<?php
    $boys = ["Ali", "Rehman", "Farooq",  "Amir", "Farhan"];

    $value = in_array("Ali", $boys);

    $result = ($value == 1)? "Sign In":"Sign Up";
    echo $result . "<br>";

    $boys = ["Ali", "Rehman", "Farooq",  "Amir", "Farhan"];

    $value = array_search("Ali", $boys);

    $result = ($value == 1)? "Sign In":"Sign Up";
    echo $result;
?>