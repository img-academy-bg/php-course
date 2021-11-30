
<?php

/*

Да се създаде работещ календар. За целта трябва да бъдат изпълнени следните условия:

- 1. При избран месец от падащото меню и попълнена година в полето - да се визуализира календар за въпросните месец и година
- 2. Ако не е избран месец или година, да се използват текущите (пример: ноември, 2021)
- 3. Месецът и годината, за които е показан календар да са попълнени в падащото меню и полето за година
- 4. При натискане на бутон "Today" да се показва календар за текущите месец и година
- 5. В първия ред на календара да има:
  - 1. Стрелка на ляво, която да показва предишния месец при кликване
  - 2. Текст с името на месеца и годината, за които са показани дните
  - 3. Стрелка в дясно, която да показва следващия месец при кликване
- 6. Таблицата да показва дни от предишния и/или следващия месец до запълване на седмиците (пример: Ако месеца започва в сряда, да се покажат последните два дни от предишния месец за вторник и понеделник)
- 7. Показаните дни в таблицата трябва да са черни и удебелени за текущия месец, и сиви за предишен или следващ месец (css клас "fw-bold" за текущия месец и "text-black-50" за останалите)

*/

// Месец, за който ще се показва календара:
$m = (int) ($_GET['m'] ?? date('n'));
// Година, за която ще се показва календара:
$y = (int) ($_GET['y'] ?? date('Y'));
// Timestamp за първия ден от месеца
$firstDayTS = mktime(0, 0, 0, $m, 1, $y);
// Брой дни в показвания месец:
$numDays = date('t', $firstDayTS);
// Взимаме името на месеца, за който ще показваме календар:
$monthName = date('F', $firstDayTS);
// Ден от седмицата за първия ден от месеца:
$firstDayOfWeek = date('N', $firstDayTS);
// Ден от седмицата за последния ден от месеца:
$lastDayOfWeek = date('N', mktime(0, 0, 0, $m, $numDays, $y));

// Едномерен масив с дните, които се показват в календара
// Задаване на дните от избрания месец:
$days = [];
for ($i = 1; $i <= $numDays; $i++) {
    $days[] = [
        'day' => $i,
        'cssClass' => 'fw-bold'
    ];
}

// Текущи месец и година:
$todayM = date('n');
$todayY = date('Y');

// Следващи месец и година:
if ($m === 12) {
    $nextMonth = 1;
    $nextYear = $y + 1;
} else {
    $nextMonth = $m + 1;
    $nextYear = $y;
}

// Проверяваме дали последния ден от месеца е неделя и ако не е - допълваме:
if ($lastDayOfWeek < 7) {
    // Разликата от неделя до последния ден от седмицата:
    $diff = 7 - $lastDayOfWeek;
    // циклим от 1 до разликата и допълваме масива с дните:
    for ($i = 1; $i <= $diff; $i++) {
        $days[] = [
            'day' => $i,
            'cssClass' => 'text-black-50'
        ];
    }
}

// Предишни месец и година:
if ($m === 1) {
    $prevMonth = 12;
    $prevYear = $y - 1;
} else {
    $prevMonth = $m - 1;
    $prevYear = $y;
}

// Проверяваме дали първия ден от месеца е различен от понеделник и допълваме ако е:
if ($firstDayOfWeek > 1) {
    // Timestamp на първия ден от предишния месец:
    $prevFirstDayTS = mktime(0, 0, 0, $prevMonth, 1, $prevYear);
    // Брой дни в предишния месец:
    $prevNumDays = date('t', $prevFirstDayTS);
    // Разлика от първия ден от седмицата на показвания месец до понеделник:
    $diff = 7 - (-1 * ($firstDayOfWeek - 7)) - 1;
    for ($i = 0; $i < $diff; $i++) {
        array_unshift($days, [
            'day' => $prevNumDays--,
            'cssClass' => 'text-black-50'
        ]);
    }
}

// Разделяне на масива на парчета от по 7 стойности всяко:
$calendar = array_chunk($days, 7);

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Calendar</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col">
          <h1>Calendar</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
          <form class="row g-3">
            <div class="col-md-6 col-lg-6">
              <label class="form-label" for="month">Select month</label>
              <select name="m" class="form-control" id="month">
                <option <?php if ($m === 1) echo 'selected'; ?>  value="1">January</option>
                <option <?php if ($m === 2) echo 'selected'; ?>  value="2">February</option>
                <option <?php if ($m === 3) echo 'selected'; ?>  value="3">March</option>
                <option <?php if ($m === 4) echo 'selected'; ?>  value="4">April</option>
                <option <?php if ($m === 5) echo 'selected'; ?>  value="5">May</option>
                <option <?php if ($m === 6) echo 'selected'; ?>  value="6">June</option>
                <option <?php if ($m === 7) echo 'selected'; ?>  value="7">July</option>
                <option <?php if ($m === 8) echo 'selected'; ?>  value="8">August</option>
                <option <?php if ($m === 9) echo 'selected'; ?>  value="9">September</option>
                <option <?php if ($m === 10) echo 'selected'; ?>  value="10">October</option>
                <option <?php if ($m === 11) echo 'selected'; ?>  value="11">November</option>
                <option <?php if ($m === 12) echo 'selected'; ?>  value="12">December</option>
              </select>
            </div>
            <div class="col-md-6 col-lg-6">
              <label class="form-label" for="year">Year:</label>
              <input type="text" name="y" class="form-control" value="<?= $y; ?>">
            </div>
            <div class="col-md-12 col-lg-12">
              <button type="submit" class="btn btn-primary">Show</button>
              <a href="?m=<?= $todayM; ?>&y=<?= $todayY; ?>" class="btn btn-secondary">Today</a>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mt-5 offset-md-3 col-lg-6 offset-lg-3">
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>
                  <a href="?m=<?= $prevMonth; ?>&y=<?= $prevYear; ?>" title="Previous month">&larr;</a>
                </th>
                <th colspan="5" class="text-center"><?= $monthName . ', ' . $y ?></th>
                <th>
                  <a href="?m=<?= $nextMonth; ?>&y=<?= $nextYear; ?>" title="Next month">&rarr;</a>
                </th>
              </tr>
              <tr>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($calendar as $week): ?>
                <tr>
                    <?php foreach ($week as $dayInfo): ?>
                    <td class="<?= $dayInfo['cssClass']; ?>">
                        <?= $dayInfo['day']; ?>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>