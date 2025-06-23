# PHP OOP Static Members: Comprehensive Guide

## Definition
Static members in PHP OOP are properties and methods that belong to the class itself rather than any object instance. They can be accessed without creating an instance of the class.

## Basic Syntax

### Static Property Declaration
```php
class Counter {
    public static int $count = 0;
}
```

### Static Method Declaration
```php
class MathOperations {
    public static function add(float $a, float $b): float {
        return $a + $b;
    }
}
```

## Key Features

### 1. Accessed Using Scope Resolution Operator
```php
// Accessing static property
Counter::$count = 5;

// Calling static method
$result = MathOperations::add(3.5, 2.5);
```

### 2. Shared Across All Instances
```php
class User {
    public static int $userCount = 0;
    
    public function __construct() {
        self::$userCount++;
    }
}

$user1 = new User();
$user2 = new User();
echo User::$userCount; // Outputs 2
```

### 3. Cannot Use $this
```php
class Example {
    public static function demo() {
        // $this->property = 'value'; // Fatal error
    }
}
```

## Static Properties

### Declaration and Access
```php
class Configuration {
    public static string $environment = 'production';
    private static array $settings = [];
    
    public static function getSetting(string $key) {
        return self::$settings[$key] ?? null;
    }
}

// Access public static property
echo Configuration::$environment;

// Access via static method
$value = Configuration::getSetting('timeout');
```

### Late Static Binding (static::)
```php
class ParentClass {
    protected static string $name = 'Parent';
    
    public static function getName(): string {
        return static::$name; // Late static binding
    }
}

class ChildClass extends ParentClass {
    protected static string $name = 'Child';
}

echo ChildClass::getName(); // Outputs "Child"
```

## Static Methods

### Basic Usage
```php
class StringUtils {
    public static function contains(string $haystack, string $needle): bool {
        return strpos($haystack, $needle) !== false;
    }
}

$found = StringUtils::contains('Hello world', 'world');
```

### Factory Pattern Example
```php
class Product {
    private function __construct(private string $type) {}
    
    public static function create(string $type): Product {
        return new self($type);
    }
}

$product = Product::create('electronics');
```

## Constants vs Static Properties

### Class Constants
```php
class HttpStatus {
    public const OK = 200;
    public const NOT_FOUND = 404;
    public const SERVER_ERROR = 500;
}

echo HttpStatus::OK; // Accessed like static property but can't be changed
```

### Static Properties
```php
class AppConfig {
    public static string $environment = 'dev';
    public static bool $debugMode = true;
}

AppConfig::$environment = 'production'; // Can be modified
```

## Best Practices

1. **Use for utility functions** - When functionality doesn't depend on object state
2. **Consider singleton pattern** - For managing global state
3. **Document thoroughly** - Since they're globally accessible
4. **Avoid overuse** - Can lead to tight coupling and testing difficulties
5. **Name clearly** - Indicate they're static (e.g., Utility::)

```php
/**
 * Math utility functions
 */
class MathUtils {
    /**
     * Calculate percentage
     * @param float $part
     * @param float $whole
     * @return float Percentage value
     */
    public static function percentage(float $part, float $whole): float {
        if ($whole == 0) return 0;
        return ($part / $whole) * 100;
    }
}
```

## Common Pitfalls

1. **State management** - Static properties maintain state between requests
2. **Testing difficulties** - Hard to mock static calls
3. **Memory leaks** - Static properties aren't garbage collected
4. **Thread safety** - PHP is single-threaded but still be cautious
5. **Overuse** - Can lead to procedural-style code in OOP

## Advanced Techniques

### Static Initialization
```php
class ComplexStatic {
    private static array $data;
    
    public static function init() {
        if (empty(self::$data)) {
            self::$data = expensiveOperation();
        }
    }
    
    public static function getData(): array {
        self::init();
        return self::$data;
    }
}
```

### Static Closures
```php
class EventDispatcher {
    private static array $listeners = [];
    
    public static function addListener(string $event, callable $listener): void {
        self::$listeners[$event][] = $listener;
    }
    
    public static function dispatch(string $event): void {
        foreach (self::$listeners[$event] ?? [] as $listener) {
            $listener();
        }
    }
}

// Using static closure
EventDispatcher::addListener('user.login', static function() {
    // Cannot use $this here
    Logger::log('User logged in');
});
```

## Modern PHP Features

### Static Return Type (PHP 8.0+)
```php
class Factory {
    public static function create(): static {
        return new static();
    }
}
```

### Static Variables in Methods
```php
class RequestTracker {
    public static function track(): int {
        static $count = 0; // Static variable in method
        return ++$count;
    }
}
```

## When to Use Static Members

1. **Utility classes** - Math operations, string formatting
2. **Global configuration** - Application settings
3. **Factory methods** - Alternative constructors
4. **Counters/trackers** - Shared state across instances
5. **Performance-critical code** - Avoid instantiation overhead

## When to Avoid Static Members

1. **When object state is needed** - Use instances instead
2. **Polymorphism scenarios** - Static methods can't be overridden
3. **Testable code** - Hard to mock static calls
4. **Complex object creation** - Use dependency injection
5. **Most business logic** - Prefer instance methods

## Performance Considerations

1. **Memory usage** - Static properties persist through request
2. **Access speed** - Slightly faster than instance methods
3. **Initialization** - Static properties initialized on first use
4. **APCu caching** - Can cache static values between requests

## Static vs Instance Members

| Feature              | Static Members       | Instance Members     |
|----------------------|----------------------|-----------------------|
| Access               | ClassName::$property | $object->property     |
| Memory               | Shared across all instances | Per instance |
| $this reference      | Not available       | Available            |
| Inheritance          | Can be hidden with private | Polymorphism works |
| Use case             | Utility functions, shared state | Object-specific behavior |
| Testing              | Harder to mock      | Easier to mock       |

Remember: Static members are powerful but should be used judiciously. They're best suited for functionality that truly belongs to the class as a whole rather than individual instances. Overuse of static members can lead to code that's difficult to test and maintain, as it often violates object-oriented principles like encapsulation and dependency injection.