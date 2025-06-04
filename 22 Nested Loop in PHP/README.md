# Nested Loops in PHP

## Definition

Nested loops are loops within loops - where one loop (the "inner" loop) is completely contained inside the body of another loop (the "outer" loop). This structure allows for multi-dimensional iteration, commonly used for working with matrices, multi-level data structures, or complex algorithmic patterns.

## Basic Syntax

### Standard Nested For Loop

```php
for ($i = 0; $i < outer_limit; $i++) {
    // Outer loop code
    
    for ($j = 0; $j < inner_limit; $j++) {
        // Inner loop code
    }
    
    // More outer loop code
}
```

### Mixed Loop Types

```php
while (outer_condition) {
    // Outer loop
    
    foreach ($array as $value) {
        // Inner loop
    }
}
```

## Key Characteristics

1. **Hierarchical execution** - Outer loop runs once per complete inner loop cycle
2. **Multi-dimensional control** - Each loop level can have its own counter/condition
3. **Complexity grows exponentially** - Be mindful of performance with deep nesting
4. **Flexible combinations** - Can mix different loop types (for, while, foreach)

## Common Examples

### Multiplication Table

```php
for ($i = 1; $i <= 10; $i++) {
    for ($j = 1; $j <= 10; $j++) {
        echo str_pad($i * $j, 4);
    }
    echo "\n";
}
```

### 2D Array Processing

```php
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

for ($row = 0; $row < count($matrix); $row++) {
    for ($col = 0; $col < count($matrix[$row]); $col++) {
        echo $matrix[$row][$col] . " ";
    }
    echo "\n";
}
```

### Pyramid Pattern

```php
$levels = 5;
for ($i = 1; $i <= $levels; $i++) {
    for ($j = 1; $j <= $levels - $i; $j++) {
        echo " ";
    }
    for ($k = 1; $k <= 2 * $i - 1; $k++) {
        echo "*";
    }
    echo "\n";
}
```

### Grid Coordinates

```php
for ($x = 0; $x < 3; $x++) {
    for ($y = 0; $y < 3; $y++) {
        echo "($x,$y) ";
    }
    echo "\n";
}
```

## Best Practices

1. **Limit nesting depth** - Generally avoid more than 3 levels
2. **Use meaningful variable names** - Especially important with multiple counters
3. **Keep inner loops simple** - Move complex logic to functions if needed
4. **Consider performance** - Nested loops can quickly become expensive
5. **Proper indentation** - Crucial for readability

```php
// Good practice
for ($userIndex = 0; $userIndex < $userCount; $userIndex++) {
    for ($permIndex = 0; $permIndex < $permCount; $permIndex++) {
        checkUserPermission($users[$userIndex], $permissions[$permIndex]);
    }
}

// Avoid
for ($i = 0; $i < count($users); $i++) {
    for ($j = 0; $j < count($permissions); $j++) {
        for ($k = 0; $k < count($actions); $k++) {
            // Too deep, hard to read
        }
    }
}
```

## Common Use Cases

### Multi-dimensional Arrays

```php
foreach ($departments as $dept) {
    foreach ($dept['employees'] as $employee) {
        processEmployee($employee);
    }
}
```

### Matrix Operations

```php
for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $cols; $j++) {
        $result[$i][$j] = $matrix1[$i][$j] + $matrix2[$i][$j];
    }
}
```

### Combinatorial Logic

```php
for ($i = 1; $i <= 3; $i++) {
    for ($j = 1; $j <= 3; $j++) {
        echo "Combination: $i-$j\n";
    }
}
```

### Data Processing

```php
foreach ($customers as $customer) {
    while ($order = getNextOrder($customer)) {
        processOrder($order);
    }
}
```

## Special Cases

### Uneven Nesting

```php
for ($i = 0; $i < 10; $i++) {
    while ($condition) {
        // Inner loop may run different times per outer iteration
    }
}
```

### Early Termination

```php
outerloop:
for ($i = 0; $i < 5; $i++) {
    for ($j = 0; $j < 5; $j++) {
        if ($specialCondition) {
            break outerloop; // Breaks out of both loops
        }
    }
}
```

### Dynamic Inner Loops

```php
for ($i = 0; $i < $outerLimit; $i++) {
    $innerLimit = calculateInnerLimit($i);
    for ($j = 0; $j < $innerLimit; $j++) {
        // ...
    }
}
```

## Performance Considerations

1. **Time complexity** - O(n²) for two levels, O(n³) for three, etc.
2. **Cache outer results** - When inner loops reuse outer values
3. **Minimize inner loop work** - Move calculations outside when possible
4. **Consider alternatives** - For very large datasets

```php
// Optimized
$outerCount = count($outerArray);
for ($i = 0; $i < $outerCount; $i++) {
    $precomputed = expensiveCalculation($i);
    $innerArray = $outerArray[$i];
    $innerCount = count($innerArray);
    for ($j = 0; $j < $innerCount; $j++) {
        usePrecomputed($precomputed, $innerArray[$j]);
    }
}

// Unoptimized
for ($i = 0; $i < count($outerArray); $i++) {
    for ($j = 0; $j < count($outerArray[$i]); $j++) {
        useExpensive(expensiveCalculation($i), $outerArray[$i][$j]);
    }
}
```

## Common Pitfalls

1. **Variable shadowing**:

   ```php
   for ($i = 0; $i < 5; $i++) {
       for ($i = 0; $i < 3; $i++) { // Reusing $i
           // ...
       }
   }
   ```

2. **Infinite inner loops**:

   ```php
   for ($i = 0; $i < 5; $i++) {
       while (true) { // Never terminates
           // ...
       }
   }
   ```

3. **Accidental quadratic complexity**:
   ```php
   foreach ($items as $item) {
       foreach ($items as $innerItem) { // O(n²) when maybe O(n) would suffice
           compareItems($item, $innerItem);
       }
   }
   ```

## Advanced Patterns

### Triangular Nested Loop

```php
for ($i = 0; $i < $n; $i++) {
    for ($j = 0; $j < $i; $j++) { // Inner limit depends on outer counter
        // ...
    }
}
```

### Zigzag Pattern

```php
for ($row = 0; $row < $rows; $row++) {
    if ($row % 2 == 0) {
        for ($col = 0; $col < $cols; $col++) {
            // Left to right
        }
    } else {
        for ($col = $cols - 1; $col >= 0; $col--) {
            // Right to left
        }
    }
}
```

### Recursive Alternative

```php
function processNested($array, $level = 0) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            processNested($value, $level + 1);
        } else {
            // Process leaf node
        }
    }
}
```

## Comparison with Other Approaches

### vs Single Loop with Index Calculation

- **Nested Loops**: More readable for multi-dimensional problems
- **Single Loop**: May be more efficient in some cases

```php
// Nested version
for ($i = 0; $i < $rows; $i++) {
    for ($j = 0; $j < $cols; $j++) {
        $value = $matrix[$i][$j];
    }
}

// Single loop version
for ($k = 0; $k < $rows * $cols; $k++) {
    $i = floor($k / $cols);
    $j = $k % $cols;
    $value = $matrix[$i][$j];
}
```

### vs Recursive Solutions

- **Nested Loops**: Better for fixed, known depth
- **Recursion**: Better for variable or unknown depth

Remember: Nested loops are powerful for working with multi-dimensional data and complex iteration patterns, but they can quickly become computationally expensive. Always consider whether the nesting is necessary and if there are more efficient alternatives for your specific use case. Proper indentation and clear variable naming are essential for maintaining readability in nested loop structures.