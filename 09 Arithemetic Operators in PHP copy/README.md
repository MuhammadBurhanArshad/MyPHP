# Arithmetic Operators in PHP

## Definition
Arithmetic operators are used to perform mathematical operations on numeric values in PHP. They work with integers, floats, and even strings that can be converted to numbers.

## Basic Arithmetic Operators

### Addition (+)
```php
$sum = 5 + 3;       // 8
$total = $a + $b;   // Adds values of $a and $b
```

### Subtraction (-)
```php
$difference = 10 - 4;  // 6
$remaining = $x - $y;  // Subtracts $y from $x
```

### Multiplication (*)
```php
$product = 6 * 7;     // 42
$area = $length * $width;
```

### Division (/)
```php
$quotient = 15 / 3;   // 5
$average = $total / $count;
```

### Modulus (%)
```php
$remainder = 10 % 3;  // 1 (remainder of division)
$isEven = ($number % 2) == 0;
```

### Exponentiation (**) (PHP 5.6+)
```php
$power = 2 ** 3;      // 8 (2 to the power of 3)
```

## Increment/Decrement Operators

### Pre-increment
```php
++$counter;  // Increments $counter by 1 before using its value
```

### Post-increment
```php
$counter++;  // Uses current value then increments by 1
```

### Pre-decrement
```php
--$count;    // Decrements $count by 1 before using its value
```

### Post-decrement
```php
$count--;    // Uses current value then decrements by 1
```

## Operator Precedence
1. Parentheses `()` (highest precedence)
2. Exponentiation `**`
3. Multiplication `*`, Division `/`, Modulus `%`
4. Addition `+`, Subtraction `-`

```php
$result = 2 + 3 * 4;    // 14 (not 20)
$result = (2 + 3) * 4;  // 20
```

## Type Conversion in Operations
PHP automatically converts types when performing arithmetic:
```php
$sum = "5" + 2;    // 7 (integer)
$concat = "5" . 2; // "52" (string concatenation)
```

## Special Cases
```php
$result = 10 / 0;   // Warning: Division by zero
$result = "abc" * 3; // 0 (non-numeric string becomes 0)
```

## Best Practices
1. Use parentheses to clarify complex expressions
2. Be explicit with type conversion when needed
3. Handle division by zero cases
4. Use spaces around operators for readability

```php
// Good practice examples
$total = ($price * $quantity) + ($tax * $price);
$average = ($sum !== 0) ? $sum / $count : 0;
```

## Practical Examples

### Calculating percentages
```php
$percentage = ($part / $whole) * 100;
```

### Rounding numbers
```php
$rounded = round($number, 2);  // Rounds to 2 decimal places
```

### Number formatting
```php
$formatted = number_format($amount, 2);  // 1,234.56
```

Remember: Arithmetic operators form the foundation of mathematical operations in PHP. Understanding their behavior with different data types and precedence rules is essential for writing correct calculations in your applications.