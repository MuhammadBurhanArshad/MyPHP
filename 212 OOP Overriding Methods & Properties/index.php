<?php 

class Base {
    public $name = "Parent Class";

    public function calc($a, $b) {
        return $a + $b;
    }
}

class Derived extends Base {
    public $name = "Child Class";

    public function calc($a, $b) {
        return $a * $b; // Overriding the calc method
    }
}

$base = new Base();
$derived = new Derived();

echo $base->name; // Output: Parent Class
echo "<br>";
echo $derived->name; // Output: Child Class
echo "<br>";

echo $base->calc(2, 3); // Output: 5 (from Base class)
echo "<br>";
echo $derived->calc(2, 3); // Output: 6 (from Derived class)
echo "<br>";