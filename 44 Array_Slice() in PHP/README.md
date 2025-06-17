# `array_slice()` in PHP

## Definition

The `array_slice()` function extracts a portion of an array, allowing you to work with a subset of elements while preserving keys (optionally).

## Basic Syntax

```php
array array_slice(
    array $array,
    int $offset,
    ?int $length = null,
    bool $preserve_keys = false
)
```

## Key Characteristics

1. **Extracts subset** - Returns specified portion of original array
2. **Non-destructive** - Original array remains unchanged
3. **Flexible parameters** - Can specify start position and length
4. **Key handling** - Option to preserve or reset keys
5. **Negative indices** - Supports negative offsets for end-relative positions

## Parameters

| Parameter | Type | Description | Required |
|-----------|------|-------------|----------|
| `$array` | array | Input array | Yes |
| `$offset` | int | Starting position (0-based) | Yes |
| `$length` | int | Number of elements to extract | No |
| `$preserve_keys` | bool | Keep original keys (default false) | No |

## Common Examples

### Basic Usage

```php
$array = ['a', 'b', 'c', 'd', 'e'];

// Get elements from position 1 to end
$result = array_slice($array, 1);
// ['b', 'c', 'd', 'e']

// Get 2 elements starting from position 2
$result = array_slice($array, 2, 2);
// ['c', 'd']
```

### Negative Offset

```php
$array = ['a', 'b', 'c', 'd', 'e'];

// Get last 3 elements
$result = array_slice($array, -3);
// ['c', 'd', 'e']

// Get 2 elements starting from 3rd from end
$result = array_slice($array, -3, 2);
// ['c', 'd']
```

### Preserving Keys

```php
$array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];

// Without preserving keys
$result = array_slice($array, 1, 2);
// [0 => 2, 1 => 3]

// With preserved keys
$result = array_slice($array, 1, 2, true);
// ['b' => 2, 'c' => 3]
```

### Numeric Keys

```php
$array = [10 => 'a', 20 => 'b', 30 => 'c'];

// Without preserving keys
$result = array_slice($array, 1, 1);
// [0 => 'b']

// With preserved keys
$result = array_slice($array, 1, 1, true);
// [20 => 'b']
```

## Best Practices

1. **Check array length first** - Avoid errors with empty arrays
2. **Use negative offsets** - More readable for end-relative positions
3. **Consider key preservation** - Important for associative arrays
4. **Combine with other functions** - Often used with `array_splice()` for modification
5. **Handle edge cases** - Offsets beyond array bounds return empty array

```php
// Safe usage pattern
if (count($array) > $offset) {
    $slice = array_slice($array, $offset, $length);
}

// Common pagination pattern
$perPage = 10;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $perPage;
$items = array_slice($allItems, $offset, $perPage);
```

## Common Use Cases

### Pagination

```php
function paginate(array $items, int $page, int $perPage): array {
    $offset = ($page - 1) * $perPage;
    return array_slice($items, $offset, $perPage);
}
```

### Getting First/Last Items

```php
// First 3 items
$firstThree = array_slice($array, 0, 3);

// Last item
$last = array_slice($array, -1)[0];
```

### Splitting Arrays

```php
$array = [1, 2, 3, 4, 5, 6];
$chunkSize = 2;

$chunks = [];
for ($i = 0; $i < count($array); $i += $chunkSize) {
    $chunks[] = array_slice($array, $i, $chunkSize);
}
```

### Extracting Segments

```php
$logLine = "2023-01-15 14:30:22 ERROR Something went wrong";
$parts = explode(' ', $logLine);
$timestamp = implode(' ', array_slice($parts, 0, 2));
$message = implode(' ', array_slice($parts, 3));
```

## Performance Considerations

1. **Memory efficient** - Returns new array but doesn't modify original
2. **Linear time complexity** - O(n) where n is length of slice
3. **Large arrays** - Consider generator pattern for very large datasets
4. **Alternatives** - For sequential numeric keys, sometimes string manipulation is faster

## Common Pitfalls

1. **Confusing offset/length** - Remember offset is 0-based
   ```php
   // Gets elements 2 and 3 (not 2 through 3)
   $slice = array_slice($array, 2, 2);
   ```

2. **Unexpected key reset**
   ```php
   $array = ['a' => 1, 'b' => 2];
   $slice = array_slice($array, 1); // [0 => 2] not ['b' => 2]
   ```

3. **Empty results**
   ```php
   $array = [1, 2, 3];
   $slice = array_slice($array, 5); // [] not error
   ```

4. **Negative length** - Not supported (unlike some other languages)
   ```php
   $slice = array_slice($array, 1, -1); // Warning
   ```

## Advanced Patterns

### Slice Until Condition

```php
function slice_until(array $array, callable $condition): array {
    foreach ($array as $key => $value) {
        if ($condition($value)) {
            return array_slice($array, 0, $key, true);
        }
    }
    return $array;
}
```

### Slice After Condition

```php
function slice_after(array $array, callable $condition): array {
    foreach ($array as $key => $value) {
        if ($condition($value)) {
            return array_slice($array, $key + 1, null, true);
        }
    }
    return [];
}
```

### Slice Between Conditions

```php
function slice_between(array $array, callable $start, callable $end): array {
    $startPos = null;
    $endPos = null;
    
    foreach ($array as $key => $value) {
        if ($startPos === null && $start($value)) {
            $startPos = $key;
        } elseif ($startPos !== null && $end($value)) {
            $endPos = $key;
            break;
        }
    }
    
    if ($startPos !== null && $endPos !== null) {
        return array_slice($array, $startPos, $endPos - $startPos + 1, true);
    }
    
    return [];
}
```

## Comparison with Similar Functions

### vs `array_splice()`

| Feature | `array_slice()` | `array_splice()` |
|---------|-----------------|------------------|
| Modifies original | No | Yes |
| Returns | Extracted portion | Removed elements |
| Usage | Read-only extraction | In-place modification |
| Key preservation | Optional | Preserves keys |

### vs `array_chunk()`

| Feature | `array_slice()` | `array_chunk()` |
|---------|-----------------|-----------------|
| Purpose | Extract single segment | Split into multiple arrays |
| Key preservation | Optional | Preserved |
| Output | Single array | Array of arrays |
| Size parameter | Maximum length | Fixed chunk size |

### vs String `substr()`

| Feature | `array_slice()` | `substr()` |
|---------|-----------------|-----------|
| Works on | Arrays | Strings |
| Negative length | Not supported | Supported |
| Key handling | Configurable | N/A |

## When to Use `array_slice()`

1. **Need a subset** - When you only need part of an array
2. **Non-destructive** - When original array must remain unchanged
3. **Key control** - When you need to preserve or reset keys
4. **End-relative** - When you need elements from the end
5. **Pagination** - For implementing simple pagination logic

## Alternatives to Consider

1. **`array_splice()`** - When you want to modify the original array
2. **`array_chunk()`** - When you need equal-sized segments
3. **Generators** - For very large arrays to save memory
4. **Custom iteration** - When you need complex slicing logic

```php
// Generator alternative for memory efficiency
function array_slice_generator(array $array, int $offset, ?int $length = null) {
    $count = 0;
    $max = $length !== null ? $offset + $length : null;
    
    foreach ($array as $key => $value) {
        if ($key < $offset) continue;
        if ($max !== null && $key >= $max) break;
        
        yield $key => $value;
    }
}
```

Remember that `array_slice()` is a versatile function that should be part of every PHP developer's toolkit for array manipulation. Its behavior is consistent and predictable, making it ideal for many common array processing tasks.