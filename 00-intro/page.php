<?php

// page.php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP and HTML</title>
    </head>
    <body>
        <h1>
            <?php echo "This is PHP title"; ?>
        </h1>
        <?= "<h3>This is subtitle</h3>"; ?>
        <div>
            <p>
                <?php include_once "output.php"; ?>
            </p>
            <p>
                <?php include_once "output.php"; ?>
            </p>
            <?php require "some/file.alabala"; ?>
        </div>
    </body>
</html>