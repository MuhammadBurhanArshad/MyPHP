<?php 


$food = ['orange', 'banana', 'apple'];

// counting the array via count()
echo count($food);

echo "<br />";

// counting the array via sizeof()
echo sizeof($food);

echo "<br />";

// for multidimensional array
$food = [
    'fruits' => ['orange', 'banana', 'apple'],
    'veggie' => ['carrot',  'collard', 'pea']
];

// count of multidimensional array
echo  sizeof($food); // will return 2
echo "<br />";
echo  count($food); // will return 2

echo "<br />";

// counting the internal array also in multidimensional array we use second parameter(mode) as 0 or 1, by default is zero
echo  sizeof($food, 1); // will return 8 (2 leys + 6 elements)
echo "<br />";
echo  count($food, 1); // will return 8 (2 leys + 6 elements)

echo "<br />";

// for each element array
echo  sizeof($food['fruits']); // will return 3
echo "<br />";
echo  count($food['fruits']); // will return 3

echo "<br />";

// for loop via length count

$length = count($food['fruits']);

for($i = 0; $i < $length; $i++){
    echo $food['fruits'][$i] . "<br />";
}

// there is another function for count in array

print_r(array_count_values($food)); // it gives the distinct values by their respective count and return the array