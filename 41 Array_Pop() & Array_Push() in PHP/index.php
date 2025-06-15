<?php 

$fruit = ['orange', 'banana', 'apple', 'grapes'];

array_pop($fruit);

// the value will be removed from last
echo "<pre>"; 
print_r($fruit);
echo "</pre>";

array_push($fruit, 'mango'); // we can add more than one value with comma seperated

// the value will be added to last
echo "<pre>"; 
print_r($fruit);
echo "</pre>";
