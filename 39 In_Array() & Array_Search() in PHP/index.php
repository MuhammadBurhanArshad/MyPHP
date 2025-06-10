<?php 

$food = ['orange', 'banana', 'apple', 'grapes'];

echo in_array('apple', $food); // in array just return 0 or 1


if(in_array('orange', $food)) {
    echo "Found!";
} else {
    echo "Not Found!";
}

echo in_array('orange', $food, true); // the third parameter is for strict mood that will take care of data types also

// we can also use it to find the array from the multidimensional array


echo array_search('apple', $food); // it will return the key or index of found item