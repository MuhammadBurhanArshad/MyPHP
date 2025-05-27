# If-Else Statements in PHP

## Definition
The `if-else` statement executes one block of code if a specified condition is true, and another block if the condition is false. It's the most basic form of conditional branching in PHP.

## Basic Syntax

### Standard If-Else
```php
if (condition) {
    // code to execute if condition is true
} else {
    // code to execute if condition is false
}
```

### Without Braces (Single Statements)
```php
if (condition)
    single_statement_true();
else
    single_statement_false();
```

### Alternative Syntax
```php
if (condition):
    // true code
else:
    // false code
endif;
```

## Common Examples

### Simple Boolean Check
```php
$isRaining = true;
if ($isRaining) {
    echo "Take an umbrella";
} else {
    echo "Enjoy the sunshine";
}
```

### Comparison Operation
```php
$temperature = 25;
if ($temperature > 30) {
    echo "It's hot outside";
} else {
    echo "The weather is pleasant";
}
```

### Form Validation
```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form
} else {
    // Show form
}
```

### Null Check
```php
if ($user !== null) {
    echo "Welcome, " . $user->name;
} else {
    echo "Please log in";
}
```

## Best Practices

1. **Always use curly braces** even for single statements
2. **Keep conditions simple** - move complex logic to functions
3. **Put the more likely condition first** for better performance
4. **Format consistently** for readability
5. **Avoid deep nesting** - consider early returns

```php
// Good practice
if ($isValid) {
    processData();
} else {
    showError();
}

// Avoid
if($isValid){processData();}else{showError();}
```

## Common Use Cases

### Authentication Flow
```php
if (password_verify($input, $storedHash)) {
    loginUser();
} else {
    incrementFailedAttempts();
}
```

### Feature Toggle
```php
if ($newUiEnabled) {
    renderNewInterface();
} else {
    renderLegacyInterface();
}
```

### Input Processing
```php
if (isset($_GET['search'])) {
    showSearchResults();
} else {
    showDefaultContent();
}
```

### Age Verification
```php
if ($age >= 18) {
    echo "Access granted";
} else {
    echo "You must be 18+ to continue";
}
```

## Special Cases

### Empty Checks
```php
if (!empty($array)) {
    // Array has elements
} else {
    // Array is empty
}
```

### Multiple Conditions
```php
if ($a > $b && $c < $d) {
    // Complex condition true
} else {
    // Complex condition false
}
```

### Assignment in Condition
```php
if ($result = getData()) {
    // Use $result
} else {
    // Handle failure
}
```

## Nested If-Else

### Basic Nesting
```php
if ($condition1) {
    if ($condition2) {
        // Both true
    } else {
        // Only condition1 true
    }
} else {
    // condition1 false
}
```

### Flattened Alternative
```php
if ($condition1 && $condition2) {
    // Both true
} elseif ($condition1) {
    // Only condition1 true
} else {
    // condition1 false
}
```

## Performance Considerations

1. **Order conditions** by likelihood (most probable first)
2. **Avoid expensive operations** in conditions
3. **Use strict comparisons** (===) when possible
4. **Consider switch** for multiple discrete values

```php
// Faster when $status is usually 'active'
if ($status === 'active') {
    // ...
} else {
    // ...
}
```

## Common Pitfalls

1. **Assignment vs comparison**:
   ```php
   if ($x = 5) {}  // Always true (assignment)
   if ($x == 5) {} // Comparison
   ```

2. **Truthy/falsy confusion**:
   ```php
   if ($value) {}   // Falsy for 0, "", null, false, []
   if ($value !== null) {} // More precise
   ```

3. **Operator precedence**:
   ```php
   if ($a || $b && $c) {}  // && evaluated first
   if (($a || $b) && $c) {} // Different meaning
   ```

## Advanced Patterns

### Early Return
```php
function process($input) {
    if (!$input) {
        return false; // Early exit
    }
    // Continue processing
    return $result;
}
```

### Ternary Alternative
```php
$message = $isValid ? "Valid" : "Invalid";
```

### Null Coalesce
```php
$value = $maybeNull ?? $default;
```

Remember: The `if-else` statement is your fundamental tool for controlling program flow. Choose the simplest structure that clearly expresses your logic, and consider alternative approaches (like early returns or polymorphism) when dealing with complex conditional logic.