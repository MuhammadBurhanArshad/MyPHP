# PHP OOP Type Hinting: Comprehensive Guide

## Introduction to Type Hinting

Type hinting (or type declarations) in PHP allows you to specify the expected data type of arguments, return values, and properties. This improves code reliability and IDE support.

## Basic Type Hinting

### Scalar Type Hints (PHP 7.0+)
```php
function addNumbers(int $a, int $b): int {
    return $a + $b;
}

echo addNumbers(5, 3); // Works
// echo addNumbers(5, "3"); // Error in strict mode
```

### Class Type Hinting
```php
class User {}
class Admin extends User {}

function registerUser(User $user): void {
    // Accepts User and any subclass
}

$admin = new Admin();
registerUser($admin); // Works
```

## Advanced Type Hinting

### Union Types (PHP 8.0+)
```php
function processInput(int|string $input): void {
    if (is_int($input)) {
        echo "Processing number: $input";
    } else {
        echo "Processing string: $input";
    }
}

processInput(42);    // Works
processInput("test"); // Works
```

### Nullable Types (PHP 7.1+)
```php
function findUser(?int $id): ?User {
    return $id ? UserRepository::find($id) : null;
}

$user = findUser(123);  // User or null
$user = findUser(null); // null
```

## Property Type Hinting (PHP 7.4+)

### Typed Properties
```php
class Product {
    public int $id;
    public string $name;
    public float $price;
    private ?DateTime $createdAt;
    
    public function __construct(int $id, string $name, float $price) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->createdAt = new DateTime();
    }
}
```

### Property Promotion (PHP 8.0+)
```php
class Order {
    public function __construct(
        public int $id,
        public string $customer,
        protected float $total,
        private ?DateTime $createdAt = null
    ) {
        $this->createdAt ??= new DateTime();
    }
}
```

## Return Type Hinting

### Basic Return Types
```php
function getUserName(User $user): string {
    return $user->name;
}
```

### Void Return Type
```php
function logMessage(string $message): void {
    file_put_contents('app.log', $message);
    // No return needed
}
```

### Never Return Type (PHP 8.1+)
```php
function redirect(string $url): never {
    header("Location: $url");
    exit; // Must terminate script
}
```

## Interface and Trait Type Hinting

### Interface Type Hinting
```php
interface Logger {
    public function log(string $message): void;
}

function setLogger(Logger $logger): void {
    $this->logger = $logger;
}
```

### Trait Type Hinting
```php
trait Timestampable {
    protected DateTimeInterface $createdAt;
    
    public function setCreatedAt(DateTimeInterface $date): void {
        $this->createdAt = $date;
    }
}
```

## Special Type Hinting Cases

### Callable Type
```php
function processWithCallback(array $data, callable $callback): array {
    return array_map($callback, $data);
}

processWithCallback([1, 2, 3], fn($n) => $n * 2);
```

### Iterable Type
```php
function collectItems(iterable $items): array {
    return is_array($items) ? $items : iterator_to_array($items);
}
```

### Mixed Type (PHP 8.0+)
```php
function debug(mixed $data): void {
    var_dump($data);
}
```

## Strict Typing Mode

### Enabling Strict Types
```php
declare(strict_types=1);

function divide(int $a, int $b): float {
    return $a / $b;
}

divide(10, 3);   // Works
divide(10, "3"); // TypeError in strict mode
```

## Type Hinting Best Practices

1. **Be specific** - Use the most precise type possible
2. **Use interfaces** - Type hint against interfaces rather than concrete classes
3. **Document complex types** - Use PHPDoc for additional type information
4. **Consider nullability** - Use `?type` when values might be null
5. **Adopt gradually** - Add types progressively to legacy code

```php
/**
 * Processes a collection of items
 * @param array<int, string|int> $items Array of strings or integers
 * @param callable(string|int): string $transformer Callback that returns string
 * @return array<int, string> Transformed array of strings
 */
function processItems(array $items, callable $transformer): array {
    return array_map($transformer, $items);
}
```

## Common Type Hinting Patterns

### Factory Pattern
```php
interface ProductFactory {
    public function createProduct(): Product;
}

class OrderProcessor {
    public function __construct(private ProductFactory $factory) {}
}
```

### Strategy Pattern
```php
interface PaymentStrategy {
    public function pay(float $amount): bool;
}

class PaymentProcessor {
    public function __construct(private PaymentStrategy $strategy) {}
}
```

### Repository Pattern
```php
interface UserRepository {
    public function find(int $id): ?User;
    public function save(User $user): void;
}

class UserService {
    public function __construct(private UserRepository $repository) {}
}
```

## Type Hinting with Generics (via PHPDoc)

While PHP doesn't natively support generics, you can document them:

```php
/**
 * @template T
 */
interface Collection {
    /**
     * @param T $item
     */
    public function add($item): void;
    
    /**
     * @return T
     */
    public function get(int $index);
}

/** @var Collection<User> $users */
$users = new UserCollection();
```

## Runtime Type Checking

When you need to verify types at runtime:

```php
function process($value): void {
    if (!is_int($value) && !is_float($value)) {
        throw new InvalidArgumentException('Expected number');
    }
    // Process value
}
```

## Type Hinting Evolution in PHP

| Version | Major Type Hinting Features |
|---------|-----------------------------|
| PHP 5.0 | Class/interface type hints |
| PHP 5.1 | Array type hints |
| PHP 5.4 | Callable type hints |
| PHP 7.0 | Scalar type hints, return types |
| PHP 7.1 | Nullable types |
| PHP 7.2 | object type hint |
| PHP 7.4 | Property type hints |
| PHP 8.0 | Union types, mixed type |
| PHP 8.1 | Intersection types, never type |
| PHP 8.2 | true/false/null standalone types |

Remember that proper type hinting makes your code:
- More predictable
- Easier to debug
- Better documented
- More IDE-friendly
- Less prone to runtime errors

Always balance strict typing with practical needs, especially when working with dynamic data or legacy systems.