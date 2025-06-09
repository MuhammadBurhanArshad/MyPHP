# Multidimensional Arrays in PHP

## Definition

A multidimensional array is an array that contains one or more arrays as its elements. These are essentially "arrays of arrays" that allow you to store complex, hierarchical data structures. PHP supports arrays with multiple dimensions (2D, 3D, etc.), with no theoretical limit to the depth of nesting.

## Basic Syntax

### Creating Multidimensional Arrays

```php
// 2D array (array of arrays)
$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];

// Associative multidimensional array
$users = [
    "user1" => [
        "name" => "John",
        "age" => 30,
        "emails" => ["john@work.com", "john@personal.com"]
    ],
    "user2" => [
        "name" => "Jane",
        "age" => 25,
        "emails" => ["jane@work.com"]
    ]
];

// 3D array example
$cube = [
    [
        [1, 2],
        [3, 4]
    ],
    [
        [5, 6],
        [7, 8]
    ]
];
```

### Accessing Elements

```php
// Accessing 2D array
echo $matrix[1][2];  // Output: 6 (second row, third column)

// Accessing associative array
echo $users["user1"]["name"];  // Output: John

// Accessing 3D array
echo $cube[0][1][0];  // Output: 3
```

## Iterating Through Multidimensional Arrays

### Nested foreach Loops

```php
// Iterating through 2D array
foreach ($matrix as $row) {
    foreach ($row as $cell) {
        echo $cell . " ";
    }
    echo "\n";
}
// Output:
// 1 2 3
// 4 5 6
// 7 8 9

// Iterating through associative multidimensional array
foreach ($users as $userId => $userData) {
    echo "User ID: $userId\n";
    foreach ($userData as $key => $value) {
        if (is_array($value)) {
            echo "$key: " . implode(", ", $value) . "\n";
        } else {
            echo "$key: $value\n";
        }
    }
    echo "\n";
}
```

### Recursive Iteration

For arrays with unknown or variable depth:

```php
function printArrayRecursive($array, $indent = 0) {
    foreach ($array as $key => $value) {
        echo str_repeat(" ", $indent) . "$key: ";
        if (is_array($value)) {
            echo "\n";
            printArrayRecursive($value, $indent + 4);
        } else {
            echo "$value\n";
        }
    }
}

printArrayRecursive($users);
```

## Common Operations

### Adding Elements

```php
// Adding to 2D array
$matrix[] = [10, 11, 12];  // Adds new row

// Adding to associative array
$users["user3"] = [
    "name" => "Bob",
    "age" => 40
];

// Adding to nested array
$users["user1"]["phone"] = "123-456-7890";
```

### Modifying Elements

```php
$matrix[0][1] = 20;  // Changes 2 to 20 in first row
$users["user2"]["age"] = 26;  // Updates Jane's age
```

### Removing Elements

```php
unset($matrix[1]);  // Removes second row
unset($users["user1"]["emails"][0]);  // Removes John's work email
```

### Checking Existence

```php
// Check if key exists at first level
if (isset($users["user3"])) {
    // ...
}

// Check nested keys
if (isset($users["user1"]["emails"][1])) {
    // ...
}
```

## Practical Examples

### Table Data

```php
$products = [
    ["id" => 1, "name" => "Laptop", "price" => 999.99],
    ["id" => 2, "name" => "Phone", "price" => 699.99],
    ["id" => 3, "name" => "Tablet", "price" => 399.99]
];

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Price</th></tr>";
foreach ($products as $product) {
    echo "<tr>";
    echo "<td>" . $product["id"] . "</td>";
    echo "<td>" . $product["name"] . "</td>";
    echo "<td>$" . number_format($product["price"], 2) . "</td>";
    echo "</tr>";
}
echo "</table>";
```

### Configuration Hierarchy

```php
$config = [
    "database" => [
        "host" => "localhost",
        "name" => "my_app",
        "user" => "admin",
        "pass" => "secret"
    ],
    "site" => [
        "title" => "My Application",
        "theme" => "dark",
        "modules" => ["auth", "dashboard", "settings"]
    ]
];

// Accessing nested config
$dbHost = $config["database"]["host"];
$siteModules = implode(", ", $config["site"]["modules"]);
```

### Tree Structure

```php
$categories = [
    [
        "name" => "Electronics",
        "children" => [
            [
                "name" => "Computers",
                "children" => [
                    ["name" => "Laptops"],
                    ["name" => "Desktops"]
                ]
            ],
            [
                "name" => "Phones"
            ]
        ]
    ],
    [
        "name" => "Furniture"
    ]
];

// Recursive function to display tree
function displayTree($categories, $level = 0) {
    foreach ($categories as $category) {
        echo str_repeat("--", $level) . " " . $category["name"] . "\n";
        if (isset($category["children"])) {
            displayTree($category["children"], $level + 1);
        }
    }
}

displayTree($categories);
```

## Useful Functions

### Flattening Arrays

```php
// Using array_reduce
$flat = array_reduce($matrix, 'array_merge', []);

// Using spread operator (PHP 7.4+)
$flat = array_merge(...$matrix);
```

### Searching in Multidimensional Arrays

```php
function searchInMultiArray($value, $array) {
    foreach ($array as $key => $item) {
        if (is_array($item) && $result = searchInMultiArray($value, $item)) {
            return $result;
        }
        if ($item === $value) {
            return $key;
        }
    }
    return false;
}

$foundKey = searchInMultiArray("Laptop", $products);
```

### Sorting Multidimensional Arrays

```php
// Sort products by price
usort($products, function($a, $b) {
    return $a["price"] <=> $b["price"];
});

// Sort users by age
uasort($users, function($a, $b) {
    return $a["age"] <=> $b["age"];
});
```

## Best Practices

1. **Consistent Structure**: Ensure all elements at the same level have similar structure
2. **Avoid Deep Nesting**: Try to limit to 3-4 levels for maintainability
3. **Document Structure**: Comment complex array structures
4. **Consider Objects**: For complex data, classes might be better
5. **Validation**: Check array structure before accessing nested elements

```php
// Safe access with null coalescing
$email = $users["user1"]["emails"][0] ?? null;
```

## Performance Considerations

1. **Memory Usage**: Each dimension adds overhead
2. **Deep Copying**: array_merge() creates copies of nested arrays
3. **References**: Can reduce memory usage but be careful with modifications
4. **Alternative Structures**: For large datasets, consider databases

## Common Pitfalls

1. **Undefined Indexes**:
   ```php
   echo $matrix[3][0];  // Undefined offset if row doesn't exist
   ```

2. **Accidental References**:
   ```php
   $row = &$matrix[0];
   $row[0] = 100;  // Modifies original array
   ```

3. **Assumption of Order**:
   ```php
   // Don't assume order in associative arrays
   foreach ($users as $id => $data) { ... }
   ```

4. **Modification During Iteration**:
   ```php
   foreach ($matrix as &$row) {
       $matrix[] = [0, 0, 0];  // Infinite loop!
   }
   ```

## Real-World Use Cases

### Form Data Handling
```php
$formData = [
    "personal" => [
        "name" => $_POST["name"],
        "email" => $_POST["email"]
    ],
    "preferences" => [
        "theme" => $_POST["theme"],
        "notifications" => isset($_POST["notifications"])
    ]
];
```

### API Responses
```php
$apiResponse = [
    "status" => "success",
    "data" => [
        "users" => [
            ["id" => 1, "name" => "John"],
            ["id" => 2, "name" => "Jane"]
        ],
        "count" => 2
    ],
    "meta" => [
        "page" => 1,
        "limit" => 20
    ]
];
```

### Database-like Structures
```php
$inventory = [
    "categories" => [
        1 => "Electronics",
        2 => "Clothing"
    ],
    "items" => [
        ["id" => 101, "name" => "Laptop", "category" => 1, "stock" => 15],
        ["id" => 102, "name" => "T-Shirt", "category" => 2, "stock" => 50]
    ]
];
```

### Template Data
```php
$viewData = [
    "title" => "Product Page",
    "product" => [
        "name" => "Smartphone",
        "price" => 599.99,
        "features" => ["5G", "128GB Storage", "OLED Display"]
    ],
    "related" => [
        ["name" => "Case", "price" => 19.99],
        ["name" => "Charger", "price" => 29.99]
    ]
];
```

Remember: Multidimensional arrays are powerful but can become complex. Always consider whether the data structure is appropriate for your use case, and for very complex data hierarchies, consider using objects or database storage instead. Proper documentation and consistent structure will make working with multidimensional arrays much easier.