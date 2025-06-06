# Variable Functions in PHP

## Definition
Variable functions allow you to call a function using a variable name. When you append parentheses `()` to a variable containing a function name, PHP will look for and execute a function with that name.

## Basic Syntax

### Simple Variable Function
```php
function sayHello() {
    echo "Hello!";
}

$func = 'sayHello';
$func(); // Calls sayHello()
```

### With Parameters
```php
function greet($name) {
    echo "Hello, $name!";
}

$function = 'greet';
$function('Alice'); // Calls greet('Alice')
```

## How Variable Functions Work

1. PHP evaluates the variable to get the function name
2. It checks if a function with that name exists
3. If found, calls the function with any provided arguments
4. If not found, throws an error (unless using `is_callable()` check)

## Common Use Cases

### Dynamic Function Calls
```php
$action = 'create';
$function = $action . 'User';
if (function_exists($function)) {
    $function(); // Calls createUser()
}
```

### Callback Systems
```php
$validators = [
    'email' => 'validateEmail',
    'phone' => 'validatePhone'
];

function validateEmail($value) { /* ... */ }
function validatePhone($value) { /* ... */ }

foreach ($validators as $type => $validator) {
    if (function_exists($validator)) {
        $validator($input[$type]);
    }
}
```

### Command Pattern
```php
function start() { echo "Starting..."; }
function stop() { echo "Stopping..."; }
function restart() { echo "Restarting..."; }

$command = $_GET['command'] ?? 'start';
$function = strtolower($command);

if (function_exists($function)) {
    $function();
}
```

## Advanced Techniques

### With Class Methods
```php
class Calculator {
    public function add($a, $b) { return $a + $b; }
    public static function subtract($a, $b) { return $a - $b; }
}

$calc = new Calculator();
$method = 'add';
echo $calc->$method(5, 3); // 8

$staticMethod = 'subtract';
echo Calculator::$staticMethod(5, 3); // 2
```

### Array of Functions
```php
$operations = [
    'sum' => function($a, $b) { return $a + $b; },
    'diff' => function($a, $b) { return $a - $b; }
];

$op = 'sum';
echo $operations[$op](5, 3); // 8
```

### Variable Static Method Calls
```php
class StringUtils {
    public static function upper($str) {
        return strtoupper($str);
    }
}

$method = 'upper';
echo StringUtils::$method('hello'); // "HELLO"
```

## Safety Considerations

### Checking Function Existence
```php
$function = 'nonExistentFunction';
if (function_exists($function)) {
    $function();
} else {
    echo "Function does not exist";
}
```

### Using is_callable()
```php
$callable = 'someFunction';
if (is_callable($callable)) {
    $callable();
}
```

## Limitations

1. **Doesn't work with language constructs** like `echo`, `isset`, `empty`, etc.
   ```php
   $print = 'echo';
   $print('Hello'); // Error
   ```

2. **Can't use with private/protected methods** without proper context
3. **Security risk** if using unvalidated user input

## Best Practices

1. **Validate function names** before calling
2. **Use allowlists** for dynamic function names
3. **Prefer explicit calls** when possible
4. **Document dynamic behavior** clearly

```php
/**
 * Dynamically calls validation functions
 * @param string $type The validation type (must be in allowed list)
 * @param mixed $value The value to validate
 * @return bool
 * @throws InvalidArgumentException
 */
function validate($type, $value) {
    $allowed = ['email', 'phone', 'date'];
    $function = 'validate' . ucfirst($type);
    
    if (!in_array($type, $allowed) || !function_exists($function)) {
        throw new InvalidArgumentException("Invalid validator: $type");
    }
    
    return $function($value);
}
```

## Performance Considerations

1. **Slightly slower** than direct function calls
2. **Negligible overhead** for most applications
3. **Cache function names** if used repeatedly

## Comparison with Alternatives

### vs call_user_func()
```php
// Variable function
$func = 'strtoupper';
echo $func('hello');

// call_user_func
echo call_user_func('strtoupper', 'hello');
```

### vs Anonymous Functions
```php
// Variable function
function double($n) { return $n * 2; }
$operation = 'double';
echo $operation(5);

// Anonymous function
$operation = function($n) { return $n * 2; };
echo $operation(5);
```

## Security Considerations

### Dangerous Example (Don't Do This)
```php
$function = $_GET['function'];
$function(); // Arbitrary code execution!
```

### Safe Example
```php
$allowed = ['safeFunc1', 'safeFunc2'];
$function = $_GET['function'];

if (in_array($function, $allowed) && function_exists($function)) {
    $function();
}
```

## Special Cases

### Magic __call() Method
```php
class Dynamic {
    public function __call($name, $args) {
        if ($name === 'special') {
            echo "Called special method";
        }
    }
}

$obj = new Dynamic();
$method = 'special';
$obj->$method(); // Calls __call()
```

### Variable Method Chaining
```php
class QueryBuilder {
    public function select($columns) { /* ... */ return $this; }
    public function where($condition) { /* ... */ return $this; }
}

$qb = new QueryBuilder();
$methods = ['select', 'where'];

$qb->{$methods[0]}('*')->{$methods[1]}('id = 1');
```

Remember: Variable functions are powerful but should be used judiciously. They're excellent for implementing patterns like plugins, callbacks, and command systems, but can make code harder to follow and potentially less secure if not properly controlled. Always validate function names and prefer more explicit approaches when possible.