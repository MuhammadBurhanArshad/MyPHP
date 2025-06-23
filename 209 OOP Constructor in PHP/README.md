# PHP OOP Constructors: A Comprehensive Guide

## Definition
Constructors in PHP OOP are special methods that are automatically called when an object is instantiated. They are used to initialize object properties and perform setup operations.

## Basic Constructor Syntax

### Traditional Constructor (PHP 5+)
```php
class User {
    private $name;
    private $email;
    
    // Constructor method
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
        echo "User {$this->name} created!\n";
    }
}

$user = new User('John Doe', 'john@example.com');
```

### Constructor Property Promotion (PHP 8.0+)
```php
class User {
    // Properties are declared and assigned in constructor parameters
    public function __construct(
        private string $name,
        private string $email,
        private DateTime $createdAt = new DateTime()
    ) {
        echo "User {$this->name} created at {$this->createdAt->format('Y-m-d')}!\n";
    }
}

$user = new User('Jane Smith', 'jane@example.com');
```

## Types of Constructors

### 1. Default Constructor
```php
class Product {
    // If no constructor is defined, PHP provides an empty default constructor
    public function display() {
        echo "Product created\n";
    }
}

$product = new Product(); // No constructor arguments
$product->display();
```

### 2. Parameterized Constructor
```php
class Book {
    public function __construct(
        public string $title,
        public string $author,
        public float $price
    ) {
        echo "New book: {$this->title} by {$this->author}\n";
    }
}

$book = new Book('PHP Basics', 'John Doe', 29.99);
```

### 3. Constructor with Default Values
```php
class Account {
    public function __construct(
        public string $username,
        public string $role = 'user',
        public bool $isActive = true
    ) {
        echo "Account created: {$this->username} ({$this->role})\n";
    }
}

$user1 = new Account('johndoe'); // Uses default role and status
$admin = new Account('admin', 'administrator', true);
```

### 4. Constructor Overloading (Simulated)
```php
class Customer {
    public function __construct() {
        $args = func_get_args();
        $numArgs = func_num_args();
        
        if ($numArgs == 1) {
            $this->__construct1($args[0]);
        } elseif ($numArgs == 2) {
            $this->__construct2($args[0], $args[1]);
        }
    }
    
    private function __construct1($name) {
        $this->name = $name;
        $this->email = 'default@example.com';
    }
    
    private function __construct2($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }
}

$cust1 = new Customer('John');
$cust2 = new Customer('Jane', 'jane@example.com');
```

## Constructor Chaining

### Parent Constructor Calling
```php
class Person {
    public function __construct(protected string $name) {
        echo "Person constructor called\n";
    }
}

class Employee extends Person {
    public function __construct(string $name, private string $position) {
        parent::__construct($name);
        echo "Employee constructor called\n";
    }
}

$emp = new Employee('Alice', 'Developer');
```

### Constructor Chaining in the Same Class
```php
class Rectangle {
    public function __construct(
        public float $width,
        public float $height,
        public string $color = 'black'
    ) {
        echo "Rectangle created: {$width}x{$height}, color {$color}\n";
    }
    
    public static function createSquare(float $side, string $color = 'black') {
        return new self($side, $side, $color);
    }
}

$rect = new Rectangle(10, 20);
$square = Rectangle::createSquare(15, 'blue');
```

## Special Constructor Cases

### Private Constructor (Singleton Pattern)
```php
class Database {
    private static ?self $instance = null;
    
    private function __construct() {
        // Private to prevent direct instantiation
        echo "Database connection established\n";
    }
    
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

$db = Database::getInstance();
// $db2 = new Database(); // Error: Call to private constructor
```

### Constructor in Abstract Classes
```php
abstract class Animal {
    public function __construct(protected string $name) {
        echo "Animal {$name} created\n";
    }
    
    abstract public function makeSound();
}

class Dog extends Animal {
    public function makeSound() {
        echo "{$this->name} says Woof!\n";
    }
}

$dog = new Dog('Buddy');
$dog->makeSound();
```

### Constructor in Traits
```php
trait Logger {
    public function __construct() {
        echo "Logger initialized\n";
        parent::__construct();
    }
}

class Application {
    use Logger;
    
    public function __construct() {
        echo "Application started\n";
    }
}

$app = new Application();
// Output:
// Logger initialized
// Application started
```

## Constructor Best Practices

1. **Keep constructors simple** - Avoid complex logic
2. **Use dependency injection** - Pass dependencies as parameters
3. **Initialize all properties** - Ensure object is in valid state
4. **Consider nullable properties** - Use null as default when appropriate
5. **Document constructor parameters** - With PHPDoc comments

```php
/**
 * Represents a blog post
 */
class BlogPost {
    /**
     * @param string $title The post title
     * @param string $content The post content
     * @param DateTime|null $publishDate Optional publication date
     * @param string[] $tags Array of tags
     */
    public function __construct(
        public readonly string $title,
        public readonly string $content,
        public readonly ?DateTime $publishDate = null,
        public array $tags = []
    ) {
        if (empty($title)) {
            throw new InvalidArgumentException("Title cannot be empty");
        }
    }
}
```

## Constructor vs Destructor

### Constructor (`__construct`)
- Called when object is created
- Used for initialization
- Can accept parameters

### Destructor (`__destruct`)
```php
class FileHandler {
    private $file;
    
    public function __construct(string $filename) {
        $this->file = fopen($filename, 'a');
        echo "File opened\n";
    }
    
    public function __destruct() {
        if ($this->file) {
            fclose($this->file);
            echo "File closed\n";
        }
    }
}

$handler = new FileHandler('test.txt');
// When $handler goes out of scope or script ends, destructor is called
```

## Common Constructor Patterns

### Factory Method
```php
class User {
    private function __construct(
        private string $email,
        private string $passwordHash
    ) {}
    
    public static function create(string $email, string $password): self {
        return new self($email, password_hash($password, PASSWORD_DEFAULT));
    }
}

$user = User::create('test@example.com', 'secure123');
```

### Builder Pattern
```php
class QueryBuilder {
    private array $select = [];
    private string $from = '';
    
    public function __construct() {}
    
    public function select(array $fields): self {
        $this->select = $fields;
        return $this;
    }
    
    public function from(string $table): self {
        $this->from = $table;
        return $this;
    }
    
    public function build(): string {
        return 'SELECT ' . implode(', ', $this->select) . ' FROM ' . $this->from;
    }
}

$query = (new QueryBuilder())
    ->select(['id', 'name'])
    ->from('users')
    ->build();
```

## Constructor in Interfaces

While interfaces can't have constructors, you can enforce implementation:
```php
interface Identifiable {
    public function __construct(int $id);
}

class Product implements Identifiable {
    public function __construct(
        private int $id,
        private string $name
    ) {
        // Implements the interface requirement
    }
}
```

## Constructor Gotchas

1. **Name collisions** - Old PHP 4 style constructors (same name as class) are deprecated
2. **Return values** - Constructors shouldn't return values
3. **Exceptions** - Can throw exceptions if initialization fails
4. **Serialization** - Objects need proper constructor when unserialized

```php
class Config {
    public function __construct(private array $settings) {
        if (empty($settings)) {
            throw new InvalidArgumentException("Settings cannot be empty");
        }
    }
    
    public function __serialize(): array {
        return ['settings' => $this->settings];
    }
    
    public function __unserialize(array $data): void {
        $this->__construct($data['settings']);
    }
}

try {
    $config = new Config([]); // Throws exception
} catch (InvalidArgumentException $e) {
    echo $e->getMessage();
}
```

## Performance Considerations

1. **Object creation** has overhead - Avoid unnecessary instantiations
2. **Complex constructors** can slow down application startup
3. **Dependency injection** containers can optimize constructor calls

## Modern PHP Constructor Features

### Readonly Properties (PHP 8.1+)
```php
class ImmutablePoint {
    public function __construct(
        public readonly float $x,
        public readonly float $y,
        public readonly float $z
    ) {}
}

$point = new ImmutablePoint(1.0, 2.5, 3.7);
// $point->x = 5.0; // Error: Cannot modify readonly property
```

### Named Arguments with Constructors (PHP 8.0+)
```php
class Order {
    public function __construct(
        public string $id,
        public float $total,
        public ?string $coupon = null,
        public bool $isPaid = false
    ) {}
}

$order = new Order(
    id: 'ORD123',
    total: 99.99,
    isPaid: true
);
```

### First-Class Callable Syntax (PHP 8.1+)
```php
class Multiplier {
    public function __construct(private float $factor) {}
    
    public function multiply(float $value): float {
        return $value * $this->factor;
    }
}

$double = new Multiplier(2);
$multiplyFn = $double->multiply(...);
echo $multiplyFn(5); // 10
```

## When to Use Advanced Constructor Patterns

1. **Singleton** - When you need exactly one instance
2. **Factory** - When object creation is complex
3. **Dependency Injection** - For testable, modular code
4. **Builder** - When objects have many configuration options
5. **Immutable Objects** - When thread-safety or predictability is important

Remember: Constructors are your object's birth certificate - they establish the initial valid state of your objects. Design them carefully to ensure your objects are always in a consistent state after creation.