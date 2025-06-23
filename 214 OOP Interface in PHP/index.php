<?php 

interface ParentOneInterface {
    function calc($a, $b);
}

interface ParentTwoInterface {
    function sub($a, $b);
}

class ChildClass implements ParentOneInterface, ParentTwoInterface {
    public function calc($a, $b) {
        return $a + $b;
    }

    public function sub($a, $b) {
        return $a - $b;
    }
}