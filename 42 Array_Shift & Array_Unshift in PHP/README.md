# `array_shift()` and `array_unshift()` in PHP

## Definition

These functions are used to manipulate arrays by adding or removing elements from the beginning of an array.

## `array_shift()`

### Basic Syntax

```php
mixed array_shift(array &$array)
```

### Key Characteristics

1. **Removes first element** - Takes the first element off the array
2. **Modifies original array** - The input array is passed by reference and changed
3. **Returns removed value** - Returns the value of the removed element
4. **Re-indexes numeric keys** - All numeric keys are re-indexed starting from 0
5. **Returns null for empty array** - If array is empty, returns NULL without warning

### Common Examples

#### Basic Usage

```php
$queue = ['apple', 'banana', 'cherry'];
$fruit = array_shift($queue);

// $fruit = 'apple'
// $queue = ['banana', 'cherry'] (keys reindexed to 0,1)
```

#### Empty Array Handling

```php
$empty = [];
$result = array_shift($empty);

// $result = NULL
// $empty remains []
```

#### Using in Loop

```php
$queue = [1, 2, 3, 4, 5];
while ($item = array_shift($queue)) {
    echo $item . "\n";
}
// Outputs: 1 2 3 4 5
```

### Best Practices

1. **Check array length first** - Especially if you need the array to have elements
2. **Use for queue operations** - Perfect for FIFO (First-In-First-Out) structures
3. **Be aware of reindexing** - Numeric keys will be reset
4. **Avoid on associative arrays** - String keys are preserved but order may change

```php
// Good practice - check before shifting
if (!empty($queue)) {
    $value = array_shift($queue);
}

// Be careful with mixed key arrays
$value = array_shift($mixedKeyArray); // May reindex numeric keys
```

## `array_unshift()`

### Basic Syntax

```php
int array_unshift(array &$array, mixed ...$values)
```

### Key Characteristics

1. **Adds to beginning of array** - Prepends elements to the start of the array
2. **Modifies original array** - The input array is passed by reference and changed
3. **Accepts multiple values** - Can unshift one or more elements at once
4. **Returns new count** - Returns the new number of elements in the array
5. **Re-indexes numeric keys** - All numeric keys are re-indexed starting from 0

### Common Examples

#### Basic Usage

```php
$queue = ['banana', 'cherry'];
$count = array_unshift($queue, 'apple');

// $queue = ['apple', 'banana', 'cherry']
// $count = 3
```

#### Single Element

```php
$list = [2, 3];
array_unshift($list, 1);

// $list = [1, 2, 3]
```

#### Multiple Elements

```php
$queue = ['end'];
array_unshift($queue, 'start', 'middle1', 'middle2');

// $queue = ['start', 'middle1', 'middle2', 'end']
```

### Best Practices

1. **Use for prepending elements** - When you need elements at the start
2. **Consider performance** - Slower than `array_push()` for large arrays
3. **Watch for reindexing** - All numeric keys will be reset
4. **Preserves string keys** - Associative elements keep their keys

```php
// Good for queue implementations
array_unshift($processingQueue, $highPriorityItem);

// Be mindful of performance with large arrays
array_unshift($largeArray, $newElement); // Expensive operation
```

## Comparison Table

| Feature                | `array_shift()` | `array_unshift()` |
|------------------------|-----------------|-------------------|
| Operation              | Removes first element | Adds to start |
| Modifies Original      | Yes              | Yes             |
| Return Value           | Removed element  | New count       |
| Multiple Values        | No (only one)    | Yes             |
| Key Handling           | Reindexes numeric | Reindexes numeric |
| Empty Array Handling   | Returns NULL     | Adds elements   |

## Common Use Cases

### `array_shift()`

1. **Queue implementations**
   ```php
   $queue = ['task1', 'task2', 'task3'];
   $current = array_shift($queue); // Process task1 first
   ```

2. **Processing ordered lists**
   ```php
   while ($item = array_shift($processingList)) {
       handleItem($item);
   }
   ```

3. **Removing headers from data**
   ```php
   $csvRows = array_shift($csvData); // Remove header row
   ```

### `array_unshift()`

1. **Adding priority items**
   ```php
   $workQueue = ['standard1', 'standard2'];
   array_unshift($workQueue, 'urgent'); // Add to front
   ```

2. **Building reverse-ordered lists**
   ```php
   $reversed = [];
   foreach ($original as $item) {
       array_unshift($reversed, $item);
   }
   ```

3. **Prepending metadata**
   ```php
   $data = ['content' => '...'];
   array_unshift($data, ['timestamp' => time()], ['version' => 1]);
   ```

## Performance Considerations

1. **Shift/unshift are expensive** - Require reindexing of the entire array
2. **Large arrays** - Performance degrades with array size (O(n) complexity)
3. **Alternatives for queues** - Consider `SplQueue` from SPL for better performance
4. **Push/pop are faster** - For stack operations where order doesn't matter

```php
// For large queues, consider alternatives
$queue = new SplQueue();
$queue->enqueue('item1');  // Faster than array_push
$item = $queue->dequeue(); // Faster than array_shift
```

## Common Pitfalls

1. **Unexpected reindexing**
   ```php
   $array = [10 => 'a', 20 => 'b'];
   array_shift($array);
   // $array is now [0 => 'b'] (numeric keys reset)
   ```

2. **Performance with large arrays**
   ```php
   $largeArray = range(1, 100000);
   array_unshift($largeArray, 0); // Very expensive
   ```

3. **Mixed key arrays**
   ```php
   $array = ['a' => 'A', 1 => 'B'];
   array_shift($array);
   // $array is now [0 => 'B'] (string key 'a' removed)
   ```

4. **Empty array handling**
   ```php
   $empty = [];
   $val = array_shift($empty); // NULL, no warning
   ```

## Advanced Patterns

### Queue Implementation

```php
class SimpleQueue {
    private $elements = [];
    
    public function enqueue($item) {
        array_push($this->elements, $item);
    }
    
    public function dequeue() {
        return array_shift($this->elements);
    }
    
    public function peek() {
        return empty($this->elements) ? null : $this->elements[0];
    }
    
    public function isEmpty() {
        return empty($this->elements);
    }
}
```

### Priority Prepend

```php
function addWithPriority(&$array, $item, $priority = false) {
    if ($priority) {
        array_unshift($array, $item);
    } else {
        array_push($array, $item);
    }
}
```

### Multi-queue Management

```php
$queues = [
    'high' => [],
    'normal' => [],
    'low' => []
];

function processQueues(&$queues) {
    // Process high priority first
    while (!empty($queues['high'])) {
        processItem(array_shift($queues['high']));
    }
    // Then normal
    while (!empty($queues['normal'])) {
        processItem(array_shift($queues['normal']));
    }
    // Finally low
    while (!empty($queues['low'])) {
        processItem(array_shift($queues['low']));
    }
}
```

## Comparison with Similar Functions

### vs `array_pop()`/`array_push()`

- Pop/push operate on end of array (faster)
- Shift/unshift operate on beginning (slower)
- Different use cases (stack vs queue)

### vs `array_splice()`

- `array_splice()` can remove/add anywhere in array
- More flexible but more complex syntax
- Similar performance characteristics for start operations

### vs Direct Assignment

```php
// Equivalent to array_unshift($arr, $val) for single element (but slower)
$arr = array_merge([$val], $arr);

// Equivalent to array_shift() (but preserves keys)
$first = reset($arr);
unset($arr[key($arr)]);
```

## When to Use Each

### Use `array_shift()` when:
- You need to process elements in FIFO order
- You're implementing queue data structures
- You need to remove and get the first element
- You don't mind numeric keys being reindexed

### Use `array_unshift()` when:
- You need to add elements to the beginning
- You're implementing priority queues
- You need to prepend metadata or headers
- You want to build reverse-ordered arrays

Remember: Both functions modify the original array. For queue operations with large datasets, consider using SPL's `SplQueue` for better performance. For immutable operations, consider creating new arrays instead of modifying existing ones.