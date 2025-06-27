<?php 

function sum(int $value) {
    echo $value + 1;
}

// sum("hello"); // return the error because function accepts int instead of string
sum(19); // Output: 20

function fruits(array $fruits) {
    foreach ($fruits as $fruit) {
        echo "$fruit  <br />";
    }
}

// fruits('Apple'); // returns error because of passing string instead of array
fruits(['apple', 'mango', 'cherry']); // runs correctly


class Hello {
    public function sayHello () {
        echo "Hello EveryOne";
    }
}

class Bye {
    public function sayBye () {
        echo "Bye EveryOne";
    }
}

function wow(Hello $obj) {
    $obj->sayHello();
}

$obj = new Hello();

wow($obj);


// scenario

class School {
    public function getNames(Student $names) {
        foreach ($names->Names() as $name) {
            echo "$name . <br />";
        }
    }
}

class Student {
    public function Names() {
        return ["Ali", "James", "Harry"];
    }
}

$stu = new Student();
$sch = new School();

$sch->getNames( $stu);