<?php 

$marks = [
    "Student One" => [
        "physics" => 85,
        "maths" => 78,
        "chemistry" => 89,
    ],
    "Student Two" => [
        "physics" => 94,
        "maths" => 74,
        "chemistry" => 58,
    ],
    "Student Three" => [
        "physics" => 40,
        "maths" => 86,
        "chemistry" => 52,
    ],
];


// testing via print_r

echo "<pre>"; 
print_r($marks);
echo "</pre>";


// printing keys via loop

foreach($marks as $key => $row) {
    echo "$key <br />";
}


// printing table via loop

echo "<table border='2px' cellpadding='5px' cellspacing='0px'>";
echo "<tr>
            <td>Student Name</td>
            <td>Physics</td>
            <td>Chemistry</td>
            <td>Maths</td>
        </tr>";

foreach($marks as $key => $row) {
    echo "<tr>
                <td>$key </td>";
    foreach($row as $col) {
        echo "<td> $col </td>";
    }
    echo "</tr>";
}
echo"</table>";