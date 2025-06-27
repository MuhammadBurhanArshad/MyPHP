<?php 

// this trait could be use in multiple classes
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