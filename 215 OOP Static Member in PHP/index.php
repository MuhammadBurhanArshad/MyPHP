<?php 

class Base {
    public static $name = "Muhammad Burhan";

    public function __construct() {
        // Constructor logic can go here if needed
        // cam also update the $name with self::$name
    }

    public static function getName() {
        return self::$name;
    }
}

class Child extends Base {
    public static function show() {
        return parent::$name;
    }
}

echo Base::getName() . "\n"; // Output: Muhammad Burhan
echo Child::show() . "\n"; // Output: Muhammad Burhan
