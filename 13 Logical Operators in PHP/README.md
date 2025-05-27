# Logical Operators in PHP

## Definition
Logical operators are used to combine conditional statements and evaluate multiple conditions together. They are essential for creating complex decision-making logic in PHP.

## Basic Logical Operators

### AND (&& or `and`)
```php
true && true;    // true
true && false;   // false
5 > 3 && 10 < 20;  // true
```

### OR (|| or `or`)
```php
true || false;   // true
false || false;  // false
5 > 3 || 10 > 20;  // true
```

### NOT (!)
```php
!true;           // false
!false;          // true
!(5 > 10);       // true
```

### XOR (exclusive or)
```php
true xor true;   // false
true xor false;  // true
false xor false; // false
```

## Operator Precedence
1. `!` (NOT)
2. `&&` (AND)
3. `||` (OR)
4. `and`
5. `or`
6. `xor`

```php
true || false && false;  // true (&& evaluated first)
true or false and false; // true (and has higher precedence than or)
```

## Common Examples

### Combined Conditions
```php
$age = 25;
$country = "US";
if ($age >= 18 && $country === "US") {
    echo "Can vote in US elections";
}
```

### Form Validation
```php
if (!empty($username) && !empty($password)) {
    processLogin();
}
```

### Access Control
```php
if ($isAdmin || $user->hasPermission('edit')) {
    showEditButton();
}
```

### Range Checking
```php
if ($score >= 70 && $score <= 100) {
    echo "Passing grade";
}
```

## Best Practices

1. Use parentheses to clarify complex expressions
2. Put the most likely-to-fail condition first in AND operations
3. Put the most likely-to-succeed condition first in OR operations
4. Avoid mixing different operator types (`&&` with `and`)
5. Format complex conditions for readability

```php
// Good practice
if (
    ($user->isActive() && $user->hasCredit()) 
    || $user->isAdmin()
) {
    // ...
}

// Avoid
if($user->isActive()&&$user->hasCredit()||$user->isAdmin()){...}
```

## Common Use Cases

### Authentication
```php
if ($validCredentials || $rememberMeValid) {
    grantAccess();
}
```

### Feature Toggles
```php
if ($user->isPremium() || $trialPeriodActive) {
    showPremiumFeatures();
}
```

### Input Validation
```php
if (
    filter_var($email, FILTER_VALIDATE_EMAIL) 
    && strlen($password) >= 8
) {
    registerUser();
}
```

### Short-circuit Evaluation
```php
// The second condition won't be evaluated if the first is false
if ($object !== null && $object->isValid()) {
    // ...
}
```

## Special Cases

### Truthy/Falsy Evaluation
```php
"hello" && 1;      // true
"" || 0;           // false
!"false";          // false
!!"0";             // false
```

### Operator Differences
```php
// && vs 'and' - different precedence
$result = false && true;   // false
$result = false and true;  // $result is false (but the expression evaluates to true)

// || vs 'or' - different precedence
$result = true || false;   // true
$result = true or false;   // $result is true (but the expression evaluates to false)
```

### Type Juggling
```php
"0" && true;      // false (because "0" is falsy)
[] || "false";    // true ("false" is non-empty string)
```

## Advanced Techniques

### Default Values with OR
```php
$displayName = $username || "Guest";
```

### Conditional Execution
```php
$debugMode && logDebugInfo();  // Only executes if $debugMode is true
```

### Ternary Alternative
```php
$canEdit = $isAdmin || $isEditor ? true : false;
```

## Common Pitfalls

1. Assignment (=) vs comparison (==) in conditions
2. Unexpected operator precedence
3. Overlooking truthy/falsy evaluations
4. Forgetting that XOR is not the same as OR

```php
// Common mistake
if ($loggedIn = true) {  // Always true (assignment)
// Should be:
if ($loggedIn == true) {
// Better:
if ($loggedIn) {
```

Remember: Logical operators are powerful tools for creating complex conditions. Always test edge cases and consider using parentheses to make your intentions clear. For very complex conditions, consider breaking them into separate variables or functions to improve readability and maintainability.