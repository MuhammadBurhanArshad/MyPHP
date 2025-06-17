# `array_splice()` in PHP

## Definition

The `array_splice()` function removes a portion of an array and replaces it with something else, modifying the original array directly.

## Basic Syntax

```php
array array_splice(
    array &$input,
    int $offset,
    ?int $length = null,
    mixed $replacement = []
)
```

## Key Characteristics

1. **Modifies original array** - Works by reference on the input array
2. **Removes and replaces** - Can both remove elements and insert new ones
3. **Returns extracted elements** - Returns the removed portion
4. **Flexible positioning** - Supports negative offsets
5. **Key handling** - Numeric keys are reindexed, string keys preserved

## Parameters

| Parameter | Type | Description | Required |
|-----------|------|-------------|----------|
| `$input` | array (by reference) | The input array | Yes |
| `$offset` | int | Starting position (0-based) | Yes |
| `$length` | int | Number of elements to remove | No |
| `$replacement` | mixed | Elements to insert | No |

## Common Examples

### Basic Removal

```php
$array = ['red', 'green', 'blue', 'yellow'];

// Remove 2 elements starting at position 1
$removed = array_splice($array, 1, 2);

// $array = ['red', 'yellow']
// $removed = ['green', 'blue']
```

### Insertion Without Removal

```php
$array = ['a', 'b', 'c'];

// Insert at position 1 without removing
array_splice($array, 1, 0, ['x', 'y']);

// $array = ['a', 'x', 'y', 'b', 'c']
```

### Replacement

```php
$array = ['apple', 'banana', 'cherry'];

// Replace 1 element at position 1 with 2 new elements
array_splice($array, 1, 1, ['blackberry', 'blueberry']);

// $array = ['apple', 'blackberry', 'blueberry', 'cherry']
```

### Negative Offset

```php
$array = [10, 20, 30, 40];

// Remove last 2 elements
$removed = array_splice($array, -2);

// $array = [10, 20]
// $removed = [30, 40]
```

## Best Practices

1. **Understand reference behavior** - Original array is modified directly
2. **Use for in-place modification** - When you need to change the original array
3. **Check array bounds** - Avoid errors with invalid offsets
4. **Combine removal/insertion** - Efficient for simultaneous operations
5. **Handle return value** - The removed elements may be important

```php
// Safe usage pattern
if (array_key_exists($offset, $array)) {
    $removed = array_splice($array, $offset, $length, $replacement);
}

// Common use case - inserting at specific position
array_splice($array, 3, 0, ['new_item']);
```

## Common Use Cases

### Removing Elements

```php
// Remove element at specific index
function removeAtIndex(array &$array, int $index): mixed {
    if (array_key_exists($index, $array)) {
        $removed = array_splice($array, $index, 1);
        return $removed[0];
    }
    return null;
}
```

### Inserting Elements

```php
// Insert at position with bounds checking
function insertAtIndex(array &$array, int $index, $value): bool {
    if ($index >= 0 && $index <= count($array)) {
        array_splice($array, $index, 0, [$value]);
        return true;
    }
    return false;
}
```

### Array Rotation

```php
// Rotate elements left by n positions
function rotateLeft(array &$array, int $n): void {
    $n = $n % count($array);
    if ($n > 0) {
        $slice = array_splice($array, 0, $n);
        array_splice($array, count($array), 0, $slice);
    }
}
```

### Pagination Modification

```php
// Remove and return page of items
function getPage(array &$items, int $page, int $perPage): array {
    $offset = ($page - 1) * $perPage;
    return array_splice($items, $offset, $perPage);
}
```

## Performance Considerations

1. **In-place modification** - More memory efficient than `array_slice()` + assignment
2. **Index renumbering** - Can be expensive for large arrays with numeric keys
3. **Replacement cost** - Inserting large arrays may trigger memory reallocation
4. **Reference advantage** - Avoids copying entire array for modifications

## Common Pitfalls

1. **Unintended modification** - Forgetting it modifies the original array
   ```php
   $original = [1, 2, 3];
   $removed = array_splice($original, 1);
   // $original is now [1]!
   ```

2. **Length confusion** - Second parameter is length, not end position
   ```php
   // Removes 2 elements starting at position 1 (positions 1 and 2)
   array_splice($array, 1, 2);
   ```

3. **Key reindexing** - Numeric keys are always reindexed
   ```php
   $array = [10 => 'a', 20 => 'b'];
   array_splice($array, 1, 1);
   // $array = [0 => 'a'] (key 10 becomes 0)
   ```

4. **Negative length** - Not supported (unlike some other languages)
   ```php
   array_splice($array, 1, -1); // Warning
   ```

## Advanced Patterns

### Moving Elements

```php
function moveElement(array &$array, int $from, int $to): bool {
    if ($from === $to) return true;
    if (!isset($array[$from]) return false;
    
    $element = array_splice($array, $from, 1);
    array_splice($array, $to, 0, $element);
    
    return true;
}
```

### Array Filter with Removal

```php
function filterInPlace(array &$array, callable $callback): array {
    $removed = [];
    $i = 0;
    
    while ($i < count($array)) {
        if (!$callback($array[$i])) {
            $removed[] = array_splice($array, $i, 1)[0];
        } else {
            $i++;
        }
    }
    
    return $removed;
}
```

### Batch Processing

```php
function processInBatches(array &$queue, int $batchSize, callable $processor): void {
    while (!empty($queue)) {
        $batch = array_splice($queue, 0, $batchSize);
        $processor($batch);
    }
}
```

## Comparison with Similar Functions

### vs `array_slice()`

| Feature | `array_splice()` | `array_slice()` |
|---------|------------------|-----------------|
| Modifies original | Yes | No |
| Returns | Removed elements | Extracted copy |
| Insertion | Supported | Not supported |
| Key handling | Reindexes numeric | Configurable |

### vs `unset()`

| Feature | `array_splice()` | `unset()` |
|---------|------------------|----------|
| Key reindexing | Yes (numeric) | No |
| Return value | Removed elements | None |
| Multiple elements | Yes | No |
| Insertion | Supported | No |

### vs `array_shift()`/`array_pop()`

| Feature | `array_splice()` | `array_shift()`/`array_pop()` |
|---------|------------------|------------------------------|
| Flexibility | Any position | Only ends |
| Multiple elements | Yes | No |
| Insertion | Supported | No |

## When to Use `array_splice()`

1. **In-place modification** - When you need to modify the original array
2. **Simultaneous removal/insertion** - For efficient combined operations
3. **Middle of array operations** - When working with non-end positions
4. **Queue processing** - Removing batches of items for processing
5. **Array reordering** - Moving elements within an array

## Alternatives to Consider

1. **`array_slice()` + assignment** - When you need to preserve original
2. **`unset()`** - For removing single elements without reindexing
3. **`array_filter()`** - For conditional removal without positions
4. **SplFixedArray** - For better performance with large numeric arrays

```php
// Alternative for preserving keys
function splicePreserveKeys(array &$array, int $offset, ?int $length = null, $replacement = []) {
    $removed = array_slice($array, $offset, $length, true);
    $array = array_replace(
        array_slice($array, 0, $offset, true),
        $replacement,
        array_slice($array, $offset + ($length ?? count($array)), null, true)
    );
    return $removed;
}
```

Remember that `array_splice()` is a powerful tool for direct array manipulation in PHP, but its reference-modifying behavior requires careful use. It's particularly valuable when you need both removal and insertion operations in a single function call.