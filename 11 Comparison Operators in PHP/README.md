# Comparison Operators in PHP

## Definition
Comparison operators are used to compare two values and return a boolean result (`true` or `false`). They are essential for conditional statements and decision-making in PHP.

## Basic Comparison Operators

### Equal (==)
```php
5 == 5;      // true
5 == "5";    // true (type juggling)
"hello" == "hello";  // true
```

### Identical (===)
```php
5 === 5;     // true
5 === "5";   // false (different types)
true === 1;  // false
```

### Not Equal (!= or <>)
```php
5 != 4;      // true
5 != "5";    // false
5 <> 5;      // false (same as !=)
```

### Not Identical (!==)
```php
5 !== "5";   // true
5 !== 5;     // false
false !== 0; // true
```

### Greater Than (>)
```php
10 > 5;      // true
5 > 10;      // false
"b" > "a";   // true (alphabetical comparison)
```

### Less Than (<)
```php
5 < 10;      // true
10 < 5;      // false
"a" < "b";   // true
```

### Greater Than or Equal (>=)
```php
10 >= 10;    // true
10 >= 5;     // true
5 >= 10;     // false
```

### Less Than or Equal (<=)
```php
5 <= 5;      // true
5 <= 10;     // true
10 <= 5;     // false
```

## Special Comparison Operators

### Spaceship Operator (<=>) (PHP 7+)
Returns -1, 0, or 1 when comparing values:
```php
5 <=> 10;    // -1 (left is less than right)
10 <=> 5;    // 1 (left is greater than right)
5 <=> 5;     // 0 (both are equal)
```

### Null Coalescing Operator (??) (PHP 7+)
```php
$username = $_GET['user'] ?? 'guest';  // if left is null, use right
```

## Type Comparison Functions

### is_int(), is_string(), etc.
```php
is_int(5);       // true
is_string("5");  // true
is_int("5");     // false
```

## Best Practices

1. Use strict comparison (=== and !==) to avoid type juggling surprises
2. Be explicit with type comparisons when needed
3. For floating point comparisons, consider a small delta for equality
4. Use parentheses to clarify complex comparisons

```php
// Good practice examples
if ($age === 18) { /* ... */ }
if ($name !== '') { /* ... */ }

// Floating point comparison
$epsilon = 0.00001;
if (abs($a - $b) < $epsilon) { /* consider equal */ }

// Avoid
if ($a == true) { /* unclear what types are being compared */ }
```

## Common Use Cases

### Conditional statements
```php
if ($age >= 18) {
    echo "Adult";
} else {
    echo "Minor";
}
```

### Sorting and ordering
```php
usort($array, function($a, $b) {
    return $a['score'] <=> $b['score'];
});
```

### Form validation
```php
if ($email != "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // valid email
}
```

### Loop conditions
```php
while ($counter <= 10) {
    // ... code ...
    $counter++;
}
```

## Special Cases

### String comparison
```php
"10" == "10";     // true
"10" == "1e1";    // true (1e1 is 10 in scientific notation)
"10" === "1e1";   // false
```

### Boolean comparison
```php
true == 1;        // true
true === 1;       // false
false == 0;       // true
false === 0;      // false
```

### Array comparison
```php
[1, 2] == [1, 2];    // true
[1, 2] === [1, 2];   // true (same order and types)
[1, 2] == [2, 1];    // false
[1, 2] == ['1', '2']; // true
[1, 2] === ['1', '2']; // false
```

Remember: Comparison operators are fundamental for controlling program flow in PHP. Understanding the difference between loose (==) and strict (===) comparison is crucial to avoid unexpected behavior. Always choose the operator that best expresses your intention.