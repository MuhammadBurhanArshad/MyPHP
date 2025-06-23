<?php 

abstract class ParentClass {
    public $name;

    abstract protected function calc($a, $b);
}

class ChildClass extends ParentClass {
    public function __construct($name) {
        $this->name = $name;
    }

    public function calc($a, $b) {
        return $a + $b;
    }
}

$child = new ChildClass("Child");
echo $child->name . " says: " . $child->calc(5, 10) . "\n"; // Output: Child says: 15   