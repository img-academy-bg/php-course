<?php

// 02-conditions/ifelse.php

// Взимаме произволно число между 1 и 10:
$randomInt = rand(1, 10);
// Извеждаме стойността на екрана и прехвърляме на нов ред:
echo $randomInt . '<br />';

// блок, който ще се изпълни само ако променливата е по-голяма от 5
if ($randomInt > 5) {
    echo 'The variable is greater than 5 <br />';
    // Проверяваме дали стойността е по-голяма от 7:
    if ($randomInt > 7) {
        echo 'The value is 8, 9 or 10';
    }
} else if ($randomInt === 5) {
    // блок, който ще се изпълни когато променливата е равна на 5:
    echo 'The variable is equal to 5';
} else {
    // блок, който ще се изпълни ако променливата не е по-голяма от 5
    // т.е. условието е false:
    echo 'The variable is lower than 5 <br />';
    // Проверка дали числото е четно или не:
    // Проверява се дали остатъка от делене на променливата на 2 е равен на 0
//    if (($randomInt % 2) === 0) {
//        echo 'The value is even';
//    } else {
//        echo 'The value is odd';
//    }
    // 0, '0', null, '' == false
    // 2 % 2 -> 0, 0 -> false, !false -> true
    echo !($randomInt % 2) ? 'The value is even' : 'The value is odd';
    // 2 % 2 -> 0, 0 -> false:
//    echo ($randomInt % 2) ? 'The value is odd' : 'The value is even';
}
