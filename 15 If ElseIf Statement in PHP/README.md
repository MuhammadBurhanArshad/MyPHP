# If-ElseIf Statements in PHP

## Definition
The `if-elseif` structure allows for multiple conditional checks in sequence. It evaluates conditions from top to bottom and executes the block for the first true condition encountered.

## Basic Syntax

### Standard If-ElseIf
```php
if (condition1) {
    // executes if condition1 is true
} elseif (condition2) {
    // executes if condition1 is false and condition2 is true
} else {
    // executes if all conditions are false
}
```

### Without Final Else
```php
if (condition1) {
    // ...
} elseif (condition2) {
    // ...
} // No else block
```

### Alternative Syntax
```php
if (condition1):
    // ...
elseif (condition2):
    // ...
else:
    // ...
endif;
```

## Common Examples

### Grade Evaluation
```php
$score = 87;
if ($score >= 90) {
    echo "Grade: A";
} elseif ($score >= 80) {
    echo "Grade: B";
} elseif ($score >= 70) {
    echo "Grade: C";
} else {
    echo "Grade: F";
}
```

### User Role Checking
```php
if ($user->isAdmin()) {
    showAdminPanel();
} elseif ($user->isEditor()) {
    showEditorTools();
} elseif ($user->isSubscriber()) {
    showPremiumContent();
} else {
    showBasicContent();
}
```

### Time-Based Greeting
```php
$hour = date('H');
if ($hour < 12) {
    echo "Good morning";
} elseif ($hour < 17) {
    echo "Good afternoon";
} elseif ($hour < 20) {
    echo "Good evening";
} else {
    echo "Good night";
}
```

## Best Practices

1. **Order conditions carefully** - PHP evaluates top to bottom
2. **Use mutually exclusive conditions** when possible
3. **Keep conditions simple** - move complex logic to functions
4. **Include a final else** for default/catch-all cases
5. **Format consistently** for readability

```php
// Good practice
if ($type === 'admin') {
    // ...
} elseif ($type === 'editor') {
    // ...
} else {
    // ...
}

// Avoid
if($type==='admin'){...}elseif($type==='editor'){...}else{...}
```

### Without Braces (Single Statements)
```php
if (condition)
    single_statement_true();
elseif
    single_statement_false();
else
    single_statement_false();
endif
```


## Common Use Cases

### Form Handling
```php
if ($action === 'create') {
    createRecord();
} elseif ($action === 'update') {
    updateRecord();
} elseif ($action === 'delete') {
    deleteRecord();
} else {
    showError('Invalid action');
}
```

### HTTP Method Routing
```php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    showForm();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    processForm();
} else {
    header('HTTP/1.1 405 Method Not Allowed');
}
```

### Price Range Filter
```php
if ($price < 10) {
    $category = 'Budget';
} elseif ($price < 50) {
    $category = 'Standard';
} elseif ($price < 100) {
    $category = 'Premium';
} else {
    $category = 'Luxury';
}
```

## Special Cases

### Non-Mutually Exclusive Conditions
```php
// Order matters!
if ($score >= 50) {
    echo "Passing";
} elseif ($score >= 70) {
    echo "Good"; // Will never be reached
}
```

### Type-Specific Handling
```php
if (is_int($value)) {
    // Integer handling
} elseif (is_float($value)) {
    // Float handling
} elseif (is_string($value)) {
    // String handling
}
```

### Multiple Variables
```php
if ($status === 'active' && $role === 'admin') {
    // ...
} elseif ($status === 'active') {
    // ...
} elseif ($role === 'admin') {
    // ...
}
```

## Performance Considerations

1. **Put most likely conditions first**
2. **Group related conditions** where possible
3. **Consider switch statements** for simple value comparisons
4. **Avoid redundant checks** in subsequent conditions

```php
// Optimized order
if ($user->isPremium()) { // Most common case
    // ...
} elseif ($user->isTrial()) {
    // ...
} else {
    // ...
}
```

## Common Pitfalls

1. **Overlapping conditions**:
   ```php
   if ($value > 0) {
       // ...
   } elseif ($value > 10) { // Never reached if value > 10
       // ...
   }
   ```

2. **Forgetting strict comparison**:
   ```php
   if ($input == '1') { // Matches 1, '1', true
   } elseif ($input === 1) { // Only matches integer 1
   }
   ```

3. **Unreachable code**:
   ```php
   if (true) {
       // ...
   } elseif ($condition) { // Never evaluated
       // ...
   }
   ```

## Advanced Patterns

### Early Returns
```php
function getDiscount($user) {
    if ($user->isVIP()) return 0.3;
    if ($user->isPremium()) return 0.2;
    if ($user->isNew()) return 0.1;
    return 0;
}
```

### State Machines
```php
if ($state === 'START') {
    // ...
} elseif ($state === 'PROCESSING') {
    // ...
} elseif ($state === 'COMPLETE') {
    // ...
}
```

### Range Checks
```php
if ($percentage <= 0) {
    $status = 'Empty';
} elseif ($percentage <= 25) {
    $status = 'Low';
} elseif ($percentage <= 75) {
    $status = 'Medium';
} else {
    $status = 'High';
}
```

Remember: The `if-elseif` structure is ideal when you have multiple mutually exclusive conditions to check. For simple value comparisons against many constants, consider a `switch` statement instead. Always ensure your conditions are properly ordered and non-overlapping unless intentionally designed otherwise.