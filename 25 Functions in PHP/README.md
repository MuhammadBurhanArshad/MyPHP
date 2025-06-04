# Functions in PHP

## Definition

A function in PHP is a reusable block of code that performs a specific task. Functions help organize code into logical units, reduce repetition, and make programs easier to maintain. PHP supports both built-in and user-defined functions.

## Basic Syntax

### Standard Function Definition

```php
function functionName($parameter1, $parameter2, ...) {
    // code to execute
    return $result; // optional
}
```

### Function Call

```php
$result = functionName($argument1, $argument2);
```

## Key Features

1. **Parameterized** - Can accept input values
2. **Return values** - Can optionally return data
3. **Scope** - Variables inside functions are local by default
4. **Reusability** - Can be called multiple times
5. **Modularity** - Helps organize code logically

## Common Examples

### Basic Function

```php
function greet($name) {
    return "Hello, " . $name . "!";
}

echo greet("Alice"); // Output: Hello, Alice!
```

### Function with Default Parameter

```php
function sayHello($name = "Guest") {
    return "Hello, $name!";
}

echo sayHello(); // Output: Hello, Guest!
echo sayHello("Bob"); // Output: Hello, Bob!
```

### Function Returning Multiple Values

```php
function calculate($a, $b) {
    return [
        'sum' => $a + $b,
        'difference' => $a - $b,
        'product' => $a * $b,
        'quotient' => $a / $b
    ];
}

$results = calculate(10, 5);
echo $results['sum']; // Output: 15
```

### Recursive Function

```php
function factorial($n) {
    if ($n <= 1) {
        return 1;
    }
    return $n * factorial($n - 1);
}

echo factorial(5); // Output: 120
```

## Best Practices

1. **Descriptive names** - Use verbs or verb phrases
2. **Single responsibility** - Each function should do one thing
3. **Limit parameters** - Ideally 3 or fewer
4. **Type declarations** - For parameters and return values
5. **Documentation** - Use PHPDoc comments

```php
/**
 * Calculates the area of a rectangle
 * @param float $length The length of the rectangle
 * @param float $width The width of the rectangle
 * @return float The calculated area
 */
function calculateRectangleArea(float $length, float $width): float {
    return $length * $width;
}
```

## Common Use Cases

### Form Validation

```php
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

if (validateEmail($_POST['email'])) {
    // Process valid email
}
```

### Database Operations

```php
function getUserById($id, PDO $db) {
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$user = getUserById(42, $pdoConnection);
```

### String Manipulation

```php
function slugify($string) {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    return preg_replace('/-+/', '-', $slug);
}

echo slugify("Hello World!"); // Output: hello-world
```

### File Processing

```php
function countLinesInFile($filename) {
    if (!file_exists($filename)) {
        throw new Exception("File not found");
    }
    $file = fopen($filename, 'r');
    $count = 0;
    while (!feof($file)) {
        fgets($file);
        $count++;
    }
    fclose($file);
    return $count;
}
```

## Advanced Function Features

### Variable Functions

```php
function sayHi() { echo "Hi!"; }
function sayHello() { echo "Hello!"; }

$functionToCall = "sayHello";
$functionToCall(); // Output: Hello!
```

### Anonymous Functions (Closures)

```php
$greet = function($name) {
    return "Hello, $name!";
};

echo $greet("Alice"); // Output: Hello, Alice!
```

### Arrow Functions (PHP 7.4+)

```php
$add = fn($a, $b) => $a + $b;
echo $add(2, 3); // Output: 5
```

### Variadic Functions

```php
function sum(...$numbers) {
    return array_sum($numbers);
}

echo sum(1, 2, 3, 4); // Output: 10
```

## Type Declarations (PHP 7+)

### Scalar Type Hints

```php
function add(int $a, int $b): int {
    return $a + $b;
}
```

### Return Type Declarations

```php
function divide(float $a, float $b): float {
    return $a / $b;
}
```

### Nullable Types

```php
function findUser(?int $id): ?array {
    if ($id === null) return null;
    // lookup user
    return $user ?? null;
}
```

## Common Pitfalls

1. **Global variables** - Avoid using `global` keyword
2. **Side effects** - Functions should ideally not modify external state
3. **Too many parameters** - Consider using an associative array
4. **No return value** - Be clear about whether function returns something
5. **Overly complex** - Break large functions into smaller ones

```php
// Bad practice
function processUserData() {
    global $db, $logger;
    // 200 lines of code
    // Modifies multiple external variables
}

// Better
function processUser(User $user, PDO $db, Logger $logger): Result {
    // Clear, focused functionality
}
```

## Performance Considerations

1. **Function calls have overhead** - But modern PHP optimizes this well
2. **Avoid deep recursion** - PHP has recursion depth limits
3. **Reuse expensive operations** - Cache results when possible
4. **Consider opcache** - For production environments

```php
// With caching
function getExpensiveData($id) {
    static $cache = [];
    if (!isset($cache[$id])) {
        $cache[$id] = calculateExpensiveData($id);
    }
    return $cache[$id];
}
```

## Special Cases

### Generator Functions

```php
function xrange($start, $limit, $step = 1) {
    for ($i = $start; $i <= $limit; $i += $step) {
        yield $i;
    }
}

foreach (xrange(1, 10) as $number) {
    echo "$number ";
}
```

### Callback Functions

```php
function array_map_custom(array $array, callable $callback) {
    $result = [];
    foreach ($array as $key => $value) {
        $result[$key] = $callback($value);
    }
    return $result;
}

$numbers = [1, 2, 3];
$squared = array_map_custom($numbers, fn($n) => $n * $n);
```

### Method Chaining

```php
class Calculator {
    private $value;
    
    public function __construct($initialValue) {
        $this->value = $initialValue;
    }
    
    public function add($n): self {
        $this->value += $n;
        return $this;
    }
    
    public function multiply($n): self {
        $this->value *= $n;
        return $this;
    }
    
    public function getValue(): float {
        return $this->value;
    }
}

$result = (new Calculator(10))
    ->add(5)
    ->multiply(2)
    ->getValue(); // 30
```

## Comparison with Other Constructs

### vs Include/Require

- **Functions**: Encapsulate reusable logic
- **Includes**: Insert code from other files

### vs Classes/Methods

- **Functions**: Global scope, procedural programming
- **Methods**: Belong to classes, object-oriented programming

### vs Language Constructs

- **Functions**: User-defined, can return values
- **Constructs**: Built-in (echo, isset, etc.), often faster

Remember: Functions are fundamental building blocks in PHP programming. They promote code reuse, improve readability, and help manage complexity. Well-designed functions with clear purposes, proper documentation, and thoughtful parameter design will make your PHP code more maintainable and reliable. Always consider whether a piece of logic should be a function when you find yourself writing similar code in multiple places.