<?php 

class Employee {
    public $name, $age, $salary;

     function __construct($name = "No Name", $age = 0, $salary = 0) {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
     }

     function info() {
        echo "<h3>Employee Information</h3>";
        echo "Name: " . $this->name . "<br>";
        echo "Age: " . $this->age . "<br>";
        echo "Salary: Rs " . number_format($this->salary, 2) . "<br>";
     }
}

class Manager extends Employee {
    public $travelAllowance = 300, $phoneAllowance = 200;

    function info() {
        parent::info();
        echo "Travel Allowance: Rs " . number_format($this->travelAllowance, 2) . "<br>";
        echo "Phone Allowance: Rs " . number_format($this->phoneAllowance, 2) . "<br>";
    }
}

$employee1 = new Employee("John Doe", 30, 50000);
$employee2 = new Manager("Jane Smith", 25, 60000);

$employee1->info();
$employee2->info();