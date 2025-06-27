# PHP OOP Traits: Method Overriding Guide

## Understanding Trait Method Overriding

When using traits in PHP, you may need to override methods from traits in your classes or resolve conflicts when multiple traits provide the same method.

## Basic Overriding

### Class Method Overrides Trait Method
```php
trait Greeter {
    public function greet(): string {
        return "Hello from trait";
    }
}

class User {
    use Greeter;
    
    // Overrides the trait's greet() method
    public function greet(): string {
        return "Hello from User class";
    }
}

$user = new User();
echo $user->greet(); // Outputs "Hello from User class"
```

## Conflict Resolution

### When Multiple Traits Have Same Method
```php
trait A {
    public function conflict(): string {
        return "From Trait A";
    }
}

trait B {
    public function conflict(): string {
        return "From Trait B";
    }
}

class Example {
    use A, B {
        B::conflict insteadof A;  // Use B's conflict() instead of A's
        A::conflict as aConflict; // Make A's conflict available under new name
    }
}

$example = new Example();
echo $example->conflict();  // Outputs "From Trait B"
echo $example->aConflict(); // Outputs "From Trait A"
```

## Advanced Overriding Techniques

### Combining Parent Class and Trait Methods
```php
trait Timestampable {
    public function createdAt(): string {
        return date('Y-m-d H:i:s');
    }
}

class Model {
    public function createdAt(): string {
        return "Base model timestamp";
    }
}

class User extends Model {
    use Timestampable;
    
    public function createdAt(): string {
        return parent::createdAt() . " (overridden)";
    }
}

$user = new User();
echo $user->createdAt(); // Outputs "Base model timestamp (overridden)"
```

### Partial Overriding with Aliases
```php
trait Formatter {
    public function format(string $text): string {
        return "Formatted: " . $text;
    }
}

class Document {
    use Formatter {
        format as protected traitFormat;
    }
    
    public function format(string $text): string {
        return "DOCUMENT: " . $this->traitFormat($text);
    }
}

$doc = new Document();
echo $doc->format('test'); // Outputs "DOCUMENT: Formatted: test"
```

## Precedence Rules

PHP follows strict precedence rules when methods are defined in multiple places:

1. **Class methods** override trait methods
2. **Trait methods** override inherited methods
3. **Last used trait** wins in case of conflicts (unless resolved)

```php
trait A {
    public function test() { return 'A'; }
}

trait B {
    public function test() { return 'B'; }
}

class ParentClass {
    public function test() { return 'Parent'; }
}

class Child extends ParentClass {
    use A, B;
}

$child = new Child();
echo $child->test(); // Outputs "B" (last trait used wins)
```

## Best Practices for Overriding

1. **Explicit resolution** - Always resolve conflicts explicitly
2. **Document overrides** - Comment why you're overriding
3. **Call parent methods** - Use `parent::` when appropriate
4. **Meaningful aliases** - Use clear names when aliasing
5. **Avoid deep nesting** - Don't create complex override chains

```php
/**
 * Overrides TraitA::calculate() to add logging
 * @see TraitA::calculate()
 */
public function calculate(): float {
    $result = parent::calculate();
    $this->logCalculation($result);
    return $result;
}
```

## Common Pitfalls

1. **Unintended overrides** - Accidentally overriding trait methods
2. **Circular dependencies** - Traits overriding each other's methods
3. **Lost functionality** - Forgetting to call parent/trait methods
4. **Visibility changes** - Changing visibility without considering impact
5. **Testing challenges** - Hard to test complex override scenarios

## Real-World Example

```php
trait SoftDeletes {
    public function delete(): bool {
        return $this->softDelete();
    }
    
    protected function softDelete(): bool {
        // Implementation
        return true;
    }
}

trait ForceDeletes {
    public function delete(): bool {
        return $this->forceDelete();
    }
    
    protected function forceDelete(): bool {
        // Implementation
        return true;
    }
}

class User {
    use SoftDeletes, ForceDeletes {
        ForceDeletes::delete insteadof SoftDeletes;
        SoftDeletes::delete as softDelete;
    }
    
    public function delete(bool $force = false): bool {
        return $force ? parent::delete() : $this->softDelete();
    }
}

$user = new User();
$user->delete();       // Soft delete
$user->delete(true);   // Force delete
```

## Modern PHP Features

### Using `parent` with Traits (PHP 8.0+)
```php
trait Loggable {
    public function log(string $message): void {
        echo "Logging: $message\n";
    }
}

class Service {
    use Loggable {
        log as parentLog;
    }
    
    public function log(string $message): void {
        $this->parentLog("PREFIX: $message");
    }
}
```

### Trait with Abstract Methods
```php
trait Validatable {
    abstract public function validate(): bool;
    
    public function isValid(): bool {
        return $this->validate();
    }
}

class Form {
    use Validatable;
    
    public function validate(): bool {
        // Implementation
        return true;
    }
}
```

Remember that trait method overriding should be used judiciously. While powerful, complex override scenarios can make code harder to understand and maintain. Always document your override decisions and consider whether composition might be a better approach than trait overriding in some cases.