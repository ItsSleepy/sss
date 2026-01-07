<?php
//Q1
$arrayMarks = array(40, 50, 45, 60, 50);
$numElements = count($arrayMarks);
echo "a. Number of elements in array: $numElements\n";
$sumMarks = array_sum($arrayMarks);
echo "b. Sum of all the values present in the array: $sumMarks\n";
$mean = $sumMarks / $numElements;
echo "c. Mean (average): $mean\n";

function calc($array) {
    $sum = array_sum($array);
    $count = count($array);
    $average = $sum / $count;
    return $average;
}

$functionMean = calc($arrayMarks);
echo "d. Mean calculated using function calc(): $functionMean\n";

//Q2
$age = 21;
echo "Current age: $age\n";

if ($age >= 18) {
    echo "You are allowed to enter the club. Welcome!\n";
} else {
    echo "Sorry, you must be 18 or older to enter the club.\n";
}

$password = "ginger";
echo "Password entered: '$password'\n";

if ($password == "ginger") {
    echo "Password correct! Access granted.\n";
} else {
    echo "Incorrect password! Access denied.\n";
}

//Q3
$random = rand(1, 10);
$guess = 7;

echo "Random number generated: $random\n";
echo "Your guess: $guess\n";

if ($guess == $random) {
    echo "You won!\n";
} else {
    echo "You lose, try again!\n";
}

//Q4
$number1 = rand(1, 3);
$number2 = rand(1, 3);
$number3 = rand(1, 3);

echo "Slot machine results: $number1 - $number2 - $number3\n";

if ($number1 == $number2 && $number2 == $number3) {
    echo "🎉 JACKPOT! All numbers match! You won!\n";
} else {
    echo "Sorry, no match. Try again!\n";
}

//Q5
for ($i = 1; $i <= 10; $i++) {
    echo "$i ";
}

for ($i = 10; $i >= 1; $i--) {
    echo "$i ";
}

//Q6
for ($i = 1; $i <= 50; $i++) {
    if ($i % 2 == 0) {
        echo "$i ";
    }
}

//Q7
for ($i = 1; $i <= 10; $i++) {
    echo "$i ";
}

//Q8
for ($i = 1; $i <= 10; $i++) {
    $result = 6 * $i;
    echo "6 x $i = $result\n";
}
echo "\n";

//Q9
$randomArray = array();
for ($i = 0; $i < 10; $i++) {
    $randomArray[$i] = rand(1, 100);
}

echo "All elements: ";
for ($i = 0; $i < count($randomArray); $i++) {
    echo $randomArray[$i] . " ";
}

echo "a. Array element 0: Value contained is " . $randomArray[0] . "\n";
echo "b. Array element 1: Value contained is " . $randomArray[1] . "\n";
echo "c. Array element 5: Value contained is " . $randomArray[5] . "\n";

//Q10
$num = 6;
while ($num <= 20) {
    if ($num % 2 == 0) {
        echo "$num ";
    }
    $num++;
}

//Q11
$num = 100;
while ($num >= 0) {
    echo "$num ";
    $num -= 10;
}

//Q12
$num = 6;
do {
    if ($num % 2 == 0) {
        echo "$num ";
    }
    $num++;
} while ($num <= 20);

//Q13
$num = 100;
do {
    echo "$num ";
    $num -= 10;
} while ($num >= 0);

//Q14
$counter = 0;
while (true) {
    $counter++;
    echo "Counter: $counter\n";
    if ($counter == 10) {
        break;
    }
}

//Q15
for ($i = 0; $i <= 4; $i++) {
    if ($i == 2) {
        continue;
    }
    echo "Value of i: $i\n";
}

//Q16
$destination = rand(1, 4);
echo "Random destination number: $destination\n";

switch ($destination) {
    case 1:
        echo "Going to Las Vegas\n";
        break;
    case 2:
        echo "Going to Amsterdam\n";
        break;
    case 3:
        echo "Going to Egypt\n";
        break;
    case 4:
        echo "Going to Tokyo\n";
        break;
    default:
        echo "Going nowhere\n";
        break;
}
?>
