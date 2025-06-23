# Object-Oriented Programming (OOP) in PHP

## Definition
Object-Oriented Programming (OOP) in PHP is a programming paradigm that uses objects and classes to organize code. It focuses on creating reusable, maintainable code by encapsulating data and behavior into discrete units.

## Basic Class Structure

### Class Declaration
```php
class Car {
    // Properties (attributes)
    public $make;
    public $model;
    public $year;
    
    // Constructor
    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }
    
    // Method (behavior)
    public function displayInfo() {
        return "This is a {$this->year} {$this->make} {$this->model}";
    }
}
```

### Creating Objects (Instantiation)
```php
$myCar = new Car('Toyota', 'Camry', 2022);
echo $myCar->displayInfo();
```

## The Four Pillars of OOP

### 1. Encapsulation
```php
class BankAccount {
    private $balance = 0;
    
    public function deposit($amount) {
        if ($amount > 0) {
            $this->balance += $amount;
        }
    }
    
    public function withdraw($amount) {
        if ($amount > 0 && $amount <= $this->balance) {
            $this->balance -= $amount;
            return $amount;
        }
        return 0;
    }
    
    public function getBalance() {
        return $this->balance;
    }
}

$account = new BankAccount();
$account->deposit(1000);
echo $account->getBalance(); // 1000
```

### 2. Inheritance
```php
class Animal {
    protected $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function speak() {
        return "Animal sound!";
    }
}

class Dog extends Animal {
    public function speak() {
        return "Woof!";
    }
    
    public function fetch() {
        return "{$this->name} fetches the ball!";
    }
}

$dog = new Dog('Buddy');
echo $dog->speak(); // Woof!
echo $dog->fetch(); // Buddy fetches the ball!
```

### 3. Polymorphism
```php
interface Shape {
    public function area();
}

class Circle implements Shape {
    private $radius;
    
    public function __construct($radius) {
        $this->radius = $radius;
    }
    
    public function area() {
        return pi() * pow($this->radius, 2);
    }
}

class Square implements Shape {
    private $side;
    
    public function __construct($side) {
        $this->side = $side;
    }
    
    public function area() {
        return pow($this->side, 2);
    }
}

function printArea(Shape $shape) {
    echo "Area: " . $shape->area() . "\n";
}

$circle = new Circle(5);
$square = new Square(4);
printArea($circle); // Area: ~78.54
printArea($square); // Area: 16
```

### 4. Abstraction
```php
abstract class DatabaseConnection {
    abstract public function connect();
    abstract public function query($sql);
    abstract public function disconnect();
    
    public function execute($sql) {
        $this->connect();
        $result = $this->query($sql);
        $this->disconnect();
        return $result;
    }
}

class MySQLConnection extends DatabaseConnection {
    public function connect() {
        // MySQL connection logic
    }
    
    public function query($sql) {
        // MySQL query execution
    }
    
    public function disconnect() {
        // MySQL disconnection logic
    }
}
```

## Visibility Modifiers

| Modifier    | Accessible From               |
|-------------|-------------------------------|
| public      | Anywhere                      |
| protected   | Within the class and child classes |
| private     | Only within the class         |

```php
class VisibilityExample {
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';
    
    public function show() {
        echo $this->public;  // Works
        echo $this->protected; // Works
        echo $this->private; // Works
    }
}

$obj = new VisibilityExample();
echo $obj->public; // Works
// echo $obj->protected; // Fatal error
// echo $obj->private; // Fatal error
```

## Static Properties and Methods
```php
class Counter {
    public static $count = 0;
    
    public function __construct() {
        self::$count++;
    }
    
    public static function getCount() {
        return self::$count;
    }
}

new Counter();
new Counter();
new Counter();
echo Counter::getCount(); // 3
```

## Magic Methods
```php
class MagicMethods {
    private $data = [];
    
    // __get and __set
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    // __toString
    public function __toString() {
        return print_r($this->data, true);
    }
    
    // __call
    public function __call($name, $arguments) {
        echo "Method $name doesn't exist. Called with: " . implode(', ', $arguments);
    }
}

$obj = new MagicMethods();
$obj->nonExistentMethod('param1', 'param2'); // Handled by __call
```

## Traits
```php
trait Logger {
    public function log($message) {
        echo "Logging: $message\n";
    }
}

trait Timestamp {
    public function currentTimestamp() {
        return date('Y-m-d H:i:s');
    }
}

class Application {
    use Logger, Timestamp;
    
    public function run() {
        $this->log("Application started at " . $this->currentTimestamp());
    }
}

$app = new Application();
$app->run();
```

## Interfaces vs Abstract Classes

| Feature            | Interface          | Abstract Class     |
|--------------------|--------------------|--------------------|
| Instantiation      | Cannot be instantiated | Cannot be instantiated |
| Methods           | All abstract       | Can have concrete methods |
| Properties        | Cannot have properties | Can have properties |
| Multiple inheritance | Supported       | Not supported      |
| Access modifiers  | All public         | Can be any visibility |

```php
interface LoggerInterface {
    public function log($message);
}

abstract class AbstractLogger implements LoggerInterface {
    protected $logLevel = 'INFO';
    
    abstract public function saveLog($message);
    
    public function log($message) {
        $this->saveLog("[{$this->logLevel}] $message");
    }
}
```

## Dependency Injection
```php
interface Mailer {
    public function send($to, $message);
}

class SmtpMailer implements Mailer {
    public function send($to, $message) {
        // SMTP sending logic
        echo "Sending to $to via SMTP: $message\n";
    }
}

class Newsletter {
    private $mailer;
    
    public function __construct(Mailer $mailer) {
        $this->mailer = $mailer;
    }
    
    public function sendNewsletter($subscribers, $content) {
        foreach ($subscribers as $subscriber) {
            $this->mailer->send($subscriber, $content);
        }
    }
}

$mailer = new SmtpMailer();
$newsletter = new Newsletter($mailer);
$newsletter->sendNewsletter(['user1@example.com', 'user2@example.com'], 'Hello!');
```

## Namespaces and Autoloading
```php
// File: src/Models/User.php
namespace MyApp\Models;

class User {
    private $name;
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
}

// File: index.php
require 'vendor/autoload.php';

use MyApp\Models\User;

$user = new User('John Doe');
echo $user->getName();
```

## Common Design Patterns in PHP OOP

### Singleton Pattern
```php
class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $this->connection = new PDO('mysql:host=localhost;dbname=test', 'user', 'pass');
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    private function __clone() {}
    private function __wakeup() {}
}

$db = Database::getInstance();
$conn = $db->getConnection();
```

### Factory Pattern
```php
interface PaymentMethod {
    public function processPayment($amount);
}

class CreditCardPayment implements PaymentMethod {
    public function processPayment($amount) {
        echo "Processing credit card payment for $amount\n";
    }
}

class PayPalPayment implements PaymentMethod {
    public function processPayment($amount) {
        echo "Processing PayPal payment for $amount\n";
    }
}

class PaymentFactory {
    public static function create($type) {
        switch ($type) {
            case 'credit':
                return new CreditCardPayment();
            case 'paypal':
                return new PayPalPayment();
            default:
                throw new Exception("Unknown payment method");
        }
    }
}

$payment = PaymentFactory::create('credit');
$payment->processPayment(100);
```

### Observer Pattern
```php
interface Observer {
    public function update($data);
}

class UserObserver implements Observer {
    public function update($data) {
        echo "User updated: " . print_r($data, true) . "\n";
    }
}

class User {
    private $observers = [];
    private $name;
    
    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }
    
    public function setName($name) {
        $this->name = $name;
        $this->notify();
    }
    
    private function notify() {
        foreach ($this->observers as $observer) {
            $observer->update(['name' => $this->name]);
        }
    }
}

$user = new User();
$user->attach(new UserObserver());
$user->setName('Alice');
```

## Best Practices

1. **Follow SOLID principles**:
   - Single Responsibility Principle
   - Open/Closed Principle
   - Liskov Substitution Principle
   - Interface Segregation Principle
   - Dependency Inversion Principle

2. **Use type hinting** where possible
3. **Document your classes** with PHPDoc
4. **Keep classes small** and focused
5. **Prefer composition over inheritance**
6. **Use dependency injection** for better testability
7. **Follow PSR standards** (PSR-1, PSR-2, PSR-4, etc.)

## Common Pitfalls

1. **God objects** - Classes that do too much
2. **Deep inheritance hierarchies** - Hard to maintain
3. **Tight coupling** - Classes that depend too much on each other
4. **Ignoring encapsulation** - Exposing too much internal state
5. **Overusing static methods** - Can make testing difficult

## Performance Considerations

1. **Autoloading** reduces memory usage
2. **Object creation** has some overhead
3. **Magic methods** are slower than direct calls
4. **Deep inheritance** can impact performance
5. **Serialization** of complex objects can be expensive

## Modern PHP OOP Features

### Typed Properties (PHP 7.4+)
```php
class User {
    public int $id;
    public string $name;
    public ?string $email; // Nullable
    
    public function __construct(int $id, string $name, ?string $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}
```

### Constructor Property Promotion (PHP 8.0+)
```php
class User {
    public function __construct(
        public int $id,
        public string $name,
        public ?string $email = null
    ) {}
}
```

### Match Expression (PHP 8.0+)
```php
class PaymentProcessor {
    public function process(string $method, float $amount) {
        return match($method) {
            'credit' => $this->processCredit($amount),
            'paypal' => $this->processPaypal($amount),
            default => throw new InvalidArgumentException("Unknown method"),
        };
    }
}
```

### Named Arguments (PHP 8.0+)
```php
class Product {
    public function __construct(
        public string $name,
        public float $price,
        public ?string $description = null
    ) {}
}

$product = new Product(
    name: 'Laptop',
    description: 'High-performance laptop',
    price: 999.99
);
```

## When to Use OOP in PHP

1. **Complex applications** with many components
2. **Long-term projects** that need maintenance
3. **Team environments** where code needs to be shared
4. **Frameworks and libraries** that need extensibility
5. **Applications requiring** code reuse and modularity

Remember: OOP is a powerful paradigm but not always the best solution for every PHP script. For simple scripts or one-time tasks, procedural programming might be more appropriate. The key is to use the right tool for the job while keeping your code organized, maintainable, and scalable.