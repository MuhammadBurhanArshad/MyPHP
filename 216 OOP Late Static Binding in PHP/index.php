<?php 


class Base {
    protected static $name = "Muhammad Burhan";

    public function show() {
        return static::$name; // static binding use the current class context, from where the method is called
    }
}

class Child extends Base {
    protected static $name = "Child Class";

}

$base = new Base();

$child = new Child();

$childName = $child->show(); // Output: Child Class
$baseName = $base->show(); // Output: Muhammad Burhan