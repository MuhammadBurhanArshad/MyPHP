# Functions with Return in PHP

## Definition
Return values allow functions to send data back to the code that called them. A function can return any type of value, including arrays and objects, or even no value at all (void). The return statement immediately ends the function's execution.

## Basic Syntax

### Simple Return
```php
function functionName() {
    // code
    return $value;
}
```

### No Return (Void)
```php
function logMessage($message) {
    echo $message;
    // implicit return null
}
```

### Multiple Returns
```php
function checkNumber($num) {
    if ($num > 0) {
        return "Positive";
    } elseif ($num < 0) {
        return "Negative";
    }
    return "Zero";
}
```

## Return Types

### Type-Hinted Returns (PHP 7+)
```php
function add(float $a, float $b): float {
    return $a + $b;
}
```

### Void Return Type
```php
function displayWelcome(): void {
    echo "Welcome!";
    // no return needed
}
```

### Nullable Return Type
```php
function findUser(int $id): ?string {
    // returns string or null
    return $users[$id] ?? null;
}
```

### Mixed Return Type (PHP 8+)
```php
function flexibleFunction($input): mixed {
    // can return any type
    return is_numeric($input) ? (int)$input : $input;
}
```

## Returning Multiple Values

### Using Arrays
```php
function getDimensions() {
    return ['width' => 100, 'height' => 200];
}
$dim = getDimensions();
echo $dim['width']; // 100
```

### Using Objects
```php
function createUser() {
    return (object)['name' => 'Alice', 'age' => 30];
}
```

### Using List
```php
function getCoordinates() {
    return [34.5, 58.2];
}
list($lat, $long) = getCoordinates();
```

## Advanced Return Techniques

### Returning References
```php
function &getReference() {
    static $value = 0;
    return $value;
}
$ref = &getReference();
$ref++; // Modifies the static $value
```

### Generator Functions (yield)
```php
function numberGenerator($max) {
    for ($i = 1; $i <= $max; $i++) {
        yield $i;
    }
}
foreach (numberGenerator(5) as $number) {
    echo $number; // 1, 2, 3, 4, 5
}
```

### Returning Callables
```php
function getMultiplier($factor) {
    return function($num) use ($factor) {
        return $num * $factor;
    };
}
$double = getMultiplier(2);
echo $double(5); // 10
```

## Common Use Cases

### Data Processing
```php
function calculateAverage(array $numbers): float {
    return array_sum($numbers) / count($numbers);
}
```

### Validation
```php
function isValidEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
```

### Configuration
```php
function getConfig(): array {
    return [
        'debug' => true,
        'db_host' => 'localhost',
        'cache_ttl' => 3600
    ];
}
```

### Factory Pattern
```php
function createLogger(string $type): LoggerInterface {
    return match($type) {
        'file' => new FileLogger(),
        'database' => new DatabaseLogger(),
        default => new NullLogger()
    };
}
```

## Best Practices

1. **Single responsibility** - A function should return one type of value
2. **Consistent return types** - Avoid mixed returns unless necessary
3. **Document return values** - With PHPDoc comments
4. **Fail fast** - Return early if invalid conditions
5. **Avoid side effects** - Functions should primarily return values

```php
/**
 * Calculates the area of a rectangle
 * @param float $length The length of the rectangle
 * @param float $width The width of the rectangle
 * @return float The calculated area
 * @throws InvalidArgumentException If parameters are not positive
 */
function rectangleArea(float $length, float $width): float {
    if ($length <= 0 || $width <= 0) {
        throw new InvalidArgumentException('Dimensions must be positive');
    }
    return $length * $width;
}
```

## Common Pitfalls

1. **Missing return** - Function returns null unexpectedly
   ```php
   function getStatus() {
       // forgot return statement
       $status = 'active';
   }
   ```

2. **Return after return** - Unreachable code
   ```php
   function checkValue($val) {
       return $val > 0;
       echo "Checked value"; // Never executed
   }
   ```

3. **Inconsistent types**
   ```php
   function process($input) {
       if (is_numeric($input)) {
           return (int)$input;
       }
       return $input; // Could be any type
   }
   ```

4. **Returning references to local variables**
   ```php
   function &getReference() {
       $local = 42;
       return $local; // Dangerous!
   }
   ```

## Performance Considerations

1. **Returning large arrays** - Consider generators for memory efficiency
2. **Type checking** - Return type hints add minimal overhead
3. **Multiple returns** - No significant performance impact
4. **Return vs echo** - Returning is generally more flexible

```php
// More flexible than echo
function generateHtml(): string {
    $html = '<div>';
    // ... complex generation
    $html .= '</div>';
    return $html;
}

// Can be cached or processed further
$html = generateHtml();
```

## Special Cases

### Returning from Include Files
```php
// config.php
return [
    'db_host' => 'localhost',
    'db_user' => 'root'
];

// main.php
$config = include 'config.php';
```

### Returning in Constructors
```php
class MyClass {
    public function __construct() {
        // Constructors cannot return values
    }
}
```

### Returning from __toString
```php
class User {
    public function __toString(): string {
        return $this->name;
    }
}
```

## Comparison with Other Approaches

### vs Output Parameters
- **Return values**: Cleaner, more functional style
- **Output parameters**: Using references can be less clear

### vs Global Variables
- **Return values**: Explicit data flow
- **Globals**: Implicit, harder to track

### vs Echo/Direct Output
- **Return values**: More flexible (can be stored, processed)
- **Echo**: Immediate output, less reusable

Remember: Well-designed return values make your functions more composable and testable. Always consider how the returned value will be used by the calling code, and use return type hints to make your function contracts clear.