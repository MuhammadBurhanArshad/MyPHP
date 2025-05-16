<?php
    define("test", 50);

    //define("test", 10); It could be assign again because it is constant
    
    echo test;
    
    define("_test2", 50);
    
    //define("test", 10); It could be assign again because it is constant
    
    echo _test2;

    define('Pi', 3.22);
    define('R', 3);

    echo 2 * Pi * R;


    define("case_sensitive", 'testing', true); // deprecated since PHP 7.3

?>