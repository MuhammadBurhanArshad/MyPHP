# Array Key Functions in PHP

## Overview

PHP provides several functions specifically for working with array keys. These functions help you inspect, retrieve, and check the existence of keys in arrays.

## `array_keys()`

### Definition
Returns all the keys or a subset of the keys of an array.

### Syntax
```php
array array_keys(array $array, mixed $search_value = null, bool $strict = false)
```

### Parameters
- `$array`: The input array
- `$search_value`: If specified, only keys for this value are returned
- `$strict`: Whether to use strict comparison (===)

### Examples
```php
$array = ['a' => 1, 'b' => 2, 'c' => 1];

// Get all keys
$keys = array_keys($array); // ['a', 'b', 'c']

// Get keys for specific value
$keys = array_keys($array, 1); // ['a', 'c']

// Strict comparison
$keys = array_keys($array, '1', true); // []
```

### Use Cases
- Getting all keys for iteration
- Finding all keys that have a specific value
- Checking if a value exists in an array (by checking if array_keys returns non-empty)

## `array_key_first()`

### Definition
Gets the first key of an array without affecting the internal array pointer.

### Syntax
```php
mixed array_key_first(array $array)
```

### Examples
```php
$array = ['first' => 1, 'second' => 2, 'third' => 3];

$firstKey = array_key_first($array); // 'first'
```

### Notes
- Returns `null` for empty arrays
- Added in PHP 7.3
- Doesn't reset the array pointer

## `array_key_last()`

### Definition
Gets the last key of an array without affecting the internal array pointer.

### Syntax
```php
mixed array_key_last(array $array)
```

### Examples
```php
$array = ['first' => 1, 'second' => 2, 'third' => 3];

$lastKey = array_key_last($array); // 'third'
```

### Notes
- Returns `null` for empty arrays
- Added in PHP 7.3
- Doesn't reset the array pointer

## `array_key_exists()` vs `key_exists()`

### Definition
Checks if the given key or index exists in the array.

### Syntax
```php
bool array_key_exists(mixed $key, array $array)
bool key_exists(mixed $key, array $array) // Alias of array_key_exists
```

### Examples
```php
$array = ['name' => 'John', 'age' => 30];

// Check if key exists
if (array_key_exists('name', $array)) {
    echo "Name exists";
}

// With numeric keys
$numericArray = [10 => 'a', 20 => 'b'];
array_key_exists(10, $numericArray); // true
```

### Difference from `isset()`
- `array_key_exists()` returns true even if the value is null
- `isset()` returns false for null values

```php
$array = ['a' => null];

array_key_exists('a', $array); // true
isset($array['a']); // false
```

## Comparison Table

| Function | Returns | Added In | Notes |
|----------|---------|----------|-------|
| `array_keys()` | All keys or filtered keys | PHP 4 | Can search by value |
| `array_key_first()` | First key | PHP 7.3 | Returns null if empty |
| `array_key_last()` | Last key | PHP 7.3 | Returns null if empty |
| `array_key_exists()` | Whether key exists | PHP 4 | Works with null values |
| `key_exists()` | Alias of array_key_exists | PHP 4 | Same as array_key_exists |

## Best Practices

1. **Key existence checking**:
   - Use `array_key_exists()` when you need to detect null values
   - Use `isset()` when you want to exclude null values
   - `key_exists()` is just an alias - choose one and be consistent

2. **First/last keys**:
   - Prefer `array_key_first()`/`array_key_last()` over `reset()`/`end()` + `key()` as they don't modify the array pointer
   - For PHP versions before 7.3, use:
     ```php
     // Polyfill for array_key_first()
     function array_key_first(array $arr) {
         foreach($arr as $key => $unused) {
             return $key;
         }
         return null;
     }
     ```

3. **Performance considerations**:
   - `array_keys()` creates a new array - avoid in tight loops with large arrays
   - For simple existence checks, `isset()` is faster than `array_key_exists()`

## Common Use Cases

### Getting all keys for iteration
```php
foreach (array_keys($array) as $key) {
    // Work with each key
}
```

### Checking if any key has a specific value
```php
if (array_keys($array, 'desired_value')) {
    // At least one key has this value
}
```

### Getting first/last element (PHP 7.3+)
```php
$first = $array[array_key_first($array)];
$last = $array[array_key_last($array)];
```

### Safe array access
```php
function safeAccess(array $array, $key, $default = null) {
    return array_key_exists($key, $array) ? $array[$key] : $default;
}
```

## Edge Cases and Pitfalls

1. **Numeric string keys**:
   ```php
   $array = ['10' => 'value'];
   array_key_exists(10, $array); // true (type juggling)
   array_key_exists('10', $array); // true
   ```

2. **Empty arrays**:
   ```php
   array_key_first([]); // null
   array_key_last([]); // null
   ```

3. **Array pointer unaffected**:
   ```php
   $array = ['a' => 1, 'b' => 2];
   array_key_first($array); // 'a'
   current($array); // still 'a' (pointer not moved)
   ```

4. **Performance with large arrays**:
   - `array_keys()` creates a full copy of all keys
   - For simply checking existence, direct checks are better

## Advanced Patterns

### Finding duplicate values
```php
function findDuplicateValues(array $array): array {
    $valueCounts = array_count_values($array);
    $duplicates = array_keys(array_filter($valueCounts, function($count) {
        return $count > 1;
    }));
    return array_keys(array_intersect($array, $duplicates));
}
```

### Array diff by keys
```php
function array_diff_keys(array $array1, array $array2): array {
    return array_diff(array_keys($array1), array_keys($array2));
}
```

### Multi-dimensional key existence
```php
function multiKeyExists(array $array, array $keys): bool {
    foreach ($keys as $key) {
        if (!array_key_exists($key, $array)) {
            return false;
        }
        $array = $array[$key];
    }
    return true;
}
```

## Version Compatibility Notes

1. `array_key_first()` and `array_key_last()` were added in PHP 7.3
2. For earlier versions, use:
   ```php
   // First key alternative
   reset($array);
   $firstKey = key($array);
   
   // Last key alternative
   end($array);
   $lastKey = key($array);
   ```
3. All other key functions have been available since PHP 4

Remember that proper key handling is essential for robust array manipulation in PHP. These functions provide the tools needed to safely and efficiently work with array keys in various scenarios.