# `array_merge()` and `array_combine()` in PHP

## Definition

These functions are used to combine arrays in different ways, serving distinct purposes in array manipulation.

## `array_merge()`

### Basic Syntax

```php
array array_merge(array ...$arrays)
```

### Key Characteristics

1. **Combines multiple arrays** - Accepts any number of array arguments
2. **Numeric key reindexing** - Resets numeric keys starting from 0
3. **String key overwriting** - Later values overwrite earlier ones for duplicate string keys
4. **Preserves non-numeric keys** - Associative keys remain unchanged
5. **Non-destructive** - Returns new array without modifying originals

### Common Examples

#### Basic Merge

```php
$array1 = ['a', 'b', 'c'];
$array2 = ['d', 'e', 'f'];
$result = array_merge($array1, $array2);

// $result = ['a', 'b', 'c', 'd', 'e', 'f'] (keys reindexed)
```

#### Associative Arrays

```php
$array1 = ['name' => 'John', 'age' => 25];
$array2 = ['age' => 26, 'city' => 'New York'];
$result = array_merge($array1, $array2);

// $result = ['name' => 'John', 'age' => 26, 'city' => 'New York']
```

#### Mixed Keys

```php
$array1 = [0 => 'a', 1 => 'b', 'name' => 'John'];
$array2 = [0 => 'c', 2 => 'd', 'name' => 'Jane'];
$result = array_merge($array1, $array2);

// $result = [0 => 'a', 1 => 'b', 'name' => 'Jane', 2 => 'c', 3 => 'd']
```

### Best Practices

1. **Use for associative arrays** - Preserves string keys well
2. **Watch numeric keys** - They get reindexed sequentially
3. **Order matters** - Later arrays overwrite earlier ones
4. **Alternative for numeric keys** - Use `+` operator to preserve numeric keys

```php
// Good for associative data
$config = array_merge($defaults, $userSettings);

// Not ideal for numeric keys (use + instead)
$numbered = $array1 + $array2; // Preserves original numeric keys
```

## `array_combine()`

### Basic Syntax

```php
array array_combine(array $keys, array $values)
```

### Key Characteristics

1. **Creates associative array** - Uses one array for keys and another for values
2. **Requires equal length** - Both arrays must have same number of elements
3. **Returns new array** - Original arrays remain unchanged
4. **Strict pairing** - First element of keys with first element of values, etc.
5. **Warning on mismatch** - Throws warning if arrays differ in length

### Common Examples

#### Basic Combination

```php
$keys = ['name', 'age', 'city'];
$values = ['John', 30, 'London'];
$result = array_combine($keys, $values);

// $result = ['name' => 'John', 'age' => 30, 'city' => 'London']
```

#### Numeric Keys

```php
$keys = [10, 20, 30];
$values = ['a', 'b', 'c'];
$result = array_combine($keys, $values);

// $result = [10 => 'a', 20 => 'b', 30 => 'c']
```

#### With array Functions

```php
$columns = ['id', 'name', 'email'];
$row = fetchFromDatabase(); // Returns [1, 'John', 'john@example.com']
$result = array_combine($columns, $row);
```

### Best Practices

1. **Validate array lengths** - Ensure both arrays have same count
2. **Use for data mapping** - Perfect for pairing separate key/value sets
3. **Combine with other functions** - Often used with `array_column()` or database results
4. **Handle errors** - Check lengths to avoid warnings

```php
// Safe usage
if (count($keys) === count($values)) {
    $combined = array_combine($keys, $values);
}

// Useful for database results
$users = array_combine(array_column($resultSet, 'id'), $resultSet);
```

## Comparison Table

| Feature                | `array_merge()` | `array_combine()` |
|------------------------|-----------------|-------------------|
| Purpose                | Merges arrays | Creates associative array |
| Input                  | Multiple arrays | Two arrays (keys + values) |
| Numeric Key Handling   | Reindexes | Preserves numeric keys |
| String Key Handling    | Overwrites duplicates | Creates new keys |
| Length Requirement     | Any length | Must be equal length |
| Return Value           | Merged array | New associative array |

## Common Use Cases

### `array_merge()`

1. **Configuration merging**
   ```php
   $config = array_merge($defaultConfig, $envConfig, $userConfig);
   ```

2. **Combining datasets**
   ```php
   $allUsers = array_merge($activeUsers, $inactiveUsers);
   ```

3. **Adding default values**
   ```php
   $data = array_merge(['page' => 1, 'limit' => 10], $_GET);
   ```

### `array_combine()`

1. **Database result mapping**
   ```php
   $users = array_combine(array_column($result, 'id'), $result);
   ```

2. **CSV header mapping**
   ```php
   $header = fgetcsv($handle);
   while ($row = fgetcsv($handle)) {
       $data[] = array_combine($header, $row);
   }
   ```

3. **Creating lookup tables**
   ```php
   $ids = [101, 102, 103];
   $names = ['John', 'Jane', 'Doe'];
   $lookup = array_combine($ids, $names);
   ```

## Performance Considerations

1. **`array_merge()` overhead** - Creates new array, more expensive with many arrays
2. **`array_combine()` efficiency** - Generally fast for matching arrays
3. **Large arrays** - Both functions need to process all elements
4. **Alternatives** - `+` operator faster for simple cases but different behavior

```php
// array_merge vs + operator
$merged = array_merge($a, $b); // Reindexes numeric keys
$merged = $a + $b; // Preserves numeric keys, no overwrite
```

## Common Pitfalls

### `array_merge()`

1. **Unexpected reindexing**
   ```php
   $a = [10 => 'a', 20 => 'b'];
   $b = [30 => 'c'];
   $result = array_merge($a, $b);
   // [0 => 'a', 1 => 'b', 2 => 'c'] (keys reset)
   ```

2. **Overwriting behavior**
   ```php
   $a = ['color' => 'red'];
   $b = ['color' => 'blue'];
   $result = array_merge($a, $b);
   // ['color' => 'blue'] (no warning)
   ```

### `array_combine()`

1. **Length mismatch**
   ```php
   $keys = ['a', 'b'];
   $values = [1];
   $result = array_combine($keys, $values); // Warning
   ```

2. **Invalid keys**
   ```php
   $keys = [['invalid'], 'valid'];
   $values = [1, 2];
   $result = array_combine($keys, $values); // Warning for array key
   ```

## Advanced Patterns

### Recursive Merge

```php
function deep_merge($a, $b) {
    $merged = $a;
    foreach ($b as $key => $value) {
        if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
            $merged[$key] = deep_merge($merged[$key], $value);
        } else {
            $merged[$key] = $value;
        }
    }
    return $merged;
}
```

### Safe Combination

```php
function safe_combine($keys, $values, $default = null) {
    $result = [];
    $count = min(count($keys), count($values));
    for ($i = 0; $i < $count; $i++) {
        $result[$keys[$i]] = $values[$i];
    }
    // Handle remaining keys
    for ($i = $count; $i < count($keys); $i++) {
        $result[$keys[$i]] = $default;
    }
    return $result;
}
```

### Multi-dimensional Combine

```php
function multi_combine($keys, $arrayOfValueArrays) {
    return array_map(function($values) use ($keys) {
        return array_combine($keys, $values);
    }, $arrayOfValueArrays);
}

// Usage:
$data = multi_combine(
    ['id', 'name'],
    [
        [1, 'John'],
        [2, 'Jane']
    ]
);
```

## Comparison with Similar Functions

### vs `+` Operator

- `+` doesn't reindex numeric keys
- `+` doesn't overwrite existing keys
- `array_merge()` more flexible for associative arrays

### vs `array_replace()`

- `array_replace()` preserves numeric keys
- `array_replace()` doesn't reindex
- Both overwrite string keys

### vs `array_map()`

- `array_map()` transforms elements
- `array_combine()` creates new structure
- Can be used together effectively

## When to Use Each

### Use `array_merge()` when:
- You need to combine multiple arrays
- You want to reindex numeric keys
- You're working with associative data
- You want later arrays to overwrite earlier ones

### Use `array_combine()` when:
- You have separate key and value arrays
- You need to create an associative array
- You're mapping database results
- You want to pair related datasets

Remember: `array_merge_recursive()` exists for merging nested arrays, and `array_replace()` is often better when you need to preserve numeric keys. Always consider the specific requirements of your use case when choosing between these functions.