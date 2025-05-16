# Data Types in PHP

## Definition
PHP is a loosely typed language that supports several built-in data types to store different kinds of values. The type of a value is determined at runtime and can change during script execution.

## Scalar Types (Single Value)

### String
```php
$text = "Hello World";  // Sequence of characters
$char = 'A';           // Single character
```

### Integer
```php
$count = 42;          // Whole number
$negative = -100;     // Can be negative
$hex = 0x1A;          // Hexadecimal notation
```

### Float (Floating-point number)
```php
$price = 19.99;       // Decimal number
$scientific = 1.2e3;  // Scientific notation (1200)
```

### Boolean
```php
$isActive = true;     // Can be true or false
$isEmpty = false;
```

## Compound Types

### Array
```php
$colors = ["red", "green", "blue"];  // Indexed array
$person = [                          // Associative array
    "name" => "John",
    "age" => 30
];
```

### Object
```php
class User {}
$user = new User();  // Instance of a class
```

### Callable
```php
$callback = function() { return "Hello"; };  // Anonymous function
```

## Special Types

### NULL
```php
$nothing = null;  // Represents no value
```

### Resource
```php
$file = fopen("example.txt", "r");  // External resource handle
```

## Type Checking and Conversion

### Type Checking Functions
```php
is_string($value);  // Returns true if string
is_int($value);     // Returns true if integer
is_array($value);   // Returns true if array
is_object($value);  // Returns true if object
is_null($value);    // Returns true if null

var_dump($value);   // Return the datatype and value
```

### Type Conversion
```php
$number = (int) "123";     // Explicit casting to integer
$string = strval(123);     // Convert to string
$array = (array) $object;  // Convert object to array
```

## Type Juggling
PHP automatically converts types when needed:
```php
$sum = "5" + 2;    // Result is 7 (integer)
$concat = "5" . 2; // Result is "52" (string)
```

## Best Practices
- Use strict comparison (`===`) when type matters
- Explicitly cast variables when type is important
- Initialize variables with appropriate types
- Use type declarations in functions (PHP 7+)
```php
function calculate(int $a, float $b): float {
    return $a + $b;
}
```

Understanding PHP data types is essential for writing robust and predictable code. The flexible type system allows for dynamic programming while still maintaining type safety when needed.
