<?php 

class Person {
   public $name, $age;

    function __construct($name = "No Name", $age = 0) {
        $this->name = $name;
        $this->age = $age;
    }

   function show() {
    echo $this->name . " - " . $this->age . "<br>";
   }
}


// Without constructor it should be like this:
// $object = new Person();
// $object->name = "John Doe";
// $object->age = 30;
// $object->show();


// With constructor it should be like this:
$object = new Person("Muhammad Burhan Arshad", 21);
$object->show();
