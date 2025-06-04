# `break` and `continue` Statements in PHP

## Overview

`break` and `continue` are loop control statements that alter the normal flow of execution in loops. They provide additional control over loop iterations beyond the basic loop condition.

## `break` Statement

### Definition
The `break` statement terminates the execution of the current loop structure immediately and continues execution after the loop.

### Syntax
```php
break;
break $num; // (PHP 5.4+) where $num is number of levels to break out of
```

### Key Characteristics
1. Immediately exits the current loop
2. Can specify how many nested loop levels to break out of (PHP 5.4+)
3. Works with all loop types: `for`, `while`, `do-while`, `foreach`, and `switch`

### Examples

#### Basic Usage
```php
for ($i = 0; $i < 10; $i++) {
    if ($i == 5) {
        break; // Exits loop when $i reaches 5
    }
    echo $i . " "; // Output: 0 1 2 3 4
}
```

#### Breaking Multiple Levels
```php
for ($i = 0; $i < 3; $i++) {
    echo "Outer: $i\n";
    for ($j = 0; $j < 3; $j++) {
        if ($j == 1) {
            break 2; // Breaks out of both loops
        }
        echo "Inner: $j\n";
    }
}
```

#### In Switch Statement
```php
switch ($value) {
    case 1:
        echo "One";
        break; // Exit switch
    case 2:
        echo "Two";
        break;
    default:
        echo "Other";
}
```

## `continue` Statement

### Definition
The `continue` statement skips the remaining code in the current loop iteration and jumps to the next iteration.

### Syntax
```php
continue;
continue $num; // (PHP 5.4+) where $num is number of levels to continue
```

### Key Characteristics
1. Skips to next iteration of current loop
2. Can specify how many nested loop levels to continue (PHP 5.4+)
3. Works with all loop types except `switch`

### Examples

#### Basic Usage
```php
for ($i = 0; $i < 10; $i++) {
    if ($i % 2 == 0) {
        continue; // Skip even numbers
    }
    echo $i . " "; // Output: 1 3 5 7 9
}
```

#### Continuing Multiple Levels
```php
for ($i = 0; $i < 3; $i++) {
    echo "Outer: $i\n";
    for ($j = 0; $j < 3; $j++) {
        if ($j == 1) {
            continue 2; // Continues outer loop
        }
        echo "Inner: $j\n";
    }
}
```

#### In While Loop
```php
$i = 0;
while ($i < 10) {
    $i++;
    if ($i == 5) {
        continue; // Skip iteration when $i is 5
    }
    echo $i . " "; // Output: 1 2 3 4 6 7 8 9 10
}
```

## Comparison Table

| Feature        | `break`                          | `continue`                      |
|----------------|----------------------------------|---------------------------------|
| Purpose        | Exit loop entirely               | Skip to next iteration          |
| With `switch`  | Supported                        | Not applicable                  |
| Multi-level    | Yes (break 2, etc.)              | Yes (continue 2, etc.)          |
| Loop Types     | All loops + switch               | All loops except switch         |

## Best Practices

1. **Use sparingly** - Overuse can make code harder to follow
2. **Prefer clear conditions** - Often better to structure loop conditions properly
3. **Avoid deep nesting** - Multiple levels of break/continue can be confusing
4. **Comment complex usage** - Document non-obvious control flow
5. **Consider alternatives** - Sometimes refactoring into functions is clearer

```php
// Good practice - simple and clear
foreach ($users as $user) {
    if (!$user->isActive()) {
        continue;
    }
    processUser($user);
}

// Avoid - complex control flow
for ($i = 0; $i < 100; $i++) {
    for ($j = 0; $j < 100; $j++) {
        if (condition1()) {
            continue 2;
        }
        if (condition2()) {
            break 2;
        }
        // ...
    }
}
```

## Common Use Cases

### `break` Use Cases

1. **Early termination when result found**
```php
foreach ($items as $item) {
    if ($item->matches($criteria)) {
        $found = $item;
        break; // Stop searching
    }
}
```

2. **Infinite loop with condition**
```php
while (true) {
    $result = doSomething();
    if ($result === DONE) {
        break;
    }
}
```

3. **Error handling in loops**
```php
foreach ($tasks as $task) {
    if (!$task->validate()) {
        $error = true;
        break; // Stop processing on error
    }
    $task->execute();
}
```

### `continue` Use Cases

1. **Skipping invalid items**
```php
foreach ($data as $record) {
    if (!$record->isValid()) {
        continue; // Skip invalid records
    }
    process($record);
}
```

2. **Optimizing performance**
```php
for ($i = 0; $i < 1000; $i++) {
    if ($i % 100 != 0) {
        continue; // Only process every 100th item
    }
    heavyProcessing($i);
}
```

3. **Filtering data**
```php
while ($row = fetchData()) {
    if (shouldExclude($row)) {
        continue; // Skip excluded rows
    }
    analyze($row);
}
```

## Advanced Patterns

### Labeled Breaks (Simulated)
PHP doesn't have labeled breaks, but you can simulate them:
```php
$breakOuter = false;
foreach ($outer as $o) {
    foreach ($inner as $i) {
        if ($specialCondition) {
            $breakOuter = true;
            break;
        }
    }
    if ($breakOuter) break;
}
```

### Continue with Complex Logic
```php
for ($i = 0; $i < 10; $i++) {
    try {
        $result = riskyOperation($i);
        if ($result === null) {
            continue; // Skip null results
        }
    } catch (Exception $e) {
        continue; // Skip on error
    }
    process($result);
}
```

### Break with Switch in Loop
```php
foreach ($commands as $cmd) {
    switch ($cmd) {
        case 'exit':
            break 2; // Breaks out of switch AND foreach
        case 'skip':
            continue 2; // Continues with next foreach iteration
        default:
            execute($cmd);
    }
}
```

## Performance Considerations

1. **Minimize use in tight loops** - Although minimal, there is some overhead
2. **Avoid in performance-critical sections** - Especially with multiple levels
3. **Profile before optimizing** - Don't sacrifice readability without measurements

```php
// Micro-optimized version
$found = false;
for ($i = 0; $i < count($array) && !$found; $i++) {
    if ($array[$i] == $target) {
        $found = true;
    }
}

// vs break version (often more readable)
for ($i = 0; $i < count($array); $i++) {
    if ($array[$i] == $target) {
        break;
    }
}
```

## Common Pitfalls

1. **Confusing levels in nested loops**
```php
for ($i = 0; $i < 3; $i++) {
    for ($j = 0; $j < 3; $j++) {
        if ($j == 1) {
            continue; // Did you mean continue 2?
        }
    }
}
```

2. **Forgetting break in switch**
```php
switch ($value) {
    case 1:
        echo "One";
        // Forgot break - falls through to case 2!
    case 2:
        echo "Two";
        break;
}
```

3. **Unreachable code after break**
```php
while (true) {
    break;
    doSomething(); // Never executed
}
```

Remember: `break` and `continue` are powerful tools for controlling loop execution flow, but they should be used judiciously. Clear, well-structured loop conditions are often preferable to complex break/continue logic. Always consider whether using these statements actually improves code readability and maintainability.