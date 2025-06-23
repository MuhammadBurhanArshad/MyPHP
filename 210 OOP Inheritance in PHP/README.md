# PHP OOP Inheritance: Comprehensive Guide

## Definition
Inheritance in PHP OOP is a mechanism where a child class (subclass) inherits properties and methods from a parent class (superclass). This enables code reuse and establishes hierarchical relationships between classes.

## Basic Inheritance Syntax

### Simple Inheritance
```php
class Vehicle {
    public $make;
    public $model;
    
    public function __construct($make, $model) {
        $this->make = $make;
        $this->model = $model;
    }
    
    public function startEngine() {
        return "Engine started for {$this->make} {$this->model}";
    }
}

class Car extends Vehicle {
    public $numDoors;
    
    public function __construct($make, $model, $numDoors) {
        parent::__construct($make, $model);
        $this->numDoors = $numDoors;
    }
    
    public function openTrunk() {
        return "Trunk opened for {$this->make} {$this->model}";
    }
}

$car = new Car('Toyota', 'Camry', 4);
echo $car->startEngine(); // Inherited from Vehicle
echo $car->openTrunk();   // Specific to Car
```

## Types of Inheritance

### 1. Single Inheritance
```php
class Animal {
    public function eat() {
        return "Eating...";
    }
}

class Dog extends Animal {
    public function bark() {
        return "Woof!";
    }
}

$dog = new Dog();
echo $dog->eat();  // From Animal
echo $dog->bark(); // From Dog
```

### 2. Multilevel Inheritance
```php
class Shape {
    protected $color;
    
    public function setColor($color) {
        $this->color = $color;
    }
}

class Polygon extends Shape {
    protected $sides;
    
    public function setSides($sides) {
        $this->sides = $sides;
    }
}

class Triangle extends Polygon {
    public function __construct() {
        $this->setSides(3);
    }
    
    public function describe() {
        return "A {$this->color} triangle with {$this->sides} sides";
    }
}

$triangle = new Triangle();
$triangle->setColor('blue');
echo $triangle->describe();
```

### 3. Hierarchical Inheritance
```php
class Person {
    protected $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function introduce() {
        return "I am {$this->name}";
    }
}

class Student extends Person {
    private $studentId;
    
    public function __construct($name, $studentId) {
        parent::__construct($name);
        $this->studentId = $studentId;
    }
    
    public function study() {
        return "{$this->name} is studying";
    }
}

class Teacher extends Person {
    private $subject;
    
    public function __construct($name, $subject) {
        parent::__construct($name);
        $this->subject = $subject;
    }
    
    public function teach() {
        return "{$this->name} teaches {$this->subject}";
    }
}

$student = new Student('Alice', 'S123');
$teacher = new Teacher('Bob', 'Math');
echo $student->introduce() . " - " . $student->study();
echo $teacher->introduce() . " - " . $teacher->teach();
```

## Visibility Modifiers in Inheritance

| Modifier    | Inheritance Behavior                     |
|-------------|------------------------------------------|
| public      | Inherited and accessible everywhere      |
| protected   | Inherited and accessible in child classes|
| private     | Not inherited                            |

```php
class ParentClass {
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';
    
    public function show() {
        echo $this->public;    // Works
        echo $this->protected; // Works
        echo $this->private;   // Works
    }
}

class ChildClass extends ParentClass {
    public function showChild() {
        echo $this->public;    // Works
        echo $this->protected; // Works
        // echo $this->private; // Fatal error
    }
}

$child = new ChildClass();
echo $child->public;    // Works
// echo $child->protected; // Fatal error
// echo $child->private;   // Fatal error
```

## Method Overriding

### Basic Overriding
```php
class Animal {
    public function makeSound() {
        return "Some generic animal sound";
    }
}

class Cat extends Animal {
    public function makeSound() {
        return "Meow";
    }
}

$animal = new Animal();
$cat = new Cat();
echo $animal->makeSound(); // "Some generic animal sound"
echo $cat->makeSound();    // "Meow"
```

### Calling Parent Method
```php
class Employee {
    public function calculateSalary() {
        return 1000;
    }
}

class Manager extends Employee {
    public function calculateSalary() {
        $baseSalary = parent::calculateSalary();
        return $baseSalary + 500;
    }
}

$manager = new Manager();
echo $manager->calculateSalary(); // 1500
```

## Final Classes and Methods

### Final Class (Cannot be inherited)
```php
final class DatabaseConnection {
    // Implementation
}

// class MySQLConnection extends DatabaseConnection {} // Fatal error
```

### Final Method (Cannot be overridden)
```php
class PaymentProcessor {
    final public function process() {
        // Core processing logic that shouldn't be changed
    }
}

class CreditCardProcessor extends PaymentProcessor {
    // public function process() {} // Fatal error
}
```

## Abstract Classes and Methods

### Abstract Class (Cannot be instantiated)
```php
abstract class Shape {
    abstract public function area();
    
    public function describe() {
        return "This shape has an area of " . $this->area();
    }
}

class Circle extends Shape {
    private $radius;
    
    public function __construct($radius) {
        $this->radius = $radius;
    }
    
    public function area() {
        return pi() * pow($this->radius, 2);
    }
}

// $shape = new Shape(); // Fatal error
$circle = new Circle(5);
echo $circle->describe();
```

## Interfaces and Inheritance

### Interface Inheritance
```php
interface Logger {
    public function log($message);
}

interface FileLogger extends Logger {
    public function logToFile($message, $filename);
}

class SimpleFileLogger implements FileLogger {
    public function log($message) {
        echo $message . "\n";
    }
    
    public function logToFile($message, $filename) {
        file_put_contents($filename, $message . PHP_EOL, FILE_APPEND);
    }
}
```

### Class Implementing Multiple Interfaces
```php
interface Serializable {
    public function serialize();
}

interface Renderable {
    public function render();
}

class Widget implements Serializable, Renderable {
    public function serialize() {
        return "Serialized data";
    }
    
    public function render() {
        return "Rendered output";
    }
}
```

## Traits and Inheritance

### Using Traits with Inheritance
```php
trait Logger {
    public function log($message) {
        echo "Log: $message\n";
    }
}

class Base {
    use Logger;
    
    public function test() {
        $this->log("Test message");
    }
}

class Child extends Base {
    public function childTest() {
        $this->log("Child test message");
    }
}

$child = new Child();
$child->test();
$child->childTest();
```

### Trait Conflict Resolution
```php
trait A {
    public function smallTalk() {
        return 'a';
    }
}

trait B {
    public function smallTalk() {
        return 'b';
    }
}

class Talker {
    use A, B {
        B::smallTalk insteadof A;
        A::smallTalk as aSmallTalk;
    }
}

$talker = new Talker();
echo $talker->smallTalk(); // 'b'
echo $talker->aSmallTalk(); // 'a'
```

## Constructor Inheritance

### Parent Constructor Calling
```php
class ParentClass {
    protected $value;
    
    public function __construct($value) {
        $this->value = $value;
        echo "Parent constructor called with $value\n";
    }
}

class ChildClass extends ParentClass {
    public function __construct($value, $extra) {
        parent::__construct($value);
        $this->extra = $extra;
        echo "Child constructor called with $extra\n";
    }
}

$child = new ChildClass('main', 'additional');
```

### Automatic Constructor Inheritance (PHP 8.0+)
```php
class ParentClass {
    public function __construct(public $base) {}
}

class ChildClass extends ParentClass {
    // No constructor needed if just passing through
}

$child = new ChildClass('value');
echo $child->base; // 'value'
```

## Static Inheritance

### Static Properties and Methods
```php
class Counter {
    protected static $count = 0;
    
    public static function increment() {
        static::$count++;
    }
    
    public static function getCount() {
        return static::$count;
    }
}

class SubCounter extends Counter {
    public static function reset() {
        static::$count = 0;
    }
}

Counter::increment();
Counter::increment();
SubCounter::increment();
echo Counter::getCount();    // 3
echo SubCounter::getCount(); // 3 (same property)
SubCounter::reset();
echo Counter::getCount();    // 0 (resets the shared count)
```

### Late Static Binding
```php
class ParentClass {
    public static function who() {
        return __CLASS__;
    }
    
    public static function test() {
        echo self::who() . "\n";  // Early binding
        echo static::who() . "\n"; // Late static binding
    }
}

class ChildClass extends ParentClass {
    public static function who() {
        return __CLASS__;
    }
}

ChildClass::test();
// Output:
// ParentClass
// ChildClass
```

## Inheritance Best Practices

1. **Favor composition over inheritance** - Use inheritance for "is-a" relationships only
2. **Keep inheritance hierarchies shallow** - Deep hierarchies become hard to maintain
3. **Use abstract classes for shared implementation** - When classes share common behavior
4. **Use interfaces for contracts** - When you need to enforce method implementation
5. **Avoid overriding concrete methods** - Unless absolutely necessary
6. **Document inheritance relationships** - Clearly indicate why inheritance is used

## Common Pitfalls

1. **Fragile base class problem** - Changes in parent class may break child classes
2. **Inheritance for code reuse only** - Leads to inappropriate hierarchies
3. **Diamond problem** - PHP doesn't support multiple inheritance for classes
4. **Overriding private methods** - They're not actually overridden, just hidden
5. **Constructor not called** - Forgetting to call parent::__construct()

```php
class A {
    private function test() { return 'A'; }
    public function runTest() { return $this->test(); }
}

class B extends A {
    private function test() { return 'B'; }
}

$b = new B();
echo $b->runTest(); // 'A' (not 'B' as might be expected)
```

## Performance Considerations

1. **Deep inheritance chains** - Add slight overhead to method calls
2. **Late static binding** - Has minor performance impact
3. **Autoloading** - More classes mean more files to load
4. **Memory usage** - Each object carries its entire inheritance hierarchy

## Modern PHP Inheritance Features

### Constructor Property Promotion with Inheritance (PHP 8.0+)
```php
class Point {
    public function __construct(
        public float $x,
        public float $y
    ) {}
}

class Point3D extends Point {
    public function __construct(
        float $x,
        float $y,
        public float $z
    ) {
        parent::__construct($x, $y);
    }
}

$point3d = new Point3D(1.0, 2.0, 3.0);
```

### Readonly Properties in Inheritance (PHP 8.1+)
```php
class ImmutableBase {
    public function __construct(
        public readonly string $id
    ) {}
}

class ImmutableChild extends ImmutableBase {
    public function __construct(
        string $id,
        public readonly string $name
    ) {
        parent::__construct($id);
    }
}

$obj = new ImmutableChild('123', 'Alice');
// $obj->name = 'Bob'; // Error: Cannot modify readonly property
```

## When to Use Inheritance

1. **True "is-a" relationships** - When child is a specialized version of parent
2. **Framework extension points** - When extending base functionality
3. **Interface implementations** - When multiple classes share common behavior
4. **Template Method pattern** - When parent defines algorithm structure

## When to Avoid Inheritance

1. **Just for code reuse** - Use composition instead
2. **Multiple inheritance needed** - PHP doesn't support it for classes
3. **Frequent changes to parent** - Causes fragile base class problem
4. **Unclear relationship** - When "is-a" relationship isn't obvious

Remember: Inheritance is a powerful tool for creating hierarchical relationships between classes, but it should be used judiciously. Modern PHP development often favors composition and dependency injection over deep inheritance hierarchies, as they provide more flexible and maintainable code structures.