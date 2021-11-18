<?php

// 01-vars/view.php
require_once 'data.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Variables</title>
    </head>
    <body>
        <ul>
            <li>Name: <?= $name; ?></li>
            <li>Age: <?= $age; ?></li>
            <li>
                Email: 
                <a href="mailto:<?= $email; ?>">
                    <?= $email; ?>
                </a>
            </li>
        </ul>
    </body>
</html>