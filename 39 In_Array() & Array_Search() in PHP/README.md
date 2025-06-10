# `in_array()` and `array_search()` in PHP

## Definition

Both `in_array()` and `array_search()` are PHP functions used to search for values in arrays, but they serve slightly different purposes and return different results.

## `in_array()`

### Basic Syntax

```php
bool in_array(mixed $needle, array $haystack, bool $strict = false)
```

### Key Characteristics

1. **Returns boolean** - `true` if value exists, `false` otherwise
2. **Case-sensitive** - For string comparisons
3. **Optional strict mode** - Type comparison can be enforced
4. **Simple existence check** - Doesn't return position information

### Common Examples

#### Basic Usage

```php
$fruits = ['apple', 'banana', 'orange'];
if (in_array('banana', $fruits)) {
    echo 'Found banana!';  // Output: Found banana!
}
```

#### Strict Mode

```php
$numbers = ['1', 2, 3];
var_dump(in_array(1, $numbers));        // true (loose comparison)
var_dump(in_array(1, $numbers, true)); // false (strict comparison)
```

#### Case Sensitivity

```php
$colors = ['Red', 'Green', 'Blue'];
var_dump(in_array('red', $colors));     // false
var_dump(in_array('Red', $colors));     // true
```

### Best Practices

1. **Use strict mode** when type matters
2. **Consider performance** for large arrays (O(n) complexity)
3. **Pre-filter arrays** if searching multiple times
4. **Use with associative arrays** (searches values, not keys)

```php
// Good practice with strict mode
if (in_array($searchValue, $largeArray, true)) {
    // handle found case
}

// Avoid when you need the key
$key = array_search($value, $array);
if ($key !== false) {
    // use $key
}
```

## `array_search()`

### Basic Syntax

```php
mixed array_search(mixed $needle, array $haystack, bool $strict = false)
```

### Key Characteristics

1. **Returns key/index** - Of the found element
2. **Returns false** - If value not found
3. **Case-sensitive** - For string comparisons
4. **Optional strict mode** - Type comparison can be enforced
5. **First match only** - Returns first occurrence's key

### Common Examples

#### Basic Usage

```php
$fruits = ['a' => 'apple', 'b' => 'banana', 'o' => 'orange'];
$key = array_search('banana', $fruits);
echo $key;  // Output: 'b'
```

#### Indexed Arrays

```php
$colors = ['red', 'green', 'blue'];
$index = array_search('green', $colors);
echo $index;  // Output: 1
```

#### Strict Mode

```php
$data = ['1', 2, 3];
var_dump(array_search(1, $data));        // 0 (loose comparison)
var_dump(array_search(1, $data, true));  // false (strict comparison)
```

### Best Practices

1. **Always check for false** with strict comparison (`!==`)
2. **Use strict mode** when type matters
3. **Handle numeric keys** carefully (0 can be valid key or false)
4. **Consider performance** for large arrays

```php
// Proper false checking
$key = array_search($value, $array);
if ($key !== false) {
    // valid key found (even if 0)
} else {
    // not found
}

// Bad practice (fails if key is 0)
if ($key) {
    // might miss key 0
}
```

## Comparison Table

| Feature            | `in_array()` | `array_search()` |
|--------------------|--------------|------------------|
| Return Type        | boolean      | mixed (key/false) |
| Best For           | Existence check | Finding position |
| Strict Mode        | Yes          | Yes              |
| Performance        | O(n)         | O(n)             |
| Multiple Matches   | No           | Returns first     |
| Case Sensitivity   | Yes          | Yes              |

## Common Use Cases

### `in_array()`

1. **Simple existence checks**
   ```php
   if (in_array($status, ['active', 'pending', 'approved'])) {
       // proceed
   }
   ```

2. **Form validation**
   ```php
   if (!in_array($input, $allowedValues, true)) {
       throw new InvalidArgumentException('Invalid value');
   }
   ```

3. **Feature flags**
   ```php
   if (in_array($user->id, $betaTesters, true)) {
       enableBetaFeatures();
   }
   ```

### `array_search()`

1. **Finding array keys**
   ```php
   $index = array_search($productId, $productIds);
   if ($index !== false) {
       $selectedProduct = $products[$index];
   }
   ```

2. **Removing elements by value**
   ```php
   if (($key = array_search($value, $array)) !== false) {
       unset($array[$key]);
   }
   ```

3. **Position-based operations**
   ```php
   $position = array_search($currentItem, $navigationItems);
   if ($position !== false && isset($navigationItems[$position + 1])) {
       $nextItem = $navigationItems[$position + 1];
   }
   ```

## Performance Considerations

1. **Both are O(n)** - Linear search through array
2. **Large arrays** - Consider alternative data structures if searching frequently
3. **Multiple searches** - Flip array if searching many times:
   ```php
   $flipped = array_flip($array);
   if (isset($flipped[$value])) {
       // exists (faster than in_array)
   }
   ```
4. **Sorted arrays** - Can use binary search for better performance

## Common Pitfalls

1. **False vs 0 issue**
   ```php
   // Dangerous
   if (array_search($value, $array)) {
       // fails if key is 0
   }
   
   // Safe
   if (array_search($value, $array) !== false) {
       // works for all keys
   }
   ```

2. **Type juggling**
   ```php
   $data = ['0', '1', '2'];
   var_dump(in_array(0, $data));        // true (may be unexpected)
   var_dump(in_array(0, $data, true));  // false (strict)
   ```

3. **First match only**
   ```php
   $data = ['a', 'b', 'a', 'c'];
   echo array_search('a', $data);  // always 0, not 2
   ```

4. **Associative arrays**
   ```php
   $data = ['one' => 1, 'two' => 2];
   echo array_search(2, $data);  // 'two' (returns key, not index)
   ```

## Advanced Patterns

### Multi-dimensional Searching

```php
function searchMultiArray($value, $array) {
    foreach ($array as $key => $val) {
        if ($val === $value) return $key;
        if (is_array($val) {
            $result = searchMultiArray($value, $val);
            if ($result !== false) return $result;
        }
    }
    return false;
}
```

### Finding All Matches

```php
function array_search_all($needle, $haystack) {
    return array_keys(array_filter($haystack, function($item) use ($needle) {
        return $item === $needle;
    }));
}
```

### Case-Insensitive Search

```php
function in_arrayi($needle, $haystack) {
    return in_array(strtolower($needle), array_map('strtolower', $haystack));
}

function array_searchi($needle, $haystack) {
    return array_search(strtolower($needle), array_map('strtolower', $haystack));
}
```

## Comparison with Similar Functions

### vs `array_key_exists()`

- `array_key_exists()` checks for keys, not values
- `in_array()`/`array_search()` check values

### vs `isset()`

- `isset()` checks if key exists and is not null
- Faster than `array_key_exists()` but doesn't work with null values

### vs Custom Search

For complex conditions, consider:

```php
$found = array_filter($array, function($item) {
    return $item->property === 'value';
});
```

## When to Use Each

### Use `in_array()` when:
- You only need to know if a value exists
- The position/index isn't important
- You're doing a simple boolean check

### Use `array_search()` when:
- You need the key/index of the found item
- You plan to use the position for further operations
- You need to modify or reference the found element

Remember: Both functions perform linear searches and can be slow for very large arrays. For performance-critical applications with large datasets, consider alternative data structures or search algorithms.