<?php

// 03-loops/nested.php

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      <table class="table table-bordered">
          <?php for ($i = 0; $i < 10; $i++): ?>
              <tr>
              <?php for ($j = 0; $j < 10; $j++): ?>
                  <td><?= (($i * 10) + $j) + 1; ?></td>
              <?php endfor; ?>
              </tr>
          <?php endfor; ?>
      </table>
  </body>
</html>