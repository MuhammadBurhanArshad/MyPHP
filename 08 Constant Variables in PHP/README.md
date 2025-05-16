# Constants in PHP

## Definition
Constants are identifiers (names) for simple values that cannot change during script execution. Unlike variables, constants are automatically global across the entire script.

## Declaring Constants

### Using define() function
```php
define("SITE_NAME", "My Website");
define("MAX_USERS", 100);
define("IS_ACTIVE", true);
```

### Using const keyword (PHP 5.3+)
```php
const PI = 3.14159;
const COMPANY_NAME = "Acme Inc";
```

## Naming Conventions
- By convention, constant names are UPPERCASE
- Can contain letters, numbers, and underscores
- Con't use $ with constant variable name
- Must start with a letter or underscore
- Constant variables as Global Variables
- Case-sensitive by default (PHP 7.3+ allows case-insensitive constants as third parameter)

```php
define("DB_HOST", "localhost");  // Good
define("_SECRET_KEY", "abc123"); // Good
define("1CONSTANT", "value");    // Invalid
define("num", 500, true);    // Good, Third Parameter is for case-insensitive by default false, now it could be called as NUM also 
```

## Constant Values
Constants can only contain scalar data (boolean, integer, float, string) or arrays (PHP 7+):
```php
define("COLORS", ["red", "green", "blue"]);
const CONFIG = ["host" => "localhost", "port" => 3306];
```

## Accessing Constants
```php
echo SITE_NAME;       // No dollar sign needed
echo constant("PI");  // Using constant() function
```

## Predefined Constants
PHP provides many built-in constants:
```php
echo PHP_VERSION;     // Current PHP version
echo __FILE__;        // Full path and filename
echo __LINE__;        // Current line number
```

## Magic Constants
These change depending on where they are used:
```php
__DIR__        // Directory of the file
__FUNCTION__   // Function name
__CLASS__      // Class name
__METHOD__     // Class method name
__NAMESPACE__  // Current namespace
```

## Best Practices
1. Use for configuration values that shouldn't change
2. Group related constants together
3. Document constants with comments
4. Consider using class constants for better organization

```php
/**
 * Database connection constants
 */
define("DB_HOST", "localhost");
define("DB_USER", "admin");
define("DB_PASS", "secret");
define("DB_NAME", "myapp");
```

## Class Constants
```php
class Math {
    const PI = 3.14159;
    const E = 2.71828;
    
    public function getPi() {
        return self::PI;
    }
}

echo Math::PI;  // Access class constant
```

## Constant vs Variable
| Feature        | Constant          | Variable         |
|---------------|------------------|------------------|
| Declaration   | define()/const   | $var = value     |
| Case-sensitive| Yes              | Yes              |
| Scope         | Global           | Depends on scope |
| Modifiable    | No               | Yes              |
| Value types   | Scalar/array     | Any              |

## Checking Constants
```php
defined("SITE_NAME");  // Returns true if constant exists
constant("SITE_NAME"); // Returns constant value
```

Remember: Constants provide a way to define values that should remain unchanged throughout your application's execution, making your code more maintainable and secure.