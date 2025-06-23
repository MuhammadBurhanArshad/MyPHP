# PHP OOP Method and Property Overriding: Comprehensive Guide

## Definition
Method and property overriding in PHP OOP occurs when a child class provides its own implementation of a method or property that is already defined in its parent class. This allows child classes to modify or extend the behavior of inherited members.

## Method Overriding Basics

### Simple Method Override
```php
class Animal {
    public function makeSound() {
        return "Some generic animal sound";
    }
}

class Dog extends Animal {
    public function makeSound() {
        return "Woof!";
    }
}

$animal = new Animal();
$dog = new Dog();
echo $animal->makeSound(); // "Some generic animal sound"
echo $dog->makeSound();    // "Woof!"
```

### Calling Parent Method
```php
class Vehicle {
    public function start() {
        return "Engine started";
    }
}

class Car extends Vehicle {
    public function start() {
        $parentMessage = parent::start();
        return $parentMessage . " - Car is ready to drive";
    }
}

$car = new Car();
echo $car->start(); // "Engine started - Car is ready to drive"
```

## Property Overriding

### Basic Property Override
```php
class ParentClass {
    public $property = "Parent Property";
}

class ChildClass extends ParentClass {
    public $property = "Child Property";
}

$parent = new ParentClass();
$child = new ChildClass();
echo $parent->property; // "Parent Property"
echo $child->property;  // "Child Property"
```

### Visibility in Overriding
```php
class Base {
    protected $value = "Base Value";
    
    public function getValue() {
        return $this->value;
    }
}

class Derived extends Base {
    public $value = "Derived Value"; // Changed visibility to public
}

$derived = new Derived();
echo $derived->getValue(); // "Derived Value"
echo $derived->value;      // "Derived Value" (now accessible directly)
```

## Rules and Restrictions

### Final Methods Cannot Be Overridden
```php
class ParentClass {
    final public function cannotOverride() {
        return "This cannot be changed";
    }
}

class ChildClass extends ParentClass {
    // This would cause a fatal error:
    // public function cannotOverride() {}
}
```

### Visibility Rules
- You can make a method more visible (protected → public) but not less visible (public → protected)
- Private methods are not inherited and thus cannot be overridden

```php
class VisibilityBase {
    protected function protectedMethod() {}
    public function publicMethod() {}
}

class VisibilityChild extends VisibilityBase {
    public function protectedMethod() {} // OK - increasing visibility
    // protected function publicMethod() {} // Fatal error
}
```

## Advanced Overriding Techniques

### Abstract Method Implementation
```php
abstract class Shape {
    abstract public function area();
}

class Circle extends Shape {
    private $radius;
    
    public function __construct($radius) {
        $this->radius = $radius;
    }
    
    public function area() {
        return pi() * pow($this->radius, 2);
    }
}

$circle = new Circle(5);
echo $circle->area(); // ~78.54
```

### Overriding Static Methods
```php
class ParentStatic {
    public static function who() {
        return __CLASS__;
    }
    
    public static function test() {
        echo self::who() . "\n";
        echo static::who() . "\n"; // Late static binding
    }
}

class ChildStatic extends ParentStatic {
    public static function who() {
        return __CLASS__;
    }
}

ChildStatic::test();
// Output:
// ParentStatic
// ChildStatic
```

## Magic Method Overriding

### Common Overridden Magic Methods
```php
class CustomArray {
    private $data = [];
    
    public function __get($name) {
        return $this->data[$name] ?? null;
    }
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    public function __toString() {
        return implode(', ', $this->data);
    }
}

$arr = new CustomArray();
$arr->test = "value";
echo $arr; // "value"
```

## Property Overriding Details

### Type Changes in Overriding (PHP 7.4+)
```php
class TypedParent {
    public int $count = 0;
}

class TypedChild extends TypedParent {
    // This is allowed (same type)
    public int $count = 1;
    
    // This would cause a fatal error:
    // public string $count = "1";
}
```

### Readonly Properties (PHP 8.1+)
```php
class ReadonlyParent {
    public readonly string $id;
    
    public function __construct(string $id) {
        $this->id = $id;
    }
}

class ReadonlyChild extends ReadonlyParent {
    // Can redeclare with same readonly modifier
    public readonly string $id;
    
    public function __construct(string $id) {
        parent::__construct($id);
    }
}

$child = new ReadonlyChild('123');
// $child->id = '456'; // Fatal error
```

## Best Practices

1. **Document overridden methods** - Use `@override` in PHPDoc
2. **Maintain Liskov Substitution Principle** - Child should be substitutable for parent
3. **Avoid property overriding** - Prefer method accessors
4. **Call parent methods when appropriate** - Unless completely replacing behavior
5. **Keep method signatures compatible** - Same parameters and return types

```php
class GoodPracticeParent {
    /**
     * Calculates the total
     * @param float[] $items
     * @return float
     */
    public function calculateTotal(array $items): float {
        return array_sum($items);
    }
}

class GoodPracticeChild extends GoodPracticeParent {
    /**
     * @override
     * Calculates total with discount
     * @param float[] $items
     * @return float
     */
    public function calculateTotal(array $items): float {
        $subtotal = parent::calculateTotal($items);
        return $subtotal * 0.9; // 10% discount
    }
}
```

## Common Pitfalls

1. **Accidental overriding** - Same method name with different purpose
2. **Signature mismatches** - Different parameters than parent
3. **Changing return types** - Incompatible with parent (PHP 7.4+ enforces this)
4. **Overriding private methods** - They're not actually overridden, just hidden
5. **Forgetting parent calls** - When parent initialization is needed

```php
class ProblemParent {
    private function helper() { return "Parent"; }
    public function test() { return $this->helper(); }
}

class ProblemChild extends ProblemParent {
    private function helper() { return "Child"; }
}

$child = new ProblemChild();
echo $child->test(); // "Parent" (not "Child" as might be expected)
```

## Performance Considerations

1. **Overridden method calls** - No significant overhead
2. **Late static binding** - Slight performance impact
3. **Magic method overriding** - More overhead than regular methods
4. **Deep inheritance chains** - Can impact performance with many overrides

## Modern PHP Features

### Covariant Returns (PHP 7.4+)
```php
interface Factory {
    public function make(): object;
}

class UserFactory implements Factory {
    public function make(): User { // More specific return type
        return new User();
    }
}
```

### Contravariant Parameters (PHP 7.4+)
```php
class ParentClass {
    public function test(ChildParam $param) {}
}

class ChildClass extends ParentClass {
    public function test(ParentParam $param) {} // More general parameter
}
```

## When to Override

1. **Specializing behavior** - Child needs different implementation
2. **Extending functionality** - Adding to parent's behavior
3. **Implementing abstract methods** - Required by parent class
4. **Framework customization** - Modifying base class behavior

## When Not to Override

1. **Just to change visibility** - Unless making it more accessible
2. **When composition would work better** - Favor composition over inheritance
3. **For utility methods** - That shouldn't be modified by children
4. **When it violates LSP** - If child can't substitute for parent

Remember: Method and property overriding are powerful tools for creating specialized behavior in child classes, but they should be used judiciously. Always consider whether overriding is the best solution or if composition or other design patterns might be more appropriate. Proper documentation and adherence to object-oriented principles will ensure your overrides create maintainable, robust code.