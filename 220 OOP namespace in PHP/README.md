# PHP Namespaces: Comprehensive Guide

## Introduction to Namespaces

Namespaces in PHP provide a way to group related classes, interfaces, functions, and constants, preventing naming collisions between code components.

## Basic Namespace Syntax

### Declaring a Namespace
```php
namespace MyProject\Database;

class Connection {
    // Class implementation
}
```

### Using Namespaced Code
```php
$connection = new \MyProject\Database\Connection();
```

## Namespace Organization

### Hierarchical Namespaces
```php
namespace MyProject\Services\Payment;

class Processor {
    // Class implementation
}
```

### Multiple Declarations in One File
```php
namespace MyProject\Models;

class User {}
class Product {}

// All classes above are in MyProject\Models namespace
```

## The `use` Keyword

### Importing Namespaces
```php
use MyProject\Database\Connection;

$connection = new Connection();
```

### Importing with Aliases
```php
use MyProject\Database\Connection as DBConnection;

$connection = new DBConnection();
```

### Importing Multiple Classes
```php
use MyProject\Models\{User, Product, Order};

$user = new User();
$product = new Product();
```

## Global Namespace

### Accessing Global Functions/Classes
```php
namespace MyProject;

// Call global function with \
$time = \time();

// Instantiate global class
$pdo = new \PDO('mysql:host=localhost;dbname=test', 'user', 'pass');
```

## Namespace Constants and Functions

### Defining Namespaced Constants
```php
namespace MyProject\Config;

const VERSION = '1.0.0';
```

### Using Namespaced Constants
```php
echo \MyProject\Config\VERSION;
```

### Namespaced Functions
```php
namespace MyProject\Utils;

function formatDate(string $date): string {
    return date('Y-m-d', strtotime($date));
}
```

## Autoloading with Namespaces

### PSR-4 Autoloading Example (composer.json)
```json
{
    "autoload": {
        "psr-4": {
            "MyProject\\": "src/"
        }
    }
}
```

### File Structure
```
src/
  Database/
    Connection.php
  Models/
    User.php
```

## Best Practices

1. **Follow PSR-4** - Standardize your namespace-to-directory mapping
2. **Use Descriptive Names** - `CompanyName\ProjectName\Component`
3. **Avoid Deep Nesting** - 2-3 levels is usually sufficient
4. **Be Consistent** - Stick to one naming convention
5. **Use Composer** - For reliable autoloading

## Common Patterns

### Module Organization
```php
namespace MyProject\Blog;

class Post {}
class Comment {}
class Category {}
```

### Service Layers
```php
namespace MyProject\Services;

class UserService {}
class PaymentService {}
class EmailService {}
```

## Advanced Namespace Usage

### Dynamic Namespace References
```php
$className = 'MyProject\\Database\\Connection';
$connection = new $className();
```

### Namespace Constants
```php
namespace MyProject;

echo __NAMESPACE__; // Outputs "MyProject"
```

### Trait in Namespace
```php
namespace MyProject\Traits;

trait Loggable {
    public function log(string $message): void {
        echo $message;
    }
}
```

## Namespace Resolution Rules

1. **Unqualified Name** - `new Connection()` - Looks in current namespace
2. **Qualified Name** - `new Database\Connection()` - Relative to current namespace
3. **Fully Qualified Name** - `new \MyProject\Database\Connection()` - Absolute from global

## Common Pitfalls

1. **Missing Backslash** - `new PDO()` vs `new \PDO()`
2. **Case Sensitivity** - Namespaces are case-insensitive but should be consistent
3. **Autoloader Conflicts** - Ensure proper PSR-4 configuration
4. **Global Namespace Pollution** - Avoid dumping everything in global namespace
5. **Overly Long Names** - Balance specificity with readability

## Namespace Example Structure

```
src/
  Controllers/
    UserController.php
  Models/
    User.php
  Services/
    UserService.php
  Traits/
    Loggable.php
  Utilities/
    Logger.php
```

With corresponding namespaces:
```php
namespace MyProject\Controllers;
namespace MyProject\Models;
namespace MyProject\Services;
namespace MyProject\Traits;
namespace MyProject\Utilities;
```

## Modern PHP Features

### Group Use Declarations (PHP 7.0+)
```php
use MyProject\Models\{User, Product, Order as CustomerOrder};
```

### Function/Constant Import (PHP 5.6+)
```php
use function MyProject\Utils\formatDate;
use const MyProject\Config\VERSION;
```

## Namespace Use Cases

1. **Library Development** - Prevent naming collisions
2. **Large Applications** - Logical code organization
3. **Framework Extensions** - Isolate custom components
4. **Third-party Integration** - Manage vendor code
5. **API Versioning** - `\MyApi\V1\Endpoint` vs `\MyApi\V2\Endpoint`

Remember that namespaces are a fundamental tool for organizing modern PHP code. They work hand-in-hand with autoloading to create maintainable, scalable applications. Always follow established conventions (like PSR-4) to ensure compatibility with the broader PHP ecosystem.