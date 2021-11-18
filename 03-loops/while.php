<?php

// 03-loops/while.php

// 1. Да се създаде масив с 10 уникални числа между 0 и 15
// 2. Да се изведе на екрана масива и броя на итерациите за въвеждането

// Масив с уникални числа:
$uniqueInts = [];
// Брой на итерации:
$iterations = 0;

// Условие: масива да има по-малко от 10 стойности
while (count($uniqueInts) < 10) {
    // Инкрементираме броя на итерациите:
    $iterations++;
    echo 'Iteration #' . $iterations . '<br >';
    // Произволно число между 0 и 15
    $random = rand(0, 15);
    echo 'Generated random int: ' . $random . '<br />';
    // Проверяваме дали числото не се съдържа в масива:
    if (!in_array($random, $uniqueInts)) {
        echo 'Not in array<br />';
        $uniqueInts[] = $random;
    } else {
        echo 'Already in array<br />';
    }
    echo '<hr />';
}

var_dump($uniqueInts, $iterations);