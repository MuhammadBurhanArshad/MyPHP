# Recursive Functions in PHP

## Definition
Recursive functions are functions that call themselves directly or indirectly to solve a problem by breaking it down into smaller subproblems. Each recursive call works on a smaller piece of the original problem until reaching a base case that stops the recursion.

## Basic Syntax

### Simple Recursive Function
```php
function recursiveFunction($param) {
    // Base case (stopping condition)
    if ($param <= 0) {
        return 0;
    }
    
    // Recursive case
    return $param + recursiveFunction($param - 1);
}

echo recursiveFunction(5); // Output: 15 (5+4+3+2+1+0)
```

## Key Components

1. **Base Case** - Condition that stops the recursion
2. **Recursive Case** - Function calls itself with modified parameters
3. **Progress Toward Base Case** - Each call moves closer to the base case

## Common Use Cases

### Factorial Calculation
```php
function factorial($n) {
    if ($n <= 1) { // Base case
        return 1;
    }
    return $n * factorial($n - 1); // Recursive case
}

echo factorial(5); // 120 (5*4*3*2*1)
```

### Directory Traversal
```php
function scanDirectory($path, $depth = 0) {
    $items = scandir($path);
    
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        
        $fullPath = $path . DIRECTORY_SEPARATOR . $item;
        echo str_repeat(' ', $depth * 2) . $item . "\n";
        
        if (is_dir($fullPath)) {
            scanDirectory($fullPath, $depth + 1); // Recursive call
        }
    }
}

scanDirectory('/path/to/directory');
```

### Fibonacci Sequence
```php
function fibonacci($n) {
    if ($n === 0) return 0;     // Base cases
    if ($n === 1) return 1;
    
    return fibonacci($n - 1) + fibonacci($n - 2); // Recursive case
}

echo fibonacci(10); // 55
```

## Advanced Techniques

### Memoization (Caching Results)
```php
function fibonacciMemo($n, &$memo = []) {
    if (isset($memo[$n])) return $memo[$n];
    if ($n <= 1) return $n;
    
    $memo[$n] = fibonacciMemo($n - 1, $memo) + fibonacciMemo($n - 2, $memo);
    return $memo[$n];
}

echo fibonacciMemo(50); // Much faster than naive recursion
```

### Tail Recursion
```php
function factorialTail($n, $accumulator = 1) {
    if ($n <= 1) {
        return $accumulator;
    }
    return factorialTail($n - 1, $n * $accumulator);
}

echo factorialTail(5); // 120
```

## Best Practices

1. **Always define a base case** - Prevents infinite recursion
2. **Ensure progress toward base case** - Each call should modify parameters
3. **Limit recursion depth** - PHP has stack limits
4. **Consider iterative solutions** - Often more efficient
5. **Document recursion clearly** - Note base case and recursive case

```php
/**
 * Calculates the greatest common divisor (GCD) using Euclid's algorithm
 * @param int $a First number
 * @param int $b Second number
 * @return int GCD of $a and $b
 */
function gcd($a, $b) {
    // Base case
    if ($b === 0) {
        return $a;
    }
    
    // Recursive case
    return gcd($b, $a % $b);
}
```

## Common Pitfalls

1. **No base case** - Leads to infinite recursion
   ```php
   function infinite() {
       infinite(); // Never stops!
   }
   ```

2. **Not progressing toward base case**
   ```php
   function badRecursion($n) {
       if ($n <= 0) return;
       badRecursion($n); // Always same $n value
   }
   ```

3. **Excessive recursion depth**
   ```php
   function deepRecursion($n) {
       if ($n <= 0) return;
       deepRecursion($n - 1); // May hit stack limit for large $n
   }
   ```

4. **Memory intensive** - Each call adds to call stack

## Performance Considerations

1. **Stack limits** - PHP has recursion depth limits (typically 100-1000)
2. **Memory usage** - Each recursive call consumes stack space
3. **Memoization** - Can dramatically improve performance
4. **Tail recursion** - Some languages optimize this (PHP doesn't)

## When to Use Recursion

1. **Tree-like structures** (directories, DOM, etc.)
2. **Divide-and-conquer algorithms**
3. **Problems with natural recursive definitions**
4. **When clarity outweighs performance needs**

## When to Avoid Recursion

1. **Performance-critical code**
2. **Deep recursion possible**
3. **Simple iterative solutions exist**
4. **When stack overflow is a risk**

## Comparison with Iteration

### Recursive Solution
```php
function recursiveSum($n) {
    if ($n <= 0) return 0;
    return $n + recursiveSum($n - 1);
}
```

### Iterative Solution
```php
function iterativeSum($n) {
    $sum = 0;
    for ($i = 1; $i <= $n; $i++) {
        $sum += $i;
    }
    return $sum;
}
```

## Special Cases

### Mutual Recursion
```php
function isEven($n) {
    if ($n === 0) return true;
    return isOdd($n - 1);
}

function isOdd($n) {
    if ($n === 0) return false;
    return isEven($n - 1);
}
```

### Recursive Generators
```php
function walkTree($node) {
    yield $node->value;
    foreach ($node->children as $child) {
        yield from walkTree($child);
    }
}
```

## Debugging Recursion

1. **Add debug output**
   ```php
   function factorial($n, $depth = 0) {
       echo str_repeat(' ', $depth) . "factorial($n)\n";
       if ($n <= 1) return 1;
       return $n * factorial($n - 1, $depth + 1);
   }
   ```

2. **Check stack traces**
3. **Limit recursion depth**
4. **Use Xdebug** for stack traces

Remember: Recursion is a powerful technique that can lead to elegant solutions for certain types of problems, but it must be used carefully to avoid performance issues and stack overflows. Always consider whether an iterative solution might be more appropriate for your specific use case.