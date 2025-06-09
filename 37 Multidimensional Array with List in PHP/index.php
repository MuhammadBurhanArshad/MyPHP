<?php 

$products = [
    [1, "Laptop", 999.99],
    [2, "Phone", 699.99],
    [3, "Tablet", 399.99]
];

echo "<table>"; 
echo "<tr><td>ID</td><td>Name</td><td>price</td></tr>";
foreach($products as list($id, $name, $price)) {
    echo "<tr>
        <td>$id</td> 
        <td>$name</td>
        <td>$price</td>
    </tr>";
}
echo "</table>";