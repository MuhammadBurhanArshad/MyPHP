# Variable Scope in PHP: Global vs Local

## Definition
Variable scope determines where in a PHP program a variable can be accessed. PHP has two main types of variable scope: global and local.

## Global Variables

### Definition
Global variables are declared outside of any function and can be accessed from anywhere in the script, except from within functions (unless specifically declared global inside the function).

### Basic Syntax
```php
$globalVar = "I'm global"; // Global variable

function testFunction() {
    // This won't work - $globalVar is not accessible here by default
    // echo $globalVar; // Would cause a warning/notice
}

testFunction();
echo $globalVar; // Works fine outside function
```

### Accessing Global Variables Inside Functions
```php
$globalVar = "I'm global";

function accessGlobal() {
    global $globalVar; // Import global variable
    echo $globalVar; // Now it works
}

accessGlobal();
```

### Using $GLOBALS Superglobal
```php
$globalVar = "I'm global";

function useGlobals() {
    echo $GLOBALS['globalVar']; // Access through $GLOBALS array
}

useGlobals();
```

### Best Practices for Global Variables
1. **Minimize use** - Can lead to tight coupling and hard-to-maintain code
2. **Use constants** - For values that shouldn't change, consider `define()` or `const`
3. **Naming conventions** - Make them distinct (e.g., prefix with `g_`)
4. **Document thoroughly** - Since they're accessible everywhere

## Local Variables

### Definition
Local variables are declared within a function and can only be accessed within that function.

### Basic Syntax
```php
function testFunction() {
    $localVar = "I'm local"; // Local variable
    echo $localVar; // Works fine
}

testFunction();
// echo $localVar; // Would cause an error - undefined variable
```

### Variable Scope in Functions
```php
function scopeTest() {
    $varInFunction = "Local value";
    echo $varInFunction; // Works
}

scopeTest();
// echo $varInFunction; // Fails - out of scope
```

### Parameters as Local Variables
```php
function greet($name) { // $name is local to this function
    echo "Hello, $name!";
}

greet("Alice");
// echo $name; // Would fail - $name is local to greet()
```

### Static Variables (Special Local Variables)
```php
function counter() {
    static $count = 0; // Retains value between calls
    $count++;
    echo $count;
}

counter(); // 1
counter(); // 2
counter(); // 3
// echo $count; // Still fails - static doesn't make it global
```

## Key Differences

| Characteristic      | Global Variables            | Local Variables               |
|---------------------|----------------------------|-------------------------------|
| Declaration         | Outside functions          | Inside functions              |
| Accessibility       | Entire script (with `global` keyword in functions) | Only within declaring function |
| Memory              | Persist through entire script execution | Created/destroyed with function calls |
| Best Use Case       | Configuration values, rarely needed shared state | Most function-specific data |

## Common Use Cases

### Appropriate Global Variable Usage
```php
// Database configuration (though better as constants)
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'password';

function connectToDB() {
    global $dbHost, $dbUser, $dbPass;
    return new PDO("mysql:host=$dbHost", $dbUser, $dbPass);
}
```

### Typical Local Variable Usage
```php
function calculateTotal($prices) {
    $total = 0; // Local variable
    foreach ($prices as $price) {
        $total += $price;
    }
    return $total;
}
```

## Advanced Techniques

### Accessing Global Variables Without `global` Keyword
```php
$globalVar = "Global value";

function accessWithoutGlobal() {
    echo $GLOBALS['globalVar'];
}
```

### Variable Variables with Scope
```php
$globalVar = "global";
$varName = "globalVar";

function testVariableVariables() {
    // This won't work - looks for local $globalVar
    // echo $$varName; 
    
    // This works - accesses global scope
    global $$varName;
    echo $$varName;
}
```

### Anonymous Functions and `use` Keyword
```php
$globalVar = "Global";

$anonymous = function() use ($globalVar) {
    echo $globalVar; // Captures $globalVar at definition time
};

$anonymous();
```

## Best Practices

1. **Prefer local variables** - Makes code more predictable and testable
2. **Limit global variables** - Use only when truly necessary
3. **Use function parameters** - Instead of relying on globals
4. **Consider dependency injection** - Better than global state
5. **Clear naming** - Distinguish global from local variables
6. **Document globals** - Especially if they're modified in functions

## Common Pitfalls

1. **Accidental global access**
   ```php
   function badPractice() {
       // This works but is confusing - creates a global if not exists
       $undefinedVar = "Now I'm global!";
   }
   badPractice();
   echo $undefinedVar; // Works but is terrible practice
   ```

2. **Assuming variable availability**
   ```php
   function assumeAvailability() {
       echo $someVar; // Undefined variable notice
   }
   ```

3. **Static variable misuse**
   ```php
   function confusingStatic() {
       static $count = 0;
       $count++;
       return $count;
   }
   // Not obvious that this maintains state between calls
   ```

4. **Global variable collisions**
   ```php
   $name = "Global";
   
   function conflict() {
       $name = "Local"; // Different variable, shadows global
       echo $name; // "Local"
   }
   ```

## Performance Considerations

1. **Global variables** - Slightly faster access but negligible in most cases
2. **Local variables** - Cleaner memory usage (released when function ends)
3. **Static variables** - Persistent between calls but still local in scope

## When to Use Each

### Use Global Variables When:
1. You have configuration values needed throughout the application
2. You're working with legacy code that requires global state
3. The variable truly needs to be accessed from many unrelated places

### Use Local Variables When:
1. The variable is only needed within a single function
2. You want to avoid side effects and keep functions pure
3. The variable is temporary or intermediate in calculations

## Comparison Examples

### Global Variable Example
```php
$globalCounter = 0;

function incrementGlobal() {
    global $globalCounter;
    $globalCounter++;
}

incrementGlobal();
echo $globalCounter; // 1
```

### Local Variable Example
```php
function incrementLocal() {
    $localCounter = 0;
    $localCounter++;
    return $localCounter;
}

echo incrementLocal(); // 1
echo incrementLocal(); // 1 (fresh start each call)
```

### Static Variable Hybrid
```php
function incrementStatic() {
    static $staticCounter = 0;
    $staticCounter++;
    return $staticCounter;
}

echo incrementStatic(); // 1
echo incrementStatic(); // 2 (remembers state)
```

## Special Cases

### Superglobals
PHP has special global variables that are always accessible:
```php
function useSuperglobals() {
    echo $_SERVER['PHP_SELF']; // No global declaration needed
    // Other superglobals: $_GET, $_POST, $_SESSION, etc.
}
```

### Class Properties vs Global Variables
```php
class Config {
    public static $dbHost = 'localhost';
    // Better than global as it's namespaced
}

function connect() {
    $host = Config::$dbHost; // Access static property
}
```

## Debugging Scope Issues

1. **Enable error reporting**
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```

2. **Check variable existence**
   ```php
   function safeAccess() {
       if (isset($GLOBALS['someGlobal'])) {
           echo $GLOBALS['someGlobal'];
       }
   }
   ```

3. **Use debug tools** - Xdebug, var_dump(), debug_backtrace()

Remember: Proper variable scoping is crucial for writing maintainable, bug-free PHP code. Always prefer the most restrictive scope possible for your variables, and only use global variables when absolutely necessary.