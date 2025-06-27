<?php 

include "first.php";
include "second.php";

$obj1 = new first\Product(); // first namespace class
$obj2 = new second\Product(); // second namespace class 

$obj1->wow();
$obj2->wow();