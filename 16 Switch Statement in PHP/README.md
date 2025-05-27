# Switch-Case Statements in PHP

## Definition

The `switch-case` statement executes different blocks of code based on different conditions. It's particularly useful when you need to compare the same variable or expression against many different values.

## Basic Syntax

### Standard Switch-Case

```php
switch (expression) {
    case value1:
        // code to execute if expression == value1
        break;
    case value2:
        // code to execute if expression == value2
        break;
    default:
        // code to execute if no cases match
}
```

### Alternative Syntax

```php
switch (expression):
    case value1:
        // code
        break;
    case value2:
        // code
        break;
    default:
        // code
endswitch;
```

## Common Examples

### Basic Value Matching

```php
$day = "Monday";
switch ($day) {
    case "Monday":
        echo "Start of work week";
        break;
    case "Friday":
        echo "Almost weekend";
        break;
    default:
        echo "Regular day";
}
```

### HTTP Status Codes

```php
$statusCode = 404;
switch ($statusCode) {
    case 200:
        echo "OK";
        break;
    case 301:
        echo "Moved Permanently";
        break;
    case 404:
        echo "Not Found";
        break;
    case 500:
        echo "Server Error";
        break;
    default:
        echo "Unknown Status";
}
```

### User Role Handling

```php
switch ($userRole) {
    case 'admin':
        showAdminDashboard();
        break;
    case 'editor':
        showEditorTools();
        break;
    case 'subscriber':
        showPremiumContent();
        break;
    default:
        showBasicContent();
}
```

## Best Practices

1. **Always include `break`** unless intentional fall-through
2. **Include a default case** to handle unexpected values
3. **Keep cases simple** - move complex logic to functions
4. **Use strict comparisons** (===) when possible
5. **Format consistently** for readability

```php
// Good practice
switch ($menuItem) {
    case 'home':
        showHome();
        break;
    case 'about':
        showAbout();
        break;
    default:
        show404();
}

// Avoid
switch($x){case 1:doSomething();break;case 2:doAnother();break;}
```

## Common Use Cases

### Command Processing

```php
switch ($command) {
    case 'start':
        startService();
        break;
    case 'stop':
        stopService();
        break;
    case 'restart':
        restartService();
        break;
    default:
        logError("Unknown command");
}
```

### Content Type Handling

```php
switch ($contentType) {
    case 'text/html':
        renderHTML();
        break;
    case 'application/json':
        renderJSON();
        break;
    case 'text/xml':
        renderXML();
        break;
    default:
        sendUnsupportedMediaType();
}
```

### Error Code Mapping

```php
switch ($errorCode) {
    case E_ERROR:
        $type = "Fatal Error";
        break;
    case E_WARNING:
        $type = "Warning";
        break;
    case E_NOTICE:
        $type = "Notice";
        break;
    default:
        $type = "Unknown Error";
}
```

## Special Cases

### Fall-Through Behavior

```php
switch ($month) {
    case 1:
    case 2:
    case 12:
        echo "Winter";
        break;
    case 3:
    case 4:
    case 5:
        echo "Spring";
        break;
    // ... other seasons
}
```

### Type Comparison

```php
switch (true) {
    case $age < 13:
        $category = "Child";
        break;
    case $age < 20:
        $category = "Teen";
        break;
    case $age < 65:
        $category = "Adult";
        break;
    default:
        $category = "Senior";
}
```

### Return Values

```php
function getDiscount($type) {
    switch ($type) {
        case 'vip':     return 0.3;
        case 'premium': return 0.2;
        case 'new':     return 0.1;
        default:        return 0;
    }
}
```

## Performance Considerations

1. **Order cases by frequency** - Put most common cases first
2. **Use if-elseif for small ranges** (3-4 conditions)
3. **Switch is faster than if-elseif** for many discrete values
4. **Avoid complex expressions** in case conditions

```php
// Optimized for most common case
switch ($httpMethod) {
    case 'GET':    // Most frequent first
        handleGet();
        break;
    case 'POST':
        handlePost();
        break;
    // ... others
}
```

## Common Pitfalls

1. **Missing break statements**:

   ```php
   case 'admin':
       showAdminPanel();
       // Oops! Falls through to next case
   case 'user':
       showUserPanel();
       break;
   ```

2. **Loose comparison** (== instead of ===):

   ```php
   $value = "1";
   switch ($value) {
       case 1:    // This will match!
           // ...
   }
   ```

3. **Complex case expressions**:
   ```php
   case $x > 5:  // Only works with switch(true)
   ```

## Advanced Patterns

### Enum-like Behavior

```php
class Status {
    const DRAFT = 1;
    const PUBLISHED = 2;
    const ARCHIVED = 3;
}

switch ($articleStatus) {
    case Status::DRAFT:
        // ...
        break;
    // ...
}
```

### State Machines

```php
switch ($currentState) {
    case 'INIT':
        if ($valid) $nextState = 'PROCESSING';
        break;
    case 'PROCESSING':
        if ($complete) $nextState = 'DONE';
        break;
    // ...
}
```

### Multiple Matches

```php
switch (true) {
    case ($score >= 90 && $attempts <= 3):
        $grade = 'A+';
        break;
    case ($score >= 80):
        $grade = 'A';
        break;
    // ...
}
```

Remember: The `switch-case` statement is ideal when you need to compare one expression against multiple constant values. For complex conditions or range checks, consider using `if-elseif` structures or the `match` expression (PHP 8.0+). Always include `break` statements unless you specifically need fall-through behavior.
