<?php


$age = 20;

if($age >= 18 && $age <= 65) {
    echo "You are an adult.";
}

if($age < 18 || $age > 65) {
    echo "You are either a minor or a senior citizen.";
} 

if(!($age < 18)) {
    echo "You are not a minor.";
} 

if($age == 18 xor $age == 65) {
    echo "You are either 18 or 65 years old, but not both.";
} 