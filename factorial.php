<?php

// Recursive function to calculate factorial with step-by-step display
function factorial($n, $depth = 0) {
    $indent = str_repeat("  ", $depth);
    
    // Base case: factorial of 0 or 1 is 1
    if ($n <= 1) {
        echo $indent . "Step: factorial($n) = 1 (Base case reached)\n";
        return 1;
    }
    
    // Recursive case: n! = n * (n-1)!
    echo $indent . "Step $depth: Calculating factorial($n) = $n × factorial(" . ($n - 1) . ")\n";
    $result = $n * factorial($n - 1, $depth + 1);
    echo $indent . "Step $depth: factorial($n) = $n × " . ($result / $n) . " = $result\n";
    return $result;
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
echo "\n=== Factorial Calculation Flow for $number ===\n";
$result = factorial($number);
echo "=== Final Result ===\n";
echo "Factorial of $number is: $result\n";

?>
