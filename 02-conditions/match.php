<?php

// 02-conditions/match.php

$httpStatus = rand(200, 599);
$result = (int) ($httpStatus / 100);

$output = match ($result) {
    2 => 'OK group',
    3 => 'Redirect group',
    4 => 'Request Error group',
    default => 'Server Error group'
};

echo 'HTTP status: ' . $httpStatus . '<br />';
echo 'Output: ' . $output;
