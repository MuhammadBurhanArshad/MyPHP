# Difference Between `echo` and `print` in PHP

Both `echo` and `print` are used to output data in PHP, but they have key differences:

| Feature          | `echo`                          | `print`                        |
|------------------|---------------------------------|--------------------------------|
| **Return Value** | No return value (void)          | Always returns `1`             |
| **Arguments**    | Can take multiple arguments     | Only takes one argument        |
| **Speed**        | Slightly faster                 | Slightly slower                |
| **Usage**        | Preferred for simple output     | Used when return value is needed |
| **Example**      | `echo "Hello", " World";`       | `print "Hello World";`         |

## Key Notes:
- **`echo`** is a language construct (not a function) and supports comma-separated arguments.
- **`print`** behaves like a function (returns `1`) and can be used in expressions.
- Parentheses are optional for both:
  ```php
  echo("Hello");  // Valid
  print("Hello"); // Valid

  // echo can output multiple strings
echo "This ", "is ", "a ", "test.";  // Works

// print can only take one argument
print "This is a test.";  // Works
// print "This", "test";  // Error