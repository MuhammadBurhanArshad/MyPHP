# Functions with Parameters in PHP

## Definition
Parameters (also called arguments) allow functions to accept input values that can be used within the function's code block. Parameters make functions more flexible and reusable by allowing them to work with different values each time they're called.

## Basic Syntax

### Single Parameter
```php
function functionName($parameter) {
    // code that uses $parameter
}
```

### Multiple Parameters
```php
function functionName($param1, $param2, $param3) {
    // code that uses all parameters
}
```

## Parameter Types

### Positional Parameters
```php
function greet($name, $timeOfDay) {
    return "Good $timeOfDay, $name!";
}
echo greet("Alice", "morning"); // Output: Good morning, Alice!
```

### Default Parameters
```php
function greet($name, $timeOfDay = "day") {
    return "Good $timeOfDay, $name!";
}
echo greet("Bob"); // Output: Good day, Bob!
```

### Type-Hinted Parameters (PHP 7+)
```php
function addNumbers(int $a, int $b): int {
    return $a + $b;
}
echo addNumbers(5, 3); // Output: 8
```

### Variadic Parameters (PHP 5.6+)
```php
function sum(...$numbers) {
    return array_sum($numbers);
}
echo sum(1, 2, 3, 4); // Output: 10
```

## Passing Arguments

### By Value (default)
```php
function increment($num) {
    $num++;
    return $num;
}
$value = 5;
echo increment($value); // Output: 6
echo $value; // Output: 5 (unchanged)
```

### By Reference
```php
function increment(&$num) {
    $num++;
}
$value = 5;
increment($value);
echo $value; // Output: 6 (changed)
```

## Advanced Parameter Techniques

### Named Arguments (PHP 8+)
```php
function createPerson($name, $age, $country = "Unknown") {
    return "$name, $age years old from $country";
}

echo createPerson(age: 30, name: "Alice"); // Output: Alice, 30 years old from Unknown
```

### Mixed Parameter Types
```php
function displayInfo(string $name, int $age, bool $isStudent = false) {
    $status = $isStudent ? "a student" : "not a student";
    return "$name is $age years old and is $status";
}
```

### Callable Parameters
```php
function processNumbers(array $numbers, callable $processor) {
    return array_map($processor, $numbers);
}

$squared = processNumbers([1, 2, 3], function($n) { return $n * $n; });
// $squared = [1, 4, 9]
```

## Common Use Cases

### Form Validation
```php
function validateEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
```

### Configuration Builder
```php
function buildConfig(array $defaults, array $overrides = []) {
    return array_merge($defaults, $overrides);
}
```

### Database Query
```php
function getUser(PDO $db, int $id, bool $includeInactive = false) {
    $sql = "SELECT * FROM users WHERE id = ?";
    if (!$includeInactive) {
        $sql .= " AND active = 1";
    }
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}
```

### Math Operations
```php
function calculateCircle(float $radius, bool $includeArea = true, bool $includeCircumference = true) {
    $result = [];
    if ($includeArea) {
        $result['area'] = pi() * pow($radius, 2);
    }
    if ($includeCircumference) {
        $result['circumference'] = 2 * pi() * $radius;
    }
    return $result;
}
```

## Best Practices

1. **Use descriptive parameter names** - `$customerId` instead of `$id`
2. **Order parameters logically** - Required before optional
3. **Limit the number of parameters** - Consider using arrays or objects if many
4. **Use type declarations** - For better code reliability
5. **Document parameters** - With PHPDoc comments

```php
/**
 * Calculates the total price with tax
 * @param float $subtotal The pre-tax amount
 * @param float $taxRate The tax rate as a decimal (e.g., 0.08 for 8%)
 * @param bool $round Whether to round the result
 * @return float The total amount with tax
 */
function calculateTotal(float $subtotal, float $taxRate, bool $round = true): float {
    $total = $subtotal * (1 + $taxRate);
    return $round ? round($total, 2) : $total;
}
```

## Common Pitfalls

1. **Modifying parameters unexpectedly**
   ```php
   function processArray($items) {
       // Accidentally modifies input array
       foreach ($items as &$item) {
           $item = strtoupper($item);
       }
       // ...
   }
   ```

2. **Incorrect parameter order**
   ```php
   function createDate($day, $month, $year) { /* ... */ }
   createDate(12, 2023, 5); // Wrong order
   ```

3. **Assuming parameter existence**
   ```php
   function fullName($first, $last) {
       return "$first $last"; // Error if called with one argument
   }
   ```

4. **Overusing reference parameters**
   ```php
   function &getReference() {
       $value = 42;
       return $value; // Returns reference to local variable - bad!
   }
   ```

## Performance Considerations

1. **Parameter passing is generally fast** - Don't over-optimize
2. **Large objects** - Pass by reference if modification needed
3. **Type checking** - Type hints add minimal overhead
4. **Default parameters** - Evaluated at call time

```php
// Efficient with large arrays
function processLargeArray(array &$data) {
    // Modify array directly
}

// Better than copying large array
$bigData = [...]; // Large dataset
processLargeArray($bigData);
```

## Special Cases

### Dynamic Parameter Handling
```php
function dynamicParams(...$args) {
    foreach ($args as $i => $arg) {
        echo "Argument $i: " . gettype($arg) . "\n";
    }
}
```

### Parameter Unpacking
```php
function addThreeNumbers($a, $b, $c) {
    return $a + $b + $c;
}

$numbers = [1, 2, 3];
echo addThreeNumbers(...$numbers); // Output: 6
```

### Nullable Parameters
```php
function searchRecords(?string $query, int $limit = 10) {
    if ($query === null) {
        return getRecentRecords($limit);
    }
    return findRecords($query, $limit);
}
```

## Comparison with Other Approaches

### vs Global Variables
- **Parameters**: Explicit, controlled input
- **Globals**: Implicit, harder to track

### vs Class Properties
- **Parameters**: For function-specific input
- **Properties**: For object state

### vs Superglobals
- **Parameters**: Clean, testable interface
- **Superglobals**: Direct access to $_GET, $_POST etc.

Remember: Well-designed parameters make your functions more flexible and reusable while maintaining clarity. Always consider the needs of the function's caller when designing your parameter list, and use type hints and default values to make your functions both robust and convenient to use.