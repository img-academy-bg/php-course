<?php

// 03-loops/foreach.php

// Създаваме масив с числа от 1 до 20:
//$array = range(1, 20);

// Обхождаме масива и извеждаме всяка негова стойност:
//foreach ($array as $key => $value) {
//    echo '[' . $key . '] => ' . $value . '<br />';
//}

$users = [
    [
        'name' => 'John Doe',
        'email' => 'j.doe@example.com',
        'age' => 30,
        'phone' => '+359123123123',
    ],
    [
        'name' => 'Jane Dean',
        'email' => 'j.dean@example.org',
        'age' => 24,
        'phone' => '+3591235555555',
    ],
];

foreach ($users as $index => $user) {
    echo 'User #' . $index;
    echo '<ul>';
    echo '<li>Name: ' . $user['name'] . '</li>';
    echo '<li>Email: ' . $user['email'] . '</li>';
    echo '<li>Age: ' . $user['age'] . '</li>';
    echo '<li>Phone #: ' . $user['phone'] . '</li>';
    echo '</ul>';
}
