# Variables in PHP

## Definition
A variable in PHP is a symbolic name that represents a value which can change during script execution. Variables are used to store data of various types, including numbers, strings, arrays, objects, and more.

## Key Characteristics
- Declared with a dollar sign `$` prefix (e.g., `$variableName`)
- Dynamically typed (type is determined at runtime)
- Must be declared before use (though no explicit declaration is required)
- Case-sensitive (`$var` ≠ `$Var` ≠ `$VAR`)

## Basic Syntax
```php
$variableName = value;
```

## Example
```php
$message = "Hello World";  // String variable
$count = 42;              // Integer variable
$price = 19.99;           // Float variable
$isActive = true;         // Boolean variable
```

## Variable Naming Convention

### ✅ Correct Ways
```php
$firstname    // all lowercase
$_firstname   // underscore prefix
$first_name   // snake_case
$firstName    // camelCase
$firstname1   // with trailing numbers
```

### ❌ Wrong Ways
```php
$first name   // contains space
$99firstname  // starts with number
$first%name   // contains special character
$first-name   // hyphen not allowed (though technically works in some cases)
```

## Important Notes
1. `$age` and `$AGE` are considered different variables (case-sensitive)
2. Variables must start with a letter or underscore
3. Can only contain alphanumeric characters and underscores
4. Should be descriptive of their purpose

## Best Practices
- Use consistent naming convention throughout your project
- Prefer descriptive names over short abbreviations
- For multi-word variables, use either:
  - camelCase (`$userProfile`)
  - snake_case (`$user_profile`)

Variables act as containers that allow you to store, retrieve, and manipulate data throughout your PHP script.
