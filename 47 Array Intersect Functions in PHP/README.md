# PHP Array Intersect Functions

## Overview

PHP provides a family of `array_intersect` functions that compare arrays and return their common elements. These functions differ in how they compare elements (values vs keys) and what comparison methods they use (loose vs strict, custom callbacks).

## Comparison Table

| Function | Compares | Comparison Method | Key Preservation |
|----------|----------|-------------------|------------------|
| `array_intersect()` | Values | Loose (==) | Preserves first array's keys |
| `array_intersect_assoc()` | Keys + Values | Loose (==) | Preserves first array's keys |
| `array_intersect_key()` | Keys | Loose (==) | Preserves first array's keys |
| `array_intersect_uassoc()` | Keys + Values | Custom callback for keys, values (==) | Preserves first array's keys |
| `array_intersect_ukey()` | Keys | Custom callback | Preserves first array's keys |
| `array_uintersect()` | Values | Custom callback | Preserves first array's keys |
| `array_uintersect_assoc()` | Keys + Values | Custom callback for values, keys (==) | Preserves first array's keys |
| `array_uintersect_uassoc()` | Keys + Values | Custom callbacks for both | Preserves first array's keys |

## `array_intersect()`

### Definition
Computes the intersection of arrays using values with loose comparison (==).

### Syntax
```php
array array_intersect(array $array1, array $array2, array ...$arrays)
```

### Examples
```php
$array1 = ["a" => "green", "red", "blue"];
$array2 = ["b" => "green", "yellow", "red"];
$result = array_intersect($array1, $array2);
// ["a" => "green", 0 => "red"]
```

### Characteristics
- Compares only values (not keys)
- Uses loose comparison (type juggling)
- Returns elements from first array that exist in others
- Preserves keys from first array

## `array_intersect_assoc()`

### Definition
Computes intersection with additional index check (compares keys AND values).

### Syntax
```php
array array_intersect_assoc(array $array1, array $array2, array ...$arrays)
```

### Examples
```php
$array1 = ["a" => "green", "b" => "brown", "c" => "blue", "red"];
$array2 = ["a" => "green", "b" => "yellow", "blue", "red"];
$result = array_intersect_assoc($array1, $array2);
// ["a" => "green"]
```

### Characteristics
- Compares both keys and values
- Uses loose comparison for both
- Only returns elements where key/value pairs match
- Numeric keys must match position exactly

## `array_intersect_key()`

### Definition
Computes intersection using keys for comparison.

### Syntax
```php
array array_intersect_key(array $array1, array $array2, array ...$arrays)
```

### Examples
```php
$array1 = ['blue' => 1, 'red' => 2, 'green' => 3];
$array2 = ['green' => 5, 'blue' => 6, 'yellow' => 7];
$result = array_intersect_key($array1, $array2);
// ['blue' => 1, 'green' => 3]
```

### Characteristics
- Compares only keys (not values)
- Uses loose comparison for keys
- Returns elements from first array where keys exist in others
- Useful for filtering arrays by key patterns

## Callback Variants

### `array_intersect_uassoc()`

#### Definition
Computes intersection with additional index check, using a callback for key comparison.

#### Syntax
```php
array array_intersect_uassoc(
    array $array1, 
    array $array2,
    callable $key_compare_func,
    array ...$arrays
)
```

### `array_intersect_ukey()`

#### Definition
Computes intersection using keys, with comparison done by callback.

#### Syntax
```php
array array_intersect_ukey(
    array $array1, 
    array $array2,
    callable $key_compare_func,
    array ...$arrays
)
```

### `array_uintersect()`

#### Definition
Computes intersection using values, with comparison done by callback.

#### Syntax
```php
array array_uintersect(
    array $array1, 
    array $array2,
    callable $value_compare_func,
    array ...$arrays
)
```

### `array_uintersect_assoc()`

#### Definition
Computes intersection with additional index check, using callback for value comparison.

#### Syntax
```php
array array_uintersect_assoc(
    array $array1, 
    array $array2,
    callable $value_compare_func,
    array ...$arrays
)
```

### `array_uintersect_uassoc()`

#### Definition
Computes intersection with additional index check, using separate callbacks for key and value comparison.

#### Syntax
```php
array array_uintersect_uassoc(
    array $array1, 
    array $array2,
    callable $value_compare_func,
    callable $key_compare_func,
    array ...$arrays
)
```

## Common Use Cases

### Finding common elements
```php
// Simple value comparison
$common_values = array_intersect($array1, $array2);

// Strict key/value comparison
$common_pairs = array_intersect_assoc($array1, $array2);

// Key-based filtering
$common_keys = array_intersect_key($array1, $array2);
```

### Custom comparison logic
```php
// Case-insensitive value comparison
$result = array_uintersect($array1, $array2, 'strcasecmp');

// Custom key comparison
$result = array_intersect_ukey($array1, $array2, function($a, $b) {
    return strtolower($a) <=> strtolower($b);
});
```

### Complex data matching
```php
// Compare objects by property
$result = array_uintersect($users1, $users2, function($a, $b) {
    return $a->id <=> $b->id;
});

// Multi-dimensional array comparison
$result = array_uintersect_uassoc(
    $array1,
    $array2,
    function($a, $b) { /* value compare */ },
    function($a, $b) { /* key compare */ }
);
```

## Performance Considerations

1. **Loose vs strict comparison**:
   - Loose comparison (==) may be faster but can produce unexpected matches
   - Strict comparison (===) is safer but may be slower

2. **Callback overhead**:
   - Callback variants are slower due to function call overhead
   - Use only when you need custom comparison logic

3. **Array size impact**:
   - These functions compare every element - O(n*m) complexity
   - For large arrays, consider alternative approaches

## Best Practices

1. **Choose the right variant**:
   - Need to compare values only? Use `array_intersect()`
   - Need exact key/value matches? Use `array_intersect_assoc()`
   - Need custom comparison? Use the appropriate callback variant

2. **Watch for type juggling**:
   - Loose comparison can lead to unexpected matches (1 == '1')
   - When type matters, use callback variants with strict comparison

3. **Preserve keys when needed**:
   - All intersect functions preserve keys from first array
   - Use `array_values()` if you need to reindex

4. **Combine with other functions**:
   ```php
   // Get common keys then filter
   $common = array_intersect_key(
       $array1,
       array_flip(['allowed_key1', 'allowed_key2'])
   );
   ```

## Edge Cases and Pitfalls

1. **Numeric string keys**:
   ```php
   $array1 = ['1' => 'a'];
   $array2 = [1 => 'b'];
   array_intersect_key($array1, $array2); // Match (loose comparison)
   ```

2. **Mixed types**:
   ```php
   $array1 = [1, '1', true];
   $array2 = ['1'];
   array_intersect($array1, $array2); // Returns all three (loose comparison)
   ```

3. **Callback return values**:
   - Comparison callbacks must return:
     - 0 if equal
     - -1 if first is less
     - 1 if first is greater

4. **Empty arrays**:
   - Intersection with empty array always returns empty array

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

$result = array_uintersect(
    $array1,
    $array2,
    function($a, $b) {
        return $a['id'] <=> $b['id'];
    }
);
// Returns array with ['id' => 1, 'name' => 'John']
```

### Case-insensitive associative comparison
```php
$result = array_uintersect_uassoc(
    $array1,
    $array2,
    'strcasecmp', // value comparison
    'strcasecmp'  // key comparison
);
```

### Complex object comparison
```php
$result = array_uintersect(
    $users,
    $activeUsers,
    function(User $a, User $b) {
        return $a->getId() <=> $b->getId();
    }
);
```

## Version Compatibility

All these functions are available since PHP 5.0, with consistent behavior across versions. The callback variants provide flexibility when the built-in comparison operators aren't sufficient for your needs.
