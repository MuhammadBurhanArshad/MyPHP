# PHP OOP Abstract Classes: Comprehensive Guide

## Definition
Abstract classes in PHP OOP are classes that cannot be instantiated on their own and serve as base classes for other classes. They may contain a mix of complete methods (with implementation) and abstract methods (without implementation) that must be defined by child classes.

## Basic Syntax

### Abstract Class Declaration
```php
abstract class Animal {
    // Regular method with implementation
    public function breathe() {
        return "Breathing...";
    }
    
    // Abstract method (no implementation)
    abstract public function makeSound();
}
```

### Concrete Child Class
```php
class Dog extends Animal {
    // Must implement all abstract methods
    public function makeSound() {
        return "Woof!";
    }
}

$dog = new Dog();
echo $dog->breathe();   // "Breathing..." (inherited)
echo $dog->makeSound(); // "Woof!" (implemented)
```

## Key Features

### 1. Cannot Be Instantiated
```php
abstract class Shape {
    abstract public function area();
}

// $shape = new Shape(); // Fatal error: Cannot instantiate abstract class
```

### 2. Can Have Properties
```php
abstract class Vehicle {
    protected $speed = 0;
    
    abstract public function accelerate($amount);
    
    public function currentSpeed() {
        return $this->speed;
    }
}

class Car extends Vehicle {
    public function accelerate($amount) {
        $this->speed += $amount;
        return "Accelerating to {$this->speed} km/h";
    }
}
```

### 3. Can Have Constructors
```php
abstract class DatabaseModel {
    protected $connection;
    
    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }
    
    abstract public function save();
}

class User extends DatabaseModel {
    public function save() {
        // Implementation using $this->connection
        return "User saved to database";
    }
}
```

## Abstract Methods

### Rules for Abstract Methods
1. Must be declared abstract
2. Cannot contain implementation
3. Must be implemented by child classes
4. Must match visibility (can't be more restrictive)

```php
abstract class PaymentGateway {
    // Must be implemented by child classes
    abstract public function processPayment($amount);
    
    // Can have regular methods
    public function logTransaction($amount) {
        echo "Processing payment of $amount";
    }
}

class CreditCardPayment extends PaymentGateway {
    public function processPayment($amount) {
        $this->logTransaction($amount);
        return "Processed credit card payment";
    }
}
```

## When to Use Abstract Classes

### 1. Template Method Pattern
```php
abstract class ReportGenerator {
    // Template method (defines algorithm structure)
    final public function generateReport() {
        $this->fetchData();
        $this->formatData();
        return $this->outputReport();
    }
    
    abstract protected function fetchData();
    abstract protected function formatData();
    
    protected function outputReport() {
        return "Report generated at " . date('Y-m-d H:i:s');
    }
}

class SalesReport extends ReportGenerator {
    protected function fetchData() {
        return "Fetching sales data...";
    }
    
    protected function formatData() {
        return "Formatting sales data...";
    }
}
```

### 2. Partial Implementation
```php
abstract class Logger {
    protected $logLevel = 'INFO';
    
    // Common implementation
    protected function formatMessage($message) {
        return "[{$this->logLevel}] " . date('Y-m-d H:i:s') . " - $message";
    }
    
    // To be implemented by children
    abstract public function log($message);
}

class FileLogger extends Logger {
    public function log($message) {
        $formatted = $this->formatMessage($message);
        file_put_contents('app.log', $formatted . PHP_EOL, FILE_APPEND);
    }
}
```

### 3. Framework Base Classes
```php
abstract class Controller {
    protected $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }
    
    abstract public function handle();
    
    protected function jsonResponse($data) {
        header('Content-Type: application/json');
        return json_encode($data);
    }
}

class UserController extends Controller {
    public function handle() {
        $userId = $this->request->get('id');
        return $this->jsonResponse(['user' => $userId]);
    }
}
```

## Abstract Classes vs Interfaces

| Feature              | Abstract Class                | Interface                   |
|----------------------|-------------------------------|-----------------------------|
| Instantiation        | Cannot be instantiated        | Cannot be instantiated      |
| Method Implementation | Can have both abstract and concrete methods | All methods are abstract |
| Properties           | Can have properties           | Cannot have properties      |
| Constants            | Can have constants            | Can have constants          |
| Multiple Inheritance | Single inheritance only       | Multiple implementation     |
| Constructor          | Can have constructor          | Cannot have constructor     |

## Best Practices

1. **Use for shared implementation** - When child classes share common behavior
2. **Name clearly** - Prefix with "Abstract" or use "Base" suffix
3. **Document abstract methods** - Clearly specify requirements
4. **Keep focused** - Follow Single Responsibility Principle
5. **Consider alternatives** - Sometimes interfaces or traits may be better

```php
/**
 * Abstract base class for all data importers
 * 
 * @abstract
 */
abstract class DataImporter {
    /**
     * @var array Configuration settings
     */
    protected $config;
    
    /**
     * @abstract
     * Must be implemented to validate source data
     * @return bool
     */
    abstract public function validateSource();
    
    /**
     * Common configuration loader
     */
    public function __construct(array $config) {
        $this->config = $config;
    }
    
    /**
     * Template method for import process
     */
    final public function import() {
        if (!$this->validateSource()) {
            throw new Exception("Invalid data source");
        }
        return $this->processData();
    }
    
    /**
     * @abstract
     * Must be implemented to process data
     */
    abstract protected function processData();
}
```

## Common Pitfalls

1. **Overusing abstract classes** - Not every hierarchy needs one
2. **Violating LSP** - Child classes should be substitutable for parent
3. **Too many abstract methods** - Makes implementation difficult
4. **Ignoring composition** - Sometimes better than inheritance
5. **Deep hierarchies** - Can become hard to maintain

```php
// Problematic deep hierarchy
abstract class A {}
abstract class B extends A {}
abstract class C extends B {}
class D extends C {} // Too many layers
```

## Advanced Techniques

### Abstract Class with Static Methods
```php
abstract class MathOperations {
    abstract public function calculate($a, $b);
    
    public static function perform(MathOperations $op, $a, $b) {
        return $op->calculate($a, $b);
    }
}

class Adder extends MathOperations {
    public function calculate($a, $b) {
        return $a + $b;
    }
}

echo MathOperations::perform(new Adder(), 5, 3); // 8
```

### Abstract Factory Pattern
```php
abstract class AbstractFactory {
    abstract public function createProductA();
    abstract public function createProductB();
}

class ConcreteFactory1 extends AbstractFactory {
    public function createProductA() {
        return new ProductA1();
    }
    
    public function createProductB() {
        return new ProductB1();
    }
}
```

## Performance Considerations

1. **No runtime overhead** - Abstract classes are compile-time constructs
2. **Method calls** - Same performance as regular classes
3. **Autoloading** - More classes mean more files to load
4. **Deep hierarchies** - Can impact performance slightly

## Modern PHP Features

### Abstract Classes with Typed Properties (PHP 7.4+)
```php
abstract class Entity {
    public int $id;
    public string $name;
    
    abstract public function validate(): bool;
}

class User extends Entity {
    public function validate(): bool {
        return !empty($this->name) && $this->id > 0;
    }
}
```

### Constructor Property Promotion (PHP 8.0+)
```php
abstract class Model {
    public function __construct(
        protected string $tableName,
        protected PDO $connection
    ) {}
    
    abstract public function save();
}

class Product extends Model {
    public function save() {
        // Use $this->tableName and $this->connection
    }
}
```

## When to Use Abstract Classes

1. **Shared base functionality** - Multiple classes share common implementation
2. **Framework design** - Providing extensible base classes
3. **Template methods** - Defining algorithm structure
4. **Partial implementation** - Some methods implemented, others left abstract

## When to Avoid Abstract Classes

1. **Multiple inheritance needed** - PHP doesn't support it
2. **Only contracts needed** - Use interfaces instead
3. **Simple scenarios** - When concrete classes suffice
4. **Unclear hierarchy** - When relationship isn't truly "is-a"

Remember: Abstract classes are powerful tools for creating well-organized class hierarchies, but they should be used judiciously. They work best when you have a clear "is-a" relationship and shared implementation between related classes. Always consider whether an interface or trait might be more appropriate for your specific use case.