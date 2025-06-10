# `array_replace()` and `array_replace_recursive()` in PHP

## Definition

These functions are used to replace elements in arrays with elements from other arrays. The key difference between them is how they handle nested array structures.

## `array_replace()`

### Basic Syntax

```php
array array_replace(array $array1, array ...$arrays)
```

### Key Characteristics

1. **Non-recursive replacement** - Only replaces top-level elements
2. **Multiple arrays** - Can accept any number of replacement arrays
3. **Overwrites by key** - Later arrays overwrite earlier ones
4. **Preserves keys** - Both numeric and string keys are preserved
5. **Returns new array** - Original arrays remain unchanged

### Common Examples

#### Basic Replacement

```php
$base = ['a' => 1, 'b' => 2];
$replacements = ['b' => 3, 'c' => 4];

$result = array_replace($base, $replacements);
// ['a' => 1, 'b' => 3, 'c' => 4]
```

#### Multiple Arrays

```php
$base = ['a' => 1, 'b' => 2];
$rep1 = ['b' => 3];
$rep2 = ['a' => 5, 'c' => 6];

$result = array_replace($base, $rep1, $rep2);
// ['a' => 5, 'b' => 3, 'c' => 6]
```

#### Numeric Keys

```php
$base = [10 => 'apple', 20 => 'banana'];
$replacements = [20 => 'orange', 30 => 'pear'];

$result = array_replace($base, $replacements);
// [10 => 'apple', 20 => 'orange', 30 => 'pear']
```

### Best Practices

1. **Use for flat arrays** - When you don't need recursive replacement
2. **Order matters** - Later arrays override earlier ones
3. **Preserve original** - Returns new array without modifying inputs
4. **Handle missing keys** - Non-existing keys in replacements are ignored

```php
// Good practice - clear ordering
$config = array_replace($defaults, $userPrefs, $runtimeSettings);

// Avoid when you need deep replacement
$deepArray = array_replace_recursive($base, $replacements);
```

## `array_replace_recursive()`

### Basic Syntax

```php
array array_replace_recursive(array $array1, array ...$arrays)
```

### Key Characteristics

1. **Recursive replacement** - Handles nested array structures
2. **Deep merging** - Replaces values at all levels
3. **Multiple arrays** - Can accept any number of replacement arrays
4. **Overwrites by key** - Later arrays overwrite earlier ones at all levels
5. **Returns new array** - Original arrays remain unchanged

### Common Examples

#### Basic Recursive Replacement

```php
$base = ['a' => 1, 'b' => ['x' => 10, 'y' => 20]];
$replacements = ['b' => ['y' => 30], 'c' => 4];

$result = array_replace_recursive($base, $replacements);
// ['a' => 1, 'b' => ['x' => 10, 'y' => 30], 'c' => 4]
```

#### Multiple Arrays

```php
$base = ['a' => 1, 'b' => ['x' => 10, 'y' => 20]];
$rep1 = ['b' => ['y' => 30]];
$rep2 = ['a' => 5, 'b' => ['z' => 40]];

$result = array_replace_recursive($base, $rep1, $rep2);
// ['a' => 5, 'b' => ['x' => 10, 'y' => 30, 'z' => 40]]
```

#### Mixed Levels

```php
$base = ['settings' => ['color' => 'red', 'size' => 'medium']];
$replacements = ['settings' => ['color' => 'blue'], 'debug' => true];

$result = array_replace_recursive($base, $replacements);
// ['settings' => ['color' => 'blue', 'size' => 'medium'], 'debug' => true]
```

### Best Practices

1. **Use for nested arrays** - When you need deep replacement
2. **Order matters** - Later arrays override earlier ones at all levels
3. **Preserve original** - Returns new array without modifying inputs
4. **Combine with array_replace** - For mixed-depth replacements

```php
// Good practice for configuration merging
$finalConfig = array_replace_recursive($defaultConfig, $envConfig, $userConfig);

// Be careful with numeric keys in nested arrays
$result = array_replace_recursive($base, $replacements);
```

## Comparison Table

| Feature                | `array_replace()` | `array_replace_recursive()` |
|------------------------|-------------------|----------------------------|
| Replacement Depth      | Top-level only    | All levels (recursive)      |
| Numeric Key Handling   | Replaces          | Replaces                   |
| String Key Handling    | Replaces          | Replaces                   |
| Multiple Arrays        | Yes               | Yes                        |
| Order of Precedence   | Last wins         | Last wins at each level    |
| Performance           | Faster            | Slower (due to recursion)  |

## Common Use Cases

### `array_replace()`

1. **Configuration overriding**
   ```php
   $config = array_replace($defaultSettings, $environmentSettings);
   ```

2. **Updating flat data structures**
   ```php
   $user = array_replace($oldUserData, $updatedFields);
   ```

3. **Merging API responses**
   ```php
   $finalResponse = array_replace($baseResponse, $additionalData);
   ```

### `array_replace_recursive()`

1. **Nested configuration merging**
   ```php
   $config = array_replace_recursive($defaults, $userPrefs);
   ```

2. **Deep data structure updates**
   ```php
   $document = array_replace_recursive($originalDoc, $patches);
   ```

3. **Template system variables**
   ```php
   $templateVars = array_replace_recursive($globalVars, $pageVars);
   ```

## Performance Considerations

1. **`array_replace()` is faster** - No recursion overhead
2. **Deep nesting slows down** - `array_replace_recursive()` performance decreases with depth
3. **Large arrays** - Consider breaking into smaller operations
4. **Alternative for simple cases** - Sometimes `+` operator or `array_merge` might suffice

```php
// Simple case where + operator works (different behavior!)
$result = $array1 + $array2; // Only adds keys not in $array1

// array_merge differs in numeric key handling
$result = array_merge($array1, $array2); // Reindexes numeric keys
```

## Common Pitfalls

1. **Numeric key confusion**
   ```php
   $base = [10 => 'a', 20 => 'b'];
   $replace = [20 => 'c', 30 => 'd'];
   $result = array_replace($base, $replace);
   // [10 => 'a', 20 => 'c', 30 => 'd'] (keys preserved)
   ```

2. **Unexpected recursion**
   ```php
   $base = ['a' => ['b' => 1]];
   $replace = ['a' => 2]; // Replaces entire 'a' array
   $result = array_replace_recursive($base, $replace);
   // ['a' => 2] (not ['a' => ['b' => 1, 'c' => 2]])
   ```

3. **Order of operations**
   ```php
   $result = array_replace($a, $b, $c); // $c overrides $b which overrides $a
   ```

4. **Reference issues**
   ```php
   $original = ['data' => &$ref];
   $replaced = array_replace($original, ['data' => 'new']);
   // $ref is not changed
   ```

## Advanced Patterns

### Conditional Replacement

```php
$result = array_replace(
    $baseConfig,
    $user->isPremium() ? $premiumFeatures : [],
    $user->isAdmin() ? $adminFeatures : []
);
```

### Multi-level Defaults

```php
$config = array_replace_recursive(
    ['db' => ['host' => 'localhost', 'port' => 3306]],
    parse_ini_file('database.ini', true)
);
```

### Partial Recursive Replacement

```php
function array_partial_replace_recursive($base, $replacements) {
    foreach ($replacements as $key => $value) {
        if (is_array($value) {
            $base[$key] = array_partial_replace_recursive(
                isset($base[$key]) ? $base[$key] : [],
                $value
            );
        } else {
            $base[$key] = $value;
        }
    }
    return $base;
}
```

### Combining Both Functions

```php
$result = array_replace_recursive(
    array_replace($baseFlatSettings, $flatOverrides),
    $nestedSettings
);
```

## Comparison with Similar Functions

### vs `array_merge()`

- `array_merge()` renumbers numeric keys
- `array_replace()` preserves all keys
- `array_merge()` doesn't handle recursive merging

### vs `+` operator

- `+` doesn't replace existing keys
- `array_replace()` overwrites existing keys
- `+` is much faster but more limited

### vs Custom Merge Functions

For specialized merging needs, you might need custom functions:
```php
function custom_merge($a, $b) {
    // Custom merging logic
}
```

## When to Use Each

### Use `array_replace()` when:
- You only need top-level replacement
- You want to preserve all keys (including numeric)
- You're working with flat data structures
- Performance is a concern

### Use `array_replace_recursive()` when:
- You need deep replacement of nested arrays
- You're merging multi-dimensional configurations
- You want consistent behavior at all levels
- The slight performance hit is acceptable

Remember: Both functions are non-destructive (they return new arrays rather than modifying the originals). For very large or complex data structures, consider benchmarking against custom solutions to ensure optimal performance.