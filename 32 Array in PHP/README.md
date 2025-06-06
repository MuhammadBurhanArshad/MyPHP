# Arrays in PHP: Global vs Local Scope

## Definition
Arrays in PHP follow the same scoping rules as other variables, but their behavior in different scopes has some unique considerations due to their complex data structure nature.

## Global Arrays

### Declaration and Access
```php
// Global array declaration
$globalArray = ['apple', 'banana', 'cherry'];

function accessGlobalArray() {
    // Won't work without global keyword
    // echo $globalArray[0]; // Notice: Undefined variable
    
    // Proper way to access global array
    global $globalArray;
    echo $globalArray[0]; // Outputs: apple
}

accessGlobalArray();
```

### Using $GLOBALS with Arrays
```php
$config = [
    'db_host' => 'localhost',
    'db_user' => 'admin'
];

function getDbConfig() {
    echo $GLOBALS['config']['db_host']; // Outputs: localhost
}
```

### Modifying Global Arrays
```php
$cart = ['item1', 'item2'];

function addToCart($item) {
    global $cart;
    $cart[] = $item;
}

addToCart('item3');
print_r($cart); // Array now contains item1, item2, item3
```

## Local Arrays

### Basic Usage
```php
function processData() {
    // Local array
    $localArray = [1, 2, 3];
    
    // Modify local array
    $localArray[] = 4;
    return $localArray;
}

$result = processData();
print_r($result); // Array ( [0] => 1 [1] => 2 [2] => 3 [3] => 4 )
```

### Array Parameters and Return Values
```php
function filterEvenNumbers($numbers) {
    $filtered = [];
    foreach ($numbers as $num) {
        if ($num % 2 === 0) {
            $filtered[] = $num;
        }
    }
    return $filtered;
}

$numbers = [1, 2, 3, 4, 5, 6];
$evens = filterEvenNumbers($numbers);
print_r($evens); // Array ( [0] => 2 [1] => 4 [2] => 6 )
```

## Key Differences for Arrays

| Characteristic      | Global Arrays                  | Local Arrays                   |
|---------------------|--------------------------------|--------------------------------|
| Memory Usage        | Persist through entire script  | Freed when function ends       |
| Modification        | Requires `global` keyword      | Directly modifiable            |
| Performance Impact  | Potential memory overhead      | More memory efficient          |
| Best Practices      | Rarely modify in functions     | Preferred for most operations  |

## Common Use Cases

### Configuration as Global Array
```php
$appConfig = [
    'debug' => true,
    'environment' => 'development',
    'database' => [
        'host' => 'localhost',
        'name' => 'myapp'
    ]
];

function getDatabaseName() {
    global $appConfig;
    return $appConfig['database']['name'];
}
```

### Processing Local Arrays
```php
function calculateStats($data) {
    $stats = [
        'count' => count($data),
        'sum' => array_sum($data),
        'avg' => array_sum($data) / count($data)
    ];
    return $stats;
}

$numbers = [10, 20, 30, 40, 50];
$result = calculateStats($numbers);
print_r($result);
```

## Advanced Techniques

### Passing Arrays by Reference
```php
function modifyArray(&$array) {
    $array['modified'] = true;
}

$myArray = ['original' => true];
modifyArray($myArray);
print_r($myArray); // Now contains 'modified' key
```

### Static Local Arrays
```php
function rememberCalls() {
    static $callLog = [];
    $callLog[] = date('Y-m-d H:i:s');
    return $callLog;
}

rememberCalls();
rememberCalls();
print_r(rememberCalls()); // Shows all three call times
```

### Array Destructuring in Different Scopes
```php
// Global destructuring
$globalInfo = ['John', 'Doe', 42];
[$firstName, $lastName, $age] = $globalInfo;

function processPerson() {
    // Local destructuring
    $person = ['Alice', 'Smith', 30];
    [$first, $last, $age] = $person;
    return "$first $last is $age years old";
}
```

## Best Practices

1. **Avoid modifying global arrays directly** - Pass them as parameters instead
2. **Use array functions** - `array_map`, `array_filter` etc. work well with local arrays
3. **Document array structures** - Especially for global arrays
4. **Consider array constants** - For read-only configuration:
   ```php
   define('COLORS', [
       'primary' => 'blue',
       'secondary' => 'green'
   ]);
   ```

## Common Pitfalls

1. **Accidental global array overwrite**
   ```php
   function badPractice() {
       $config = []; // Creates new local array instead of using global
       // Should have used: global $config;
   }
   ```

2. **Reference confusion**
   ```php
   $original = [1, 2, 3];
   $reference = &$original;
   function modify($arr) {
       $arr[0] = 99; // Doesn't affect $original
   }
   modify($original);
   ```

3. **Unexpected array copying**
   ```php
   $bigArray = range(1, 1000000);
   function process($arr) {
       // $arr is a copy (memory intensive for large arrays)
   }
   ```

## Performance Considerations

1. **Large global arrays** - Stay in memory through entire execution
2. **Array copying** - PHP uses copy-on-write, but large arrays passed to functions use memory
3. **References** - Can reduce memory usage but make code harder to follow

## When to Use Each

### Use Global Arrays When:
1. Storing application-wide configuration
2. Maintaining truly global state (rarely needed)
3. Working with legacy code that requires global access

### Use Local Arrays When:
1. Processing data within a function
2. Returning multiple values from a function
3. Working with temporary or intermediate data

## Special Cases

### Superglobal Arrays
PHP provides several built-in global arrays:
```php
function handleRequest() {
    // Access superglobals without global keyword
    $name = $_GET['name'] ?? 'Guest';
    $_SESSION['visits'] = ($_SESSION['visits'] ?? 0) + 1;
}
```

### ArrayObject for Reference Semantics
```php
$globalArray = new ArrayObject(['a', 'b', 'c']);

function modifyArrayObject($arrObj) {
    // No need for reference or global keyword
    $arrObj[] = 'd';
}

modifyArrayObject($globalArray);
print_r($globalArray); // Now includes 'd'
```

## Debugging Array Scope Issues

1. **Check array existence**
   ```php
   function safeArrayAccess() {
       if (isset($GLOBALS['config']['db_host'])) {
           return $GLOBALS['config']['db_host'];
       }
       return 'default';
   }
   ```

2. **Debug output**
   ```php
   function debugArray() {
       global $cart;
       echo '<pre>'; print_r($cart); echo '</pre>';
   }
   ```

3. **Track modifications**
   ```php
   $originalArray = [1, 2, 3];
   $before = $originalArray;
   someFunction($originalArray);
   $diff = array_diff($originalArray, $before);
   ```

Remember: Arrays follow the same scoping rules as other variables in PHP, but their complex nature means you should be especially careful with memory usage and unintended modifications. Prefer working with local arrays and passing them as parameters rather than relying on global array state.