<?php

// 04-db/index.php

/*
 * PDO - Php Data Objects - библиотека с функционалност за връзка с БД
 * 1. PDO е обектно-ориентиран интерфейс
 * Обект е съставен тип данни, който съдържа стойности (данни) и функционалност.
 * Данните и функционалността са описани в класове.
 */

// 1-ви параметър стринг dsn (data-source name):
$dsn = 'mysql:dbname=world;host=localhost';
// 2-ри параметър - потребителско име за достъп до БД:
$user = 'root';
// 3-ти параметър - парола за достъп до БД:
$pass = '';
// Създаване на обект от клас PDO:
$pdo = new PDO($dsn, $user, $pass);

$countryCode = $_GET['country'] ?? 'BGR';

// Изпълняваме заявка и взимаме резултата:
// Подготвяме SQL заявка с параметър :countryCode:
$stmt = $pdo->prepare("SELECT * FROM city WHERE CountryCode = :countryCode");
// Задаване на стойност на параметъра :countryCode
$stmt->bindValue(':countryCode', $countryCode);
// Изпълнение на подготвената заявка със зададената стойност за параметъра:
$stmt->execute();

if ($stmt->rowCount()) {
    // Взимане на всички редове от резултата на заявката:
    // (Константа FETCH_ASSOC, част от класа PDO):
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        echo '<ul>';
        foreach ($row as $column => $value) {
            echo '<li>' . $column . ': ' . $value . '</li>';
        }
        echo '</ul>';
        echo '<hr />';
    }
} else {
    echo '<h1>Заявката не върна редове!</h1>';
}

