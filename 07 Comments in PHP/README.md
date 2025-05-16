# Comments in PHP

## Definition
Comments are non-executable text annotations used to explain and document PHP code. They are ignored by the PHP interpreter and serve as notes for developers.

## Single-Line Comments

### Double Slash Syntax
```php
// This is a single-line comment
$price = 100; // Comment after code
```

### Hash Syntax
```php
# This is also a single-line comment
$quantity = 5; # Comment after code
```

## Multi-Line Comments

### Block Comment Syntax
```php
/*
 * This is a multi-line comment
 * It can span multiple lines
 * Useful for longer explanations
 */
function calculateTotal() {
    // Function implementation
}
```

## DocBlock Comments (Documentation)

### Class and Function Documentation
```php
/**
 * Calculates the total price including tax
 *
 * @param float $price The base price
 * @param float $taxRate The tax rate (e.g., 0.2 for 20%)
 * @return float The total price with tax
 */
function calculateTotalWithTax(float $price, float $taxRate): float {
    return $price * (1 + $taxRate);
}
```

## Comment Best Practices

### Good Commenting
```php
// Calculate discount if quantity > 10
if ($quantity > 10) {
    $discount = 0.1; // 10% discount
}
```

### Bad Commenting (to avoid)
```php
$i++; // increment i (redundant comment)
```

## When to Use Comments

1. **Explain complex logic**
```php
// Using bitwise operation for faster permission checking
$permissions = $userPermissions & $requiredPermissions;
```

2. **Document function parameters and return values**
```php
/**
 * Formats a date string for display
 * @param string $date Input date (YYYY-MM-DD)
 * @return string Formatted date (MM/DD/YYYY)
 */
```

3. **Mark TODO items**
```php
// TODO: Implement input validation here
```

4. **Temporarily disable code**
```php
/*
$debugMode = true;
enableLogging();
*/
```

## Commenting Standards

1. **PHPDoc Standards** (for documentation generation)
```php
/**
 * @var string $username The current user's name
 */
private $username;
```

2. **Inline Comments**
```php
$result = $a + $b; // Sum the values for final calculation
```

3. **Section Headers**
```php
// ====================================
// DATABASE CONNECTION CONFIGURATION
// ====================================
```

## Advanced Comment Techniques

### Conditional Comments
```php
/* if ($debug): */
    echo "Debug information";
/* endif; */
```

### Metadata Comments
```php
// @author John Doe <john@example.com>
// @version 1.2.3
// @license MIT
```

Remember: Good comments explain why, not what. The code itself should be clear enough to show what it's doing. Use comments to provide context, rationale, or important notes that aren't obvious from the code itself.