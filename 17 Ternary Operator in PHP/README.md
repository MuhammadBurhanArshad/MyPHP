# Ternary Operator in PHP

## Definition

The ternary operator (`?:`) is a shorthand conditional operator that evaluates an expression and returns one of two values based on whether the condition is true or false. It provides a concise way to write simple `if-else` statements.

## Basic Syntax

### Standard Ternary

```php
$result = (condition) ? value_if_true : value_if_false;
```

### With Statements

```php
(condition) ? do_if_true() : do_if_false();
```

### Nested Ternary

```php
$result = (condition1)
    ? value1
    : (condition2)
        ? value2
        : default_value;
```

## Common Examples

### Basic Assignment

```php
$age = 20;
$status = ($age >= 18) ? "Adult" : "Minor";
// $status = "Adult"
```

### Default Value Assignment

```php
$username = $_GET['user'] ?? 'guest'; // Null coalescing (PHP 7+)
$username = isset($_GET['user']) ? $_GET['user'] : 'guest'; // Equivalent
```

### Output Directly

```php
echo ($isLoggedIn) ? "Welcome back" : "Please login";
```

### Simple Validation

```php
$discount = ($orderTotal > 100) ? 10 : 0;
```

## Best Practices

1. **Keep it simple** - Use only for straightforward conditions
2. **Avoid deep nesting** - Hard to read and maintain
3. **Use parentheses** for complex expressions
4. **Format consistently** for readability
5. **Consider clarity** over brevity

```php
// Good practice
$accessLevel = ($user->isAdmin())
    ? 'admin'
    : 'regular';

// Avoid
$value=$a>$b?($c<$d?$e:$f):$g;
```

## Common Use Cases

### Form Field Defaults

```php
$color = isset($_POST['color']) ? $_POST['color'] : '#000000';
```

### Short Conditional Output

```php
<input type="checkbox" <?=($isActive)?'checked':''?>>
```

### Simple Math Operations

```php
$discountedPrice = $isMember ? $price * 0.9 : $price;
```

### Boolean Conversion

```php
$hasItems = (count($cart) > 0) ? true : false;
// Equivalent to:
$hasItems = (bool) count($cart);
```

## Special Cases

### Truthy/Falsy Evaluation

```php
$result = ($var) ? 'Truthy' : 'Falsy'; // Works with PHP's truthy/falsy rules
```

### Null Coalescing (PHP 7+)

```php
$value = $maybeNull ?? $default; // Prefer over ternary for null checks
```

### Return Statements

```php
function getDiscount($user) {
    return $user->isVIP() ? 0.3 : 0.1;
}
```

## Performance Considerations

1. **No significant difference** from if-else in performance
2. **Avoid complex expressions** in conditions
3. **Cache repeated calculations** in variables

```php
// Calculate once
$discountRate = ($total > 1000) ? 0.2 : 0.1;
$finalPrice = $total * (1 - $discountRate);
```

## Common Pitfalls

1. **Incorrect operator precedence**:

   ```php
   $a = true ? 'true' : false ? 't' : 'f'; // Unexpected result
   $a = (true ? 'true' : false) ? 't' : 'f'; // Correct
   ```

2. **Returning different types**:

   ```php
   $result = ($condition) ? 42 : 'default'; // Hard to predict type
   ```

3. **Overusing nesting**:
   ```php
   $value = $a ? $b ? $c : $d : $e ? $f : $g; // Confusing
   ```

## Advanced Patterns

### Chained Ternary (Caution)

```php
$size = ($width > 1000) ? 'large'
       : ($width > 500) ? 'medium'
       : 'small';
```

### In Array Keys

```php
$messages = [
    'success' => $isValid ? 'Valid' : 'Invalid'
];
```

### With Function Calls

```php
function getRole($user) {
    return $user->isAdmin() ? 'admin'
         : ($user->isEditor() ? 'editor' : 'user');
}
```

### Alternative to Simple If-Else

```php
// Instead of:
if ($condition) {
    doSomething();
} else {
    doSomethingElse();
}

// Can be written as:
($condition) ? doSomething() : doSomethingElse();
```

## Comparison with Other Structures

### vs If-Else

- **Ternary**: Best for simple value assignments
- **If-Else**: Better for complex logic or multiple statements

### vs Switch-Case

- **Ternary**: Two possible outcomes
- **Switch**: Multiple possible outcomes

### vs Match (PHP 8+)

- **Ternary**: Simple true/false conditions
- **Match**: Strict value comparisons with cleaner syntax

```php
// PHP 8+ match expression
$result = match($statusCode) {
    200 => 'OK',
    404 => 'Not Found',
    default => 'Unknown'
};
```

Remember: The ternary operator is a powerful tool for writing concise conditional expressions, but can become difficult to read when overused or nested too deeply. Always prioritize code clarity over brevity, especially in team environments. For complex conditions, traditional if-else statements are often more maintainable.
