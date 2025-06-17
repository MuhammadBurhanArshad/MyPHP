<?php 

$color= ["red", "green", "blue", "yellow", "brown"];

array_splice($color, 1); // it will delete the all values after index 1, also it will make changes in existing array


$color= ["red", "green", "blue", "yellow", "brown"];

array_splice($color, 2, 1); // it will delete the one value after index 2, also it will make changes in existing array


$color= ["red", "green", "blue", "yellow", "brown"];

$fruit = ["Orange", "red"];

array_splice($color, 0, 2, $fruit); // it will replace the first 2 values with the fruit array


$color= ["red", "green", "blue", "yellow", "brown"];

$fruit = ["Orange", "red"];

array_splice($color, 2, count($color), $fruit); // it will replace the after 2 index until end with the second array


$color= ["red", "green", "blue", "yellow", "brown"];

$fruit = ["Orange", "red"];

array_splice($color, 2, 0, $fruit); // it will not remove any value just add the second array after the offset 2 and the values will be move forward and array size will be increased 


$color= ["red", "green", "blue", "yellow", "brown"];

$fruit = ["Orange", "red"];

array_splice($color, 0, 0, $fruit); // it will add the second array in first at initial position without replacing or removing any value


$color= ["red", "green", "blue", "yellow", "brown"];

$fruit = ["Orange", "red"];

array_splice($color, count($color), 0, $fruit); // it will add the second array in first at end position without replacing or removing any value

