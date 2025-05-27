<?php

$weekday = 3;

switch ($weekday) {
    case 1:
        echo "Monday";
        break;
    case 2:
        echo "Tuesday";
        break;
    case 3:
        echo "Wednesday";
        break;
    case 4:
        echo "Thursday";
        break;
    case 5:
        echo "Friday";
        break;
    case 6:
        echo "Saturday";
        break;
    case 7:
        echo "Sunday";
        break;
    default:
        echo "Invalid day of the week.";
}


switch ($weekday):
    case 1:
        echo "Monday";
        break;
    case 2:
        echo "Tuesday";
        break;
    case 3:
        echo "Wednesday";
        break;
    case 4:
        echo "Thursday";
        break;
    case 5:
        echo "Friday";
        break;
    case 6:
        echo "Saturday";
        break;
    case 7:
        echo "Sunday";
        break;
    default:
        echo "Invalid day of the week.";
endswitch;


//it will run all the cases (without break) after the first match


switch ($weekday) {
    case 1:
        echo "Monday";
    case 2:
        echo "Tuesday";
    case 3:
        echo "Wednesday";
    case 4:
        echo "Thursday";
    case 5:
        echo "Friday";
    case 6:
        echo "Saturday";
    case 7:
        echo "Sunday";
    default:
        echo "Invalid day of the week.";
}


// here is the example of switch statement with multiple cases


switch ($weekday) {
    case 1:
    case 2:
    case 3:
        echo "It's a weekday.";
        break;
    case 4:
    case 5:
        echo "It's almost the weekend.";
        break;
    case 6:
    case 7:
        echo "It's the weekend!";
        break;
    default:
        echo "Invalid day of the week.";
}


// switch with condition expression in case


switch (true) {
    case ($weekday >= 1 && $weekday <= 3):
        echo "It's a weekday.";
        break;
    case ($weekday >= 4 && $weekday <= 5):
        echo "It's almost the weekend.";
        break;
    case ($weekday >= 6 && $weekday <= 7):
        echo "It's the weekend!";
        break;
    default:
        echo "Invalid day of the week.";
}