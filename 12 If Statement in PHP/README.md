# If Statements in PHP

## Definition
The `if` statement is a fundamental control structure that executes a block of code only if a specified condition evaluates to `true`. It's the basis for decision-making in PHP programs.

## Basic Syntax

### Simple If
```php
if (condition) {
    // code to execute if condition is true
}
```

### If-Else
```php
if (condition) {
    // code if true
} else {
    // code if false
}
```

### If-Elseif-Else
```php
if (condition1) {
    // code if condition1 is true
} elseif (condition2) {
    // code if condition2 is true
} else {
    // code if all conditions are false
}
```

## Common Examples

### Basic Condition
```php
$age = 18;
if ($age >= 18) {
    echo "You are an adult";
}
```

### Multiple Conditions
```php
$score = 85;
if ($score >= 90) {
    echo "Grade: A";
} elseif ($score >= 80) {
    echo "Grade: B";
} elseif ($score >= 70) {
    echo "Grade: C";
} else {
    echo "Grade: F";
}
```

### Boolean Checks
```php
$isLoggedIn = true;
if ($isLoggedIn) {
    echo "Welcome back!";
}
```

### Negation
```php
if (!empty($username)) {
    echo "Hello, $username";
}
```

## Alternative Syntax
PHP offers an alternative syntax for control structures, often used in templates:

```php
if ($condition):
    // code
elseif ($otherCondition):
    // code
else:
    // code
endif;
```

## Best Practices

1. Always use curly braces `{}` even for single-line statements
2. Keep conditions simple and readable
3. Avoid deep nesting (consider early returns or switches)
4. Use meaningful variable names in conditions
5. Format conditions clearly

```php
// Good practice
if ($user->isActive() && $user->hasPermission('edit')) {
    // ...
}

// Avoid
if($x>5&&$y<3||$z==4){...}
```

## Common Use Cases

### Form Validation
```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username'])) {
        $errors[] = "Username is required";
    }
}
```

### Authentication
```php
if ($user && password_verify($password, $user->password)) {
    loginUser($user);
} else {
    showLoginError();
}
```

### Feature Flags
```php
if (FEATURE_NEW_DESIGN_ENABLED) {
    loadNewDesign();
} else {
    loadLegacyDesign();
}
```

### Null Checks
```php
if ($order !== null) {
    processOrder($order);
}
```

## Special Cases

### Truthy/Falsy Values
```php
if (0) {        // false
if ("0") {      // false
if ("") {       // false
if (null) {     // false
if ([]) {       // false
if ("false") {  // true
if (1) {        // true
if (" ") {      // true
if ([""]) {     // true
```

### Variable Assignment in Condition
```php
if ($result = getData()) {
    // $result is now available here
}
```

### Multiple Conditions
```php
if ($age >= 18 && $country === 'US') {
    echo "You can vote in the US";
}
```

## Nested If Statements
```php
if ($accountExists) {
    if ($isActive) {
        if ($hasCredit) {
            processOrder();
        }
    }
}
// Better as:
if ($accountExists && $isActive && $hasCredit) {
    processOrder();
}
```

Remember: `if` statements are fundamental to PHP programming. Always choose the simplest structure that clearly expresses your logic. For complex conditions, consider breaking them into separate variables or functions to improve readability.