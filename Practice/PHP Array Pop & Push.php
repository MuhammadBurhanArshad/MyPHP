<?php
    $students = ["Ali", "Hassam", "Farooq", "Rehman"];

    $student_pop = array_pop($students);
    echo $student_pop;
    echo "<pre>";
    print_r($students );
    echo "</pre> <br>";

    $students2 = ["Ali", "Hassam", "Farooq", "Rehman"];

    $student_push = array_push($students2, "Umer");
    echo $student_push;
    echo "<pre>";
    print_r($students2 );
    echo "</pre> <br>";
?>