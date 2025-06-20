# PHP Array Difference Functions

## Overview

PHP provides a family of `array_diff` functions that compare arrays and return their differences. These functions differ in how they compare elements (values vs keys) and what comparison methods they use (loose vs strict, custom callbacks).

## Comparison Table

| Function | Compares | Comparison Method | Key Preservation |
|----------|----------|-------------------|------------------|
| `array_diff()` | Values | Loose (==) | Preserves first array's keys |
| `array_diff_assoc()` | Keys + Values | Loose (==) | Preserves first array's keys |
| `array_diff_key()` | Keys | Loose (==) | Preserves first array's keys |
| `array_diff_uassoc()` | Keys + Values | Custom callback for keys, values (==) | Preserves first array's keys |
| `array_diff_ukey()` | Keys | Custom callback | Preserves first array's keys |
| `array_udiff()` | Values | Custom callback | Preserves first array's keys |
| `array_udiff_assoc()` | Keys + Values | Custom callback for values, keys (==) | Preserves first array's keys |
| `array_udiff_uassoc()` | Keys + Values | Custom callbacks for both | Preserves first array's keys |

## `array_diff()`

### Definition
Computes the difference of arrays using values with loose comparison (==).

### Syntax
```php
array array_diff(array $array1, array $array2, array ...$arrays)
```

### Examples
```php
$array1 = ["a" => "green", "red", "blue", "red"];
$array2 = ["b" => "green", "yellow", "red"];
$result = array_diff($array1, $array2);
// [1 => "blue"]
```

### Characteristics
- Compares only values (not keys)
- Uses loose comparison (type juggling)
- Returns elements from first array that don't exist in others
- Preserves keys from first array
- Duplicate values are compared only once

## `array_diff_assoc()`

### Definition
Computes difference with additional index check (compares keys AND values).

### Syntax
```php
array array_diff_assoc(array $array1, array $array2, array ...$arrays)
```

### Examples
```php
$array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
$array2 = ["a" => "green", "yellow", "red"];
$result = array_diff_assoc($array1, $array2);
// ["b" => "brown", "c" => "blue", 0 => "red"]
```

### Characteristics
- Compares both keys and values
- Uses loose comparison for both
- Returns elements where key/value pairs don't match in other arrays
- Numeric keys must match position exactly

## `array_diff_key()`

### Definition
Computes difference using keys for comparison.

### Syntax
```php
array array_diff_key(array $array1, array $array2, array ...$arrays)
```

### Examples
```php
$array1 = ['blue' => 1, 'red' => 2, 'green' => 3];
$array2 = ['green' => 5, 'blue' => 6];
$result = array_diff_key($array1, $array2);
// ['red' => 2]
```

### Characteristics
- Compares only keys (not values)
- Uses loose comparison for keys
- Returns elements from first array where keys don't exist in others
- Useful for filtering out specific keys

## Callback Variants

### `array_diff_uassoc()`

#### Definition
Computes difference with additional index check, using a callback for key comparison.

#### Syntax
```php
array array_diff_uassoc(
    array $array1, 
    array $array2,
    callable $key_compare_func,
    array ...$arrays
)
```

### `array_diff_ukey()`

#### Definition
Computes difference using keys, with comparison done by callback.

#### Syntax
```php
array array_diff_ukey(
    array $array1, 
    array $array2,
    callable $key_compare_func,
    array ...$arrays
)
```

### `array_udiff()`

#### Definition
Computes difference using values, with comparison done by callback.

#### Syntax
```php
array array_udiff(
    array $array1, 
    array $array2,
    callable $value_compare_func,
    array ...$arrays
)
```

### `array_udiff_assoc()`

#### Definition
Computes difference with additional index check, using callback for value comparison (keys compared with ==).

#### Syntax
```php
array array_udiff_assoc(
    array $array1, 
    array $array2,
    callable $value_compare_func,
    array ...$arrays
)
```

### `array_udiff_uassoc()`

#### Definition
Computes difference with additional index check, using separate callbacks for key and value comparison.

#### Syntax
```php
array array_udiff_uassoc(
    array $array1, 
    array $array2,
    callable $value_compare_func,
    callable $key_compare_func,
    array ...$arrays
)
```

## Common Use Cases

### Finding unique elements
```php
// Simple value comparison
$unique_values = array_diff($array1, $array2);

// Strict key/value comparison
$unique_pairs = array_diff_assoc($array1, $array2);

// Key-based filtering
$unique_keys = array_diff_key($array1, $array2);
```

### Custom comparison logic
```php
// Case-insensitive value comparison
$result = array_udiff($array1, $array2, 'strcasecmp');

// Custom key comparison
$result = array_diff_ukey($array1, $array2, function($a, $b) {
    return strtolower($a) <=> strtolower($b);
});
```

### Complex data filtering
```php
// Compare objects by property
$result = array_udiff($users1, $users2, function($a, $b) {
    return $a->id <=> $b->id;
});

// Multi-dimensional array comparison
$result = array_udiff_uassoc(
    $array1,
    $array2,
    function($a, $b) { /* value compare */ },
    function($a, $b) { /* key compare */ }
);
```

## Performance Considerations

1. **Loose vs strict comparison**:
   - Loose comparison (==) may be faster but can produce unexpected results
   - Strict comparison (===) is safer but may be slower
   - Callback variants allow for strict comparison when needed

2. **Callback overhead**:
   - Callback variants are slower due to function call overhead
   - Use only when you need custom comparison logic

3. **Array size impact**:
   - These functions compare every element - O(n*m) complexity
   - For large arrays, consider alternative approaches

## Best Practices

1. **Choose the right variant**:
   - Need to compare values only? Use `array_diff()`
   - Need exact key/value matches? Use `array_diff_assoc()`
   - Need to compare keys only? Use `array_diff_key()`
   - Need custom comparison? Use the appropriate callback variant

2. **Watch for type juggling**:
   - Loose comparison can lead to unexpected matches (1 == '1')
   - When type matters, use callback variants with strict comparison

3. **Preserve keys when needed**:
   - All diff functions preserve keys from first array
   - Use `array_values()` if you need to reindex

4. **Combine with other functions**:
   ```php
   // Filter out specific keys
   $filtered = array_diff_key(
       $array,
       array_flip(['exclude_key1', 'exclude_key2'])
   );
   ```

## Edge Cases and Pitfalls

1. **Numeric string keys**:
   ```php
   $array1 = ['1' => 'a'];
   $array2 = [1 => 'b'];
   array_diff_key($array1, $array2); // Empty (loose comparison matches)
   ```

2. **Mixed types**:
   ```php
   $array1 = [0, 1, '1', true];
   $array2 = [1];
   array_diff($array1, $array2); // Returns [0 => 0] only
   ```

3. **Callback return values**:
   - Comparison callbacks must return:
     - 0 if equal
     - -1 if first is less
     - 1 if first is greater

4. **Empty arrays**:
   - Difference with empty array returns full first array

## Advanced Examples

### Multi-dimensional array comparison
```php
$array1 = [
    ['id' => 1, 'name' => 'John'],
    ['id' => 2, 'name' => 'Jane']
];
$array2 = [
    ['id' => 1, 'name' => 'Johnny'],
    ['id' => 3, 'name' => 'Jill']
];

$result = array_udiff(
    $array1,
    $array2,
    function($a, $b) {
        return $a['id'] <=> $b['id'];
    }
);
// Returns array with ['id' => 2, 'name' => 'Jane']
```

### Case-insensitive associative comparison
```php
$result = array_udiff_uassoc(
    $array1,
    $array2,
    'strcasecmp', // value comparison
    'strcasecmp'  // key comparison
);
```

### Complex object comparison
```php
$result = array_udiff(
    $allUsers,
    $activeUsers,
    function(User $a, User $b) {
        return $a->getId() <=> $b->getId();
    }
);
```

## Version Compatibility

All these functions are available since PHP 5.0, with consistent behavior across versions. The callback variants provide flexibility when the built-in comparison operators aren't sufficient for your needs.