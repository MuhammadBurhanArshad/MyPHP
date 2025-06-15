<?php 

$fruit = ['orange', 'banana', 'apple', 'grapes'];

array_shift($fruit);

// the value will be removed from start
echo "<pre>"; 
print_r($fruit);
echo "</pre>";

array_push($fruit, 'mango'); // we can add more than one value with comma seperated

// the value will be added to start
echo "<pre>"; 
print_r($fruit);
echo "</pre>";
