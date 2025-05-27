<?php

$per = 55;

if ($per >= 80 && $per <= 100) {
    echo "You are in Merit.";
} else if ($per >= 60 && $per < 80) {
    echo "You are in First Division.";
} else if ($per >= 40 && $per < 60) {
    echo "You are in Second Division.";
} else if ($per >= 33 && $per < 40) {
    echo "You are in Third Division.";
} else if ($per < 33 && $per >= 0) {
    echo "You are Failed.";
} else {
    echo "Invalid Percentage.";
}


if ($per >= 80 && $per <= 100):
    echo "You are in Merit.";
elseif ($per >= 60 && $per < 80):
    echo "You are in First Division.";
elseif ($per >= 40 && $per < 60):
    echo "You are in Second Division.";
elseif ($per >= 33 && $per < 40):
    echo "You are in Third Division.";
elseif ($per < 33 && $per >= 0):
    echo "You are Failed.";
else:
    echo "Invalid Percentage.";
endif;