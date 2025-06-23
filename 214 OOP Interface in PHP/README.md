# PHP OOP Interfaces: Comprehensive Guide

## Definition
Interfaces in PHP OOP are contracts that define a set of methods that implementing classes must define. They specify *what* a class must do without specifying *how* it should do it.

## Basic Syntax

### Interface Declaration
```php
interface Logger {
    public function log(string $message): void;
}
```

### Class Implementation
```php
class FileLogger implements Logger {
    public function log(string $message): void {
        file_put_contents('app.log', $message, FILE_APPEND);
    }
}

class DatabaseLogger implements Logger {
    public function log(string $message): void {
        // Save to database implementation
    }
}
```

## Key Features

### 1. All Methods Are Abstract
```php
interface PaymentGateway {
    public function process(float $amount): bool;
    public function refund(string $transactionId): bool;
}
```

### 2. Cannot Be Instantiated
```php
// $gateway = new PaymentGateway(); // Fatal error
```

### 3. No Properties Allowed
```php
interface UserAuth {
    // public $token; // Not allowed
    public function authenticate(string $username, string $password): bool;
}
```

## Multiple Interface Implementation

### Implementing Multiple Interfaces
```php
interface Logger {
    public function log(string $message): void;
}

interface Notifier {
    public function sendNotification(string $message): bool;
}

class NotificationLogger implements Logger, Notifier {
    public function log(string $message): void {
        // Implementation
    }
    
    public function sendNotification(string $message): bool {
        // Implementation
        return true;
    }
}
```

## Interface Inheritance

### Extending Interfaces
```php
interface BasicLogger {
    public function log(string $message): void;
}

interface DetailedLogger extends BasicLogger {
    public function logWithTimestamp(string $message): void;
}

class MyLogger implements DetailedLogger {
    public function log(string $message): void {
        // Implementation
    }
    
    public function logWithTimestamp(string $message): void {
        $timestamp = date('Y-m-d H:i:s');
        $this->log("[$timestamp] $message");
    }
}
```

## Constants in Interfaces

### Interface Constants
```php
interface HTTPStatus {
    public const OK = 200;
    public const NOT_FOUND = 404;
    public const SERVER_ERROR = 500;
}

class Response implements HTTPStatus {
    public function handle(int $code): string {
        return match($code) {
            self::OK => 'Success',
            self::NOT_FOUND => 'Not Found',
            default => 'Error'
        };
    }
}
```

## Type Hinting with Interfaces

### Polymorphism Example
```php
interface Shape {
    public function area(): float;
}

class Circle implements Shape {
    public function __construct(private float $radius) {}
    
    public function area(): float {
        return pi() * $this->radius ** 2;
    }
}

class Square implements Shape {
    public function __construct(private float $side) {}
    
    public function area(): float {
        return $this->side ** 2;
    }
}

function printArea(Shape $shape): void {
    echo "Area: " . $shape->area() . "\n";
}

printArea(new Circle(5)); // Works
printArea(new Square(4)); // Works
```

## Best Practices

1. **Name interfaces clearly** - Use nouns (Logger) or adjectives (Loggable)
2. **Keep interfaces focused** - Follow Interface Segregation Principle
3. **Document expected behavior** - In method docblocks
4. **Prefix with 'I' optionally** - Some prefer ILogger vs Logger
5. **Use for dependency injection** - Makes code more testable

```php
/**
 * Interface for caching operations
 */
interface CacheInterface {
    /**
     * Store an item in the cache
     * @param string $key
     * @param mixed $value
     * @param int $ttl Time to live in seconds
     * @return bool True on success
     */
    public function set(string $key, $value, int $ttl = 3600): bool;
    
    /**
     * Retrieve an item from the cache
     * @param string $key
     * @return mixed|null Returns null if key doesn't exist
     */
    public function get(string $key);
}
```

## Common Pitfalls

1. **Adding too many methods** - Violates Interface Segregation Principle
2. **Assuming implementation details** - Interfaces should be abstract
3. **Using interfaces for everything** - Not every class needs an interface
4. **Breaking existing implementations** - Changing interfaces breaks all implementers
5. **Confusing with abstract classes** - Remember interfaces can't have implementation

## Advanced Techniques

### Interface Composition
```php
interface Readable {
    public function read(): string;
}

interface Writable {
    public function write(string $data): void;
}

interface ReadWritable extends Readable, Writable {
    // Combines both interfaces
}

class FileHandler implements ReadWritable {
    // Must implement both read() and write()
}
```

### Null Object Pattern
```php
interface Logger {
    public function log(string $message): void;
}

class NullLogger implements Logger {
    public function log(string $message): void {
        // Does nothing
    }
}

// Usage when logging is optional
function process(Logger $logger = new NullLogger()) {
    $logger->log("Processing started");
}
```

## Modern PHP Features

### Constructor Property Promotion with Interfaces (PHP 8.0+)
```php
interface UserRepository {
    public function find(int $id): ?User;
}

class DatabaseUserRepository implements UserRepository {
    public function __construct(private PDO $connection) {}
    
    public function find(int $id): ?User {
        // Implementation using $this->connection
    }
}
```

### Union Types in Interface Methods (PHP 8.0+)
```php
interface ResponseFactory {
    public function createResponse(int|string $code): Response;
}
```

## When to Use Interfaces

1. **Multiple unrelated classes** need same functionality
2. **Decoupling components** for dependency injection
3. **Defining contracts** between different parts of system
4. **Creating plugin architectures** where implementations may vary
5. **Team development** to define clear boundaries

## When to Avoid Interfaces

1. **Single implementation** that won't change
2. **When you need shared implementation** (use abstract class)
3. **When you need properties** in your contract
4. **Simple projects** where they add unnecessary complexity

## Performance Considerations

1. **No runtime overhead** - Resolved at compile time
2. **Autoloading impact** - More interfaces mean more files
3. **Method calls** - Same performance as regular class methods
4. **Type checking** - instanceof checks are very fast

## Interface vs Abstract Class

| Feature              | Interface            | Abstract Class        |
|----------------------|----------------------|-----------------------|
| Instantiation        | Not allowed          | Not allowed           |
| Method Implementation | None allowed        | Partial allowed       |
| Properties          | Not allowed          | Allowed               |
| Constants           | Allowed              | Allowed               |
| Multiple Inheritance | Supported           | Single inheritance    |
| Constructor         | Not allowed          | Allowed               |

Remember: Interfaces are about *capabilities* ("can do"), while abstract classes are about *identity* ("is a"). Use interfaces to define contracts that can be implemented by any class, regardless of its position in the class hierarchy. They are essential for creating loosely coupled, maintainable, and testable object-oriented code in PHP.