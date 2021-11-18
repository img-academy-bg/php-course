<?php

// 02-conditions/switchcase.php

// Взимаме произволно число между 200 и 599:
$httpStatus = rand(200, 599);

// ОК           200 - 299 -> 2
// Redirect     300 - 399 -> 3
// Error        400 - 499 -> 4
// Server Error 500+      -> 5

echo 'HTTP status: ' . $httpStatus . '<br />';
// Целочислен резултат от делене на статуса на 100:
$result = (int) ($httpStatus / 100);

switch ($result) {
    
    case 2:
        echo 'Status code is in OK group <br />';
        if ($httpStatus === 200) {
            echo 'Status code is 200 OK';
        }
        break;
    
    case 3:
        echo 'Status code is in Redirect group';
        break;
    
    case 4:
        echo 'Status code is in Request Error group';
        break;
    
    default:
        echo 'Status code is in Server Error group';
        break;
    
}

//if ($httpStatus >= 200 && $httpStatus <= 299) {
//    echo 'Status code is in OK group <br />';
//} else if ($httpStatus >= 300 && $httpStatus <= 399) {
//    echo 'Status code is in Redirect group';
//} else if ($httpStatus >= 400 && $httpStatus <= 499) {
//    echo 'Status code is in Request Error group';
//} else {
//    echo 'Status code is in Server Error group';
//}
