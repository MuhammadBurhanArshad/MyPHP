# `array_values()` and `array_unique()` in PHP

## Definition

These functions are used to manipulate arrays by extracting values or removing duplicate values.

## `array_values()`

### Basic Syntax

```php
array array_values(array $array)
```

### Key Characteristics

1. **Returns all values** - Creates a new array containing all the values from the input array
2. **Re-indexes numerically** - The returned array has sequential numeric keys starting from 0
3. **Non-destructive** - Original array remains unchanged
4. **Works with all array types** - Handles both indexed and associative arrays
5. **Preserves order** - Maintains the original order of values

### Common Examples

#### Basic Usage

```php
$assoc = ['a' => 'apple', 'b' => 'banana', 'c' => 'cherry'];
$values = array_values($assoc);

// $values = [0 => 'apple', 1 => 'banana', 2 => 'cherry']
```

#### Reindexing an Array

```php
$sparse = [10 => 'ten', 20 => 'twenty', 30 => 'thirty'];
$dense = array_values($sparse);

// $dense = [0 => 'ten', 1 => 'twenty', 2 => 'thirty']
```

#### With Mixed Keys

```php
$mixed = ['a' => 'apple', 5 => 'banana', 'c' => 'cherry', 10 => 'date'];
$result = array_values($mixed);

// $result = [0 => 'apple', 1 => 'banana', 2 => 'cherry', 3 => 'date']
```

### Best Practices

1. **Use when you need sequential numeric keys**
   ```php
   $data = ['id' => 123, 'name' => 'John'];
   $csvRow = array_values($data); // Good for CSV export
   ```

2. **Combine with other array functions**
   ```php
   $filtered = array_values(array_filter($array, $callback));
   ```

3. **Preserve order when keys don't matter**
   ```php
   $orderedValues = array_values($unorderedAssocArray);
   ```

4. **Avoid when you need to preserve keys**
   ```php
   // Bad if you need the original keys later
   $lossy = array_values($keyImportantArray);
   ```

## `array_unique()`

### Basic Syntax

```php
array array_unique(array $array, int $flags = SORT_STRING)
```

### Key Characteristics

1. **Removes duplicate values** - Returns new array without duplicate values
2. **Preserves first occurrence** - Keeps the first instance of each value
3. **Optional sort flags** - Controls comparison behavior (SORT_STRING, SORT_NUMERIC, SORT_REGULAR)
4. **Non-destructive** - Original array remains unchanged
5. **Key preservation** - Maintains original keys for kept values

### Common Examples

#### Basic Usage

```php
$duplicates = ['a', 'b', 'a', 'c', 'b', 'a'];
$unique = array_unique($duplicates);

// $unique = [0 => 'a', 1 => 'b', 3 => 'c']
```

#### With Associative Arrays

```php
$users = [
    101 => 'John',
    102 => 'Jane',
    103 => 'John',
    104 => 'Doe',
    105 => 'Jane'
];
$uniqueNames = array_unique($users);

// $uniqueNames = [101 => 'John', 102 => 'Jane', 104 => 'Doe']
```

#### Using Sort Flags

```php
$numbers = [1, '1', 2, '2', 3, 3.0];
$strictUnique = array_unique($numbers, SORT_REGULAR);

// $strictUnique = [0 => 1, 2 => 2, 4 => 3]
```

### Best Practices

1. **Choose the right comparison flag**
   ```php
   // For case-insensitive comparison
   $unique = array_unique(array_map('strtolower', $array));
   ```

2. **Combine with array_values() for reindexing**
   ```php
   $uniqueReindexed = array_values(array_unique($array));
   ```

3. **Be mindful of data types**
   ```php
   // '1' (string) and 1 (int) are treated as same with SORT_STRING
   $unique = array_unique($mixedTypes, SORT_REGULAR);
   ```

4. **Consider array_count_values() for counts**
   ```php
   $counts = array_count_values($array);
   $unique = array_keys($counts);
   ```

## Comparison Table

| Feature                | `array_values()` | `array_unique()` |
|------------------------|------------------|------------------|
| Primary Purpose        | Extract values   | Remove duplicates |
| Return Type            | New array        | New array        |
| Key Handling           | Reindexes to 0-n | Preserves keys   |
| Original Array         | Unchanged        | Unchanged        |
| Order Preservation     | Yes              | Yes (first occurrence) |
| Flags/Options          | None             | SORT_STRING, SORT_NUMERIC, SORT_REGULAR |

## Common Use Cases

### `array_values()`

1. **Converting associative to indexed arrays**
   ```php
   $config = ['host' => 'localhost', 'port' => 3306];
   $values = array_values($config); // ['localhost', 3306]
   ```

2. **Resetting array keys**
   ```php
   $array = [10 => 'a', 20 => 'b'];
   $reindexed = array_values($array); // [0 => 'a', 1 => 'b']
   ```

3. **Preparing data for JSON**
   ```php
   $data = ['results' => array_values($assocData)];
   echo json_encode($data);
   ```

### `array_unique()`

1. **Removing duplicate entries**
   ```php
   $tags = ['php', 'mysql', 'php', 'javascript', 'mysql'];
   $uniqueTags = array_unique($tags);
   ```

2. **Creating distinct value lists**
   ```php
   $countries = array_column($users, 'country');
   $uniqueCountries = array_unique($countries);
   ```

3. **Data cleaning**
   ```php
   $cleaned = array_unique(array_map('trim', $input));
   ```

## Performance Considerations

1. **`array_values()` is generally fast** - O(n) complexity
2. **`array_unique()` can be slower** - O(n log n) due to sorting internally
3. **Large arrays** - `array_unique()` may have significant memory usage
4. **Alternatives for unique values** - Consider `array_flip()` for certain cases

```php
// Faster alternative for string values (but loses original values)
$unique = array_keys(array_flip($array));

// For large datasets, consider database-level DISTINCT
$unique = $db->query('SELECT DISTINCT column FROM table')->fetchAll();
```

## Common Pitfalls

### `array_values()`

1. **Losing key information**
   ```php
   $map = ['a' => 'Apple', 'b' => 'Banana'];
   $lostKeys = array_values($map); // Can't get back to original keys
   ```

2. **Unnecessary use on indexed arrays**
   ```php
   $alreadyIndexed = [0 => 'a', 1 => 'b'];
   $redundant = array_values($alreadyIndexed); // No change
   ```

### `array_unique()`

1. **Type comparison issues**
   ```php
   $data = [0, '0', false, null];
   $unique = array_unique($data); // May not work as expected
   ```

2. **Multidimensional arrays**
   ```php
   $multi = [['id'=>1], ['id'=>1]]; 
   $unique = array_unique($multi); // Doesn't work as expected
   ```

3. **Case sensitivity**
   ```php
   $names = ['John', 'john', 'JOHN'];
   $unique = array_unique($names); // All kept as different
   ```

## Advanced Patterns

### Multidimensional Unique

```php
function array_unique_multidimensional($array, $key) {
    $temp = [];
    $unique = [];
    
    foreach ($array as $item) {
        if (!in_array($item[$key], $temp)) {
            $temp[] = $item[$key];
            $unique[] = $item;
        }
    }
    return $unique;
}
```

### Case-Insensitive Unique

```php
function array_unique_case_insensitive($array) {
    return array_intersect_key(
        $array,
        array_unique(array_map('strtolower', $array))
    );
}
```

### Unique Objects by Property

```php
function unique_objects($objects, $property) {
    $unique = [];
    $used = [];
    
    foreach ($objects as $obj) {
        if (!in_array($obj->$property, $used)) {
            $used[] = $obj->$property;
            $unique[] = $obj;
        }
    }
    return $unique;
}
```

## Comparison with Similar Functions

### vs `array_keys()`

- `array_keys()` returns keys instead of values
- `array_keys()` can filter by specific value
- Both reindex numerically when returning

### vs `array_count_values()`

- `array_count_values()` returns counts of each value
- Useful when you need both unique values and their frequencies
- Returns associative array with values as keys

### vs `array_flip()`

- `array_flip()` exchanges keys and values
- Can be used to deduplicate (values must be valid keys)
- Faster than `array_unique()` but has limitations

## When to Use Each

### Use `array_values()` when:
- You need to reset numeric keys to 0-based sequence
- You want to convert associative array to indexed array
- You need to ensure sequential keys for functions that expect them
- You want to discard keys but preserve order

### Use `array_unique()` when:
- You need to remove duplicate values from an array
- You want to get distinct values while preserving first occurrence
- You need to clean data with potential duplicates
- You're working with flat, one-dimensional arrays

Remember: Both functions return new arrays and don't modify the original. For complex duplicate removal (like multidimensional arrays), you'll need custom solutions. For large datasets, consider alternative approaches to `array_unique()` for better performance.