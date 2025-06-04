<?php 

for($a = 1; $a <= 100; $a += 10){
    for($b = $a; $b < $a + 10; $b++) {
        echo " $b ";
    }
    echo "<br />";
}


// table with nested loop

$table = '<table>';
for($a = 1; $a <= 100; $a += 10){
    $table .= '<tr>';
    for($b = $a; $b < $a + 10; $b++) {
        $table .= "<td>$b</td>";
    }
    $table .= "</tr>";
}
$table .= '</table>';

echo $table;