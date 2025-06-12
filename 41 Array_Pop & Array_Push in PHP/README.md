# `array_pop()` and `array_push()` in PHP

## Definition

These functions are used to manipulate arrays by adding or removing elements from the end of an array (the "top" of the stack).

## `array_pop()`

### Basic Syntax

```php
mixed array_pop(array &$array)
```

### Key Characteristics

1. **Removes last element** - Takes the last element off the array
2. **Modifies original array** - The input array is passed by reference and changed
3. **Returns removed value** - Returns the value of the removed element
4. **Reduces array length** - The array's length decreases by 1
5. **Returns null for empty array** - If array is empty, returns NULL without warning

### Common Examples

#### Basic Usage

```php
$stack = ['apple', 'banana', 'cherry'];
$fruit = array_pop($stack);

// $fruit = 'cherry'
// $stack = ['apple', 'banana']
```

#### Empty Array Handling

```php
$empty = [];
$result = array_pop($empty);

// $result = NULL
// $empty remains []
```

#### Using in Loop

```php
$stack = [1, 2, 3, 4, 5];
while ($item = array_pop($stack)) {
    echo $item . "\n";
}
// Outputs: 5 4 3 2 1
```

### Best Practices

1. **Check array length first** - Especially if you need the array to have elements
2. **Use for stack operations** - Perfect for LIFO (Last-In-First-Out) structures
3. **Combine with array_push** - For complete stack functionality
4. **Avoid on associative arrays** - Behavior is less predictable with mixed keys

```php
// Good practice - check before popping
if (!empty($stack)) {
    $value = array_pop($stack);
}

// Avoid unless you're sure about the array structure
$value = array_pop($mixedKeyArray);
```

## `array_push()`

### Basic Syntax

```php
int array_push(array &$array, mixed ...$values)
```

### Key Characteristics

1. **Adds to end of array** - Pushes elements onto the end of the array
2. **Modifies original array** - The input array is passed by reference and changed
3. **Accepts multiple values** - Can push one or more elements at once
4. **Returns new count** - Returns the new number of elements in the array
5. **Uses numeric keys** - Always adds with numeric indices (even for associative arrays)

### Common Examples

#### Basic Usage

```php
$stack = ['apple'];
$count = array_push($stack, 'banana', 'cherry');

// $stack = ['apple', 'banana', 'cherry']
// $count = 3
```

#### Single Element

```php
$stack = [];
array_push($stack, 'first');

// $stack = ['first']
```

#### Multiple Elements

```php
$queue = ['start'];
array_push($queue, 'middle1', 'middle2', 'end');

// $queue = ['start', 'middle1', 'middle2', 'end']
```

### Best Practices

1. **Consider using `$array[] =` for single elements** - It's faster
2. **Use for multiple elements** - More readable than multiple `[]=` assignments
3. **Watch for numeric reindexing** - All pushed elements get numeric keys
4. **Check return value** - The count can be useful for tracking size

```php
// Good for single elements (faster)
$array[] = 'value';

// Better for multiple elements
array_push($array, $val1, $val2, $val3);

// Be careful with associative arrays
array_push($assocArray, $value); // Adds with numeric key
```

## Comparison Table

| Feature                | `array_pop()` | `array_push()` |
|------------------------|---------------|----------------|
| Operation              | Removes last element | Adds to end |
| Modifies Original      | Yes            | Yes           |
| Return Value           | Removed element | New count    |
| Multiple Values        | No (only one)  | Yes           |
| Key Handling           | Preserves keys | Always numeric for new |
| Empty Array Handling   | Returns NULL   | Adds elements |

## Common Use Cases

### `array_pop()`

1. **Stack implementations**
   ```php
   $stack = [];
   array_push($stack, 'task1');
   array_push($stack, 'task2');
   $task = array_pop($stack); // Process task2 first
   ```

2. **Reversing arrays**
   ```php
   $reversed = [];
   while ($item = array_pop($original)) {
       $reversed[] = $item;
   }
   ```

3. **Processing nested structures**
   ```php
   while ($node = array_pop($nodeStack)) {
       // Process node and push children
   }
   ```

### `array_push()`

1. **Building collections**
   ```php
   $results = [];
   foreach ($data as $item) {
       if ($item->isValid()) {
           array_push($results, $item->process());
       }
   }
   ```

2. **Batch adding elements**
   ```php
   $configItems = ['base'];
   array_push($configItems, 'security', 'logging', 'database');
   ```

3. **Queue/Stack management**
   ```php
   $queue = ['first'];
   array_push($queue, 'second', 'third'); // Though shift/unshift better for queues
   ```

## Performance Considerations

1. **`$array[] =` vs `array_push()`** - The `[]` syntax is faster for single elements
2. **Large arrays** - Popping is always O(1), pushing is O(1) per element
3. **Alternative functions** - Consider `array_shift()`/`array_unshift()` for queue behavior

```php
// Benchmark example
$start = microtime(true);
$array = [];
for ($i = 0; $i < 100000; $i++) {
    $array[] = $i; // Faster
}
$end = microtime(true);

$start2 = microtime(true);
$array = [];
for ($i = 0; $i < 100000; $i++) {
    array_push($array, $i); // Slower
}
$end2 = microtime(true);
```

## Common Pitfalls

1. **Assuming pop returns specific type**
   ```php
   $value = array_pop($array);
   // $value could be any type or NULL
   ```

2. **Reference issues**
   ```php
   $last = &array_pop($array); // Won't work as expected
   ```

3. **Key confusion with push**
   ```php
   $assoc = ['name' => 'John'];
   array_push($assoc, 'Doe'); // Adds with numeric key (0)
   ```

4. **Empty array handling**
   ```php
   $empty = [];
   $val = array_pop($empty); // NULL, no warning
   ```

## Advanced Patterns

### Implementing a Stack

```php
class Stack {
    private $elements = [];
    
    public function push($item) {
        array_push($this->elements, $item);
    }
    
    public function pop() {
        return array_pop($this->elements);
    }
    
    public function isEmpty() {
        return empty($this->elements);
    }
}
```

### Batch Processing with Pop

```php
$batchSize = 100;
$items = [/*... large array ...*/];

while (!empty($items)) {
    $batch = [];
    for ($i = 0; $i < $batchSize && !empty($items); $i++) {
        $batch[] = array_pop($items);
    }
    processBatch($batch);
}
```

### Multi-stack Management

```php
$stacks = [
    'log' => [],
    'error' => [],
    'debug' => []
];

function addToStack($stackName, $value) {
    global $stacks;
    if (isset($stacks[$stackName])) {
        array_push($stacks[$stackName], $value);
    }
}

function processStack($stackName) {
    global $stacks;
    if (!empty($stacks[$stackName])) {
        return array_pop($stacks[$stackName]);
    }
    return null;
}
```

## Comparison with Similar Functions

### vs `array_shift()`/`array_unshift()`

- `array_shift()` removes from beginning (expensive for large arrays)
- `array_unshift()` adds to beginning (expensive for large arrays)
- Pop/push are more efficient for stack operations

### vs Direct Assignment

```php
$array[] = $value; // Faster than array_push($array, $value)
$last = $array[count($array)-1]; unset($array[count($array)-1]); // Like array_pop
```

### vs `array_splice()`

- `array_splice()` can remove/add anywhere in array
- More flexible but more complex
- Less efficient for simple stack operations

## When to Use Each

### Use `array_pop()` when:
- You need to process elements in LIFO order
- You want to efficiently remove the last element
- You're implementing stack data structures
- You need the removed value

### Use `array_push()` when:
- You need to add multiple elements at once
- You want readable code for adding to arrays
- You need the new count of elements
- You're working with numeric-indexed arrays

Remember: Both functions modify the original array. For immutable operations, consider creating new arrays instead. For queue operations (FIFO), `array_shift()` and `array_push()` might be more appropriate, though not as performant for large arrays.