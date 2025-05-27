<?php

$a = 3;
$b = 5;


if ($a > $b) {
    echo "a is greater than b";
} elseif ($a < $b) {
    echo "a is less than b";
} else if ($a == $b) {
    echo "a and b are equal";
} else if($a === $b) {
    echo "a is identical to b";
} elseif ($a != $b) {
    echo "a is not equal to b";
} elseif ($a !== $b) {
    echo "a is not identical to b";
} else {
    echo "a is equal to b";
}

echo "after if statement";
// This code compares two variables, $a and $b, and prints a message based on their comparison.