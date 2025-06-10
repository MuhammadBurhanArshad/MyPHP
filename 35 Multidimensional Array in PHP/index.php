<?php 

$products = [
    [1, "Laptop", 999.99],
    [2, "Phone", 699.99],
    [3, "Tablet", 399.99]
];

echo "<pre>"; 
print_r($products);
echo "</pre>";

// first row
echo $products[0][0];
echo $products[0][1];
echo $products[0][2];


// table via for loop

for($row = 0; $row < 3; $row++) {
    for($col = 0; $col < 3; $col++) {
        echo $products[$row][$col] . " ";
    }
    echo "<br />";
}

// table via foreach loop

foreach($products as $row) {
    foreach($row as $col) {
        echo $col . " ";
    }
    echo "<br />";
}

echo "<table border='2px' cellpadding='2px' cellspacing='0px'>";
echo "<tr>
            <td>Id</td>
            <td>Name</td>
            <td>Price</td>
        </tr>";
foreach($products as $row) {
    echo "<tr>"; 
    foreach($row as $col) {
        echo "<td> $col </td>";
    }
    echo "</tr>";
}
echo "</table> ";
