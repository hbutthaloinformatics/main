<?php

// Recursive function to calculate factorial
function factorial($n) {
    // Base case: factorial of 0 or 1 is 1
    if ($n <= 1) {
        return 1;
    }
    // Recursive case: n! = n * (n-1)!
    return $n * factorial($n - 1);
}

// Get user input
echo "Enter a number to calculate its factorial: ";
$input = trim(fgets(STDIN));

// Validate input
if (!is_numeric($input) || $input < 0 || intval($input) != $input) {
    echo "Please enter a valid non-negative integer.\n";
    exit;
}

$number = intval($input);

// Calculate and display factorial
$result = factorial($number);
echo "Factorial of $number is: $result\n";

?>
