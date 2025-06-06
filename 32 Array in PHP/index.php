<?php 

// assigning array with array() method
$colors = array('red', 'green', 'yellow', 'blue');

// assigning array with curly brackets
// $colors = ['red', 'green', 'yellow', 'blue'];

// assigning values index by index
// $colors[0] = 'red';
// $colors[1] = 'green';
// $colors[2] = 'yellow';
// $colors[3] = 'blue';

echo "$colors[0] <br />";
echo "$colors[1] <br />";
echo "$colors[2] <br />";
echo "$colors[3] <br />";


// also another method for print array that is print_r
print_r($colors);

// for formatting in print_r
echo "<pre>"; 
print_r($colors);
echo"</pre>";



// printing value via loop
echo "<ul>";
for($i = 0; $i < 4; $i++){
    echo "<li>$colors[$i]</li>";
}
echo "</ul>";