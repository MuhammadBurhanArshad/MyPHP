<?php


$a = 1;

while ($a <= 5) {
    echo "The number is: $a <br />";
    $a++;
}

$b = 5;

while ($b >= 1) {
    echo "The number is: $b <br />";
    $b--;
}

// un-order list with while loop

echo "<ul>";
while ($a <= 5) {
    echo "<li>The number is: $a</li>";
    $a++;
}
echo "</ul>";

//printing numbers from odd numbers from 1 to 10

$num = 1;

while ($num <= 10) {
    if ($num % 2 != 0) {
        echo "Odd number: $num <br />";
    }
    $num++;
}

while ($num <= 10) {
    echo $num;
    $num += 2; // Increment by 2 to get odd numbers
}