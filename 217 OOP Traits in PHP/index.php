<?php 

// this trait could be use in multiple classes, and one trait can contain multiple function
trait Test {
    public function Hello () {
        echo "Say Hello";
    }
}

class Base{
    use Test;
}

$class = new Base();

$class->Hello();