# PHP OOP Access Modifiers: Comprehensive Guide

## Definition
Access modifiers in PHP OOP are keywords that set the accessibility (visibility) of classes, properties, and methods. They control how class members can be accessed from different scopes.

## Types of Access Modifiers

### 1. Public
- Accessible from anywhere (inside/outside class, child classes)
- Least restrictive visibility

```php
class User {
    public $name;  // Public property
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function greet() {  // Public method
        return "Hello, {$this->name}!";
    }
}

$user = new User('Alice');
echo $user->name;      // Accessible
echo $user->greet();   // Accessible
```

### 2. Protected
- Accessible within the class and its child classes
- Not accessible from outside the class hierarchy

```php
class Vehicle {
    protected $model;  // Protected property
    
    protected function startEngine() {  // Protected method
        return "Engine started for {$this->model}";
    }
}

class Car extends Vehicle {
    public function __construct($model) {
        $this->model = $model;  // Accessible in child class
    }
    
    public function drive() {
        return $this->startEngine() . " and ready to drive!";  // Accessible
    }
}

$car = new Car('Toyota');
echo $car->drive();
// echo $car->model;       // Fatal error
// $car->startEngine();    // Fatal error
```

### 3. Private
- Accessible only within the defining class
- Not accessible in child classes or from outside

```php
class BankAccount {
    private $balance = 0;  // Private property
    
    private function logTransaction($amount) {  // Private method
        echo "Transaction: $amount\n";
    }
    
    public function deposit($amount) {
        $this->balance += $amount;
        $this->logTransaction($amount);  // Accessible within class
    }
    
    public function getBalance() {
        return $this->balance;
    }
}

class SavingsAccount extends BankAccount {
    public function showBalance() {
        // return $this->balance;  // Fatal error
        return $this->getBalance();  // OK - using public method
    }
}

$account = new BankAccount();
$account->deposit(100);
echo $account->getBalance();
// $account->balance = 1000;      // Fatal error
// $account->logTransaction(50);  // Fatal error
```

## Access Modifiers for Classes

### Class Visibility
```php
// Regular class (implicitly public)
class PublicClass {
    // ...
}

// Final class (cannot be inherited)
final class FinalClass {
    // ...
}

// Abstract class (cannot be instantiated)
abstract class AbstractClass {
    // ...
}
```

## Property Access Modifiers

### Property Declaration
```php
class Example {
    public $publicProp = 'Public';
    protected $protectedProp = 'Protected';
    private $privateProp = 'Private';
    
    public function showProps() {
        echo $this->publicProp;    // OK
        echo $this->protectedProp; // OK
        echo $this->privateProp;   // OK
    }
}

$example = new Example();
echo $example->publicProp;    // OK
// echo $example->protectedProp; // Fatal error
// echo $example->privateProp;   // Fatal error
```

### Typed Properties (PHP 7.4+)
```php
class User {
    public string $name;
    protected int $age;
    private ?string $email = null;
    
    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
    }
}
```

## Method Access Modifiers

### Method Visibility
```php
class VisibilityExample {
    public function publicMethod() {
        return "Public";
    }
    
    protected function protectedMethod() {
        return "Protected";
    }
    
    private function privateMethod() {
        return "Private";
    }
    
    public function test() {
        echo $this->publicMethod();    // OK
        echo $this->protectedMethod(); // OK
        echo $this->privateMethod();   // OK
    }
}

$vis = new VisibilityExample();
$vis->publicMethod();
// $vis->protectedMethod(); // Fatal error
// $vis->privateMethod();   // Fatal error
```

## Constructor Visibility

### Public Constructor (Default)
```php
class PublicConstructor {
    public function __construct() {
        echo "Public constructor called\n";
    }
}

new PublicConstructor(); // Works
```

### Protected Constructor
```php
class ProtectedConstructor {
    protected function __construct() {
        echo "Protected constructor called\n";
    }
    
    public static function create() {
        return new self();
    }
}

// new ProtectedConstructor(); // Fatal error
$obj = ProtectedConstructor::create(); // Works
```

### Private Constructor (Singleton Pattern)
```php
class Singleton {
    private static $instance;
    
    private function __construct() {
        echo "Private constructor called\n";
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

// new Singleton(); // Fatal error
$singleton = Singleton::getInstance(); // Works
```

## Access Modifiers in Inheritance

### Property Inheritance
```php
class ParentClass {
    public $public = 'Public';
    protected $protected = 'Protected';
    private $private = 'Private';
}

class ChildClass extends ParentClass {
    public function showProperties() {
        echo $this->public;    // OK
        echo $this->protected; // OK
        // echo $this->private; // Fatal error
    }
}
```

### Method Overriding Rules
- You can make a method more accessible (protected → public) but not less
- Final methods cannot have their visibility changed

```php
class ParentClass {
    protected function protectedMethod() {}
    public function publicMethod() {}
}

class ChildClass extends ParentClass {
    public function protectedMethod() {} // OK - increasing visibility
    // protected function publicMethod() {} // Fatal error - decreasing visibility
}
```

## Static Access Modifiers

### Static Properties and Methods
```php
class StaticExample {
    public static $publicStatic = 'Public Static';
    protected static $protectedStatic = 'Protected Static';
    private static $privateStatic = 'Private Static';
    
    public static function publicStaticMethod() {
        return self::$publicStatic;
    }
    
    protected static function protectedStaticMethod() {
        return self::$protectedStatic;
    }
    
    private static function privateStaticMethod() {
        return self::$privateStatic;
    }
}

echo StaticExample::$publicStatic;    // OK
// echo StaticExample::$protectedStatic; // Fatal error
// echo StaticExample::$privateStatic;   // Fatal error
```

## Magic Methods and Access Modifiers

### Magic Method Visibility
```php
class MagicExample {
    private $data = [];
    
    // Magic methods are typically public
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    // Can be protected/private but would limit functionality
    protected function __sleep() {
        return array_keys($this->data);
    }
}
```

## Best Practices

1. **Start with private** - Make properties/methods private by default
2. **Increase visibility as needed** - Only expose what's necessary
3. **Use protected for extension points** - When designing for inheritance
4. **Avoid public properties** - Use getter/setter methods instead
5. **Document visibility decisions** - Explain why certain visibility was chosen

```php
class WellDesigned {
    private $internalState;
    
    /**
     * Protected to allow extension but prevent direct access
     */
    protected $extensibleData;
    
    /**
     * Public read access but private write
     */
    private $readOnlyPublic;
    
    public function getReadOnlyPublic() {
        return $this->readOnlyPublic;
    }
}
```

## Common Pitfalls

1. **Assuming private means secure** - PHP access modifiers are for code organization, not security
2. **Overusing protected** - Can lead to fragile parent-child coupling
3. **Changing visibility carelessly** - Can break existing code
4. **Forgetting constructor visibility** - Important for patterns like Singleton
5. **Magic method visibility** - Most should remain public

```php
class Problematic {
    // Bad practice - exposing internal implementation
    public $internalData = [];
    
    // Problematic - changing visibility in child classes
    public function methodThatShouldBePrivate() {}
}

class ChildProblematic extends Problematic {
    // Now this method is part of your public API
    // private function methodThatShouldBePrivate() {} // Can't do this
}
```

## Performance Considerations

1. **Visibility has minimal performance impact** - Mainly affects code organization
2. **Getter/setter methods** - Slight overhead vs direct property access
3. **Magic methods** - More overhead than regular methods

## Modern PHP Features

### Readonly Properties (PHP 8.1+)
```php
class Immutable {
    public readonly string $id;
    
    public function __construct(string $id) {
        $this->id = $id; // Can only be set once
    }
}

$immutable = new Immutable('123');
// $immutable->id = '456'; // Fatal error
```

### Property Accessors (PHP 8.3+ planned)
```php
// Proposed syntax (as of PHP 8.2, not yet implemented)
/*
class GetterSetter {
    private string $name;
    
    public function name(): string {
        return $this->name;
    }
    
    public function name(string $name): void {
        $this->name = $name;
    }
}
*/
```

## When to Use Each Modifier

| Modifier    | When to Use                                                                 |
|-------------|-----------------------------------------------------------------------------|
| **public**  | For API methods, simple DTOs, constants                                    |
| **protected** | For methods/properties meant to be extended by child classes               |
| **private** | For implementation details that shouldn't be exposed                       |

Remember: Proper use of access modifiers is crucial for creating maintainable, robust object-oriented code. They help enforce encapsulation, reduce coupling between components, and make your code's intent clearer to other developers.