<?php
// Q1
echo "Hello World\n";

// Q2
$foo = true;
echo "Boolean foo is filled with: " . ($foo ? "1" : "0") . "\n";
$age = 18;
echo "I am $age years old\n";
$height = 1.95;
echo "And I am {$height}m long\n";

// Q3
$num1 = 15;
$num2 = 25;
$addition = $num1 + $num2;
echo "Addition: $num1 + $num2 = $addition\n";
$subtraction = $num1 - $num2;
echo "Subtraction: $num1 - $num2 = $subtraction\n";
$multiplication = $num1 * $num2;
echo "Multiplication: $num1 * $num2 = $multiplication\n";
$division = $num1 / $num2;
echo "Division: $num1 / $num2 = $division\n";

// Q4
$a = 20;
$b = 10;
$c = $b;
$a = $c;
echo "Value of \$a: $a\n";
echo "Value of \$b: $b\n";
echo "Value of \$c: $c\n";

// Q5
$name = "joseph";
$surname = "jong";
$fullname = $name . " " . $surname;
echo "Full name: $fullname\n";

// Q6
define('PI', 3.142);
$radius = 5;
$area = PI * $radius * $radius;
$answer = sqrt($area);
echo "Value of PI: " . PI . "\n";
echo "Radius: $radius\n";
echo "Area: $area\n";
echo "Answer (square root of area): $answer (" . round($answer, 2) . ")\n";

// Q7
$centimeters = 50;
$inches = $centimeters * 2.54;
echo "Conversion: $centimeters centimeters are equal to " . round($inches, 10) . " inches\n";

?>