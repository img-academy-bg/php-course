<?php

// 04-db/cities.php
// Създаване (инстанцииране) на нов PDO обект
$pdo = new PDO('mysql:dbname=world;host=localhost', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Взимаме данните от формите
    // 2. Подготвяме SQL заявка за добавяне на нов запис
    // 3. Изпълняваме заявката
    // 4. Пренасочваме към същата страница
    
    // 1. - Данните са в $_POST
    // 2.
    $sql = "INSERT INTO city VALUES(NULL, :name, :country, :district, :population)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $_POST['name']);
    $stmt->bindValue(':country', $_POST['country']);
    $stmt->bindValue(':district', $_POST['region']);
    $stmt->bindValue(':population', $_POST['population']);
    // 3.
    if ($stmt->execute()) {
        // 4.
        $urlParams = http_build_query($_POST); // param1=value1&param2&val2
        header('Location: cities.php?' . $urlParams);
    } else {
        // 4.
        header('Location: cities.php?err=' . $stmt->errorCode());
    }
    die();
}

// Проверяваме дали има $_GET['delete'] и ако има изготвяме заявка за изтриване и я изпълняваме
if (isset($_GET['delete'])) {
    $sql = "DELETE FROM city WHERE ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', (int) $_GET['delete'], PDO::PARAM_INT);
    $stmt->execute();
}

$limit = (int) ($_GET['perPage'] ?? 10);
$currentPage = (int) ($_GET['currentPage'] ?? 1);
$offset = ($currentPage - 1) * $limit;

// Създаване на SQL заявка, която ще изведе градовете и името на държавата:
$sql = "SELECT c.ID, c.Name, c.District, c.Population, co.Name AS CountryName "
        . "FROM city c "
        . "INNER JOIN country co ON co.Code = c.CountryCode "
        . "ORDER BY c.ID "
        . "LIMIT {$limit} OFFSET {$offset}";
// Изпълнение на заявката
$result = $pdo->query($sql);
// Взимане на всички резултати за градовете:
$cities = $result->fetchAll(PDO::FETCH_ASSOC);

// SQL за преброяване на редовете в city
$sqlCountCities = "SELECT COUNT(c.ID) AS countCities FROM city c "
        . "INNER JOIN country co ON co.Code = c.CountryCode";
$countResult = $pdo->query($sqlCountCities);
$countCities = $countResult->fetch(PDO::FETCH_ASSOC); // ['countCities']
$totalCities = (int) $countCities['countCities'];
$totalPages = ceil($totalCities / $limit);

// SQL заявка за извеждане на код и име на всяка държава:
$sqlCountries = "SELECT Code, Name FROM country ORDER BY Name";
// Изпълнение на заявката
$resultCountries = $pdo->query($sqlCountries);
// Взимане на всички резултати за държавите:
$countries =$resultCountries->fetchAll(PDO::FETCH_ASSOC);

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
        <h1>Insert form</h1>
        <main>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <form method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" value="<?= $_GET['name'] ?? ''; ?>" name="name" id="name" class="form-control" placeholder="name">
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country:</label>
                            <select name="country" class="form-control" id="country">
                                <option>Select country</option>
                                <?php foreach ($countries as $country): ?>
                                <option <?php if (isset($_GET['country']) && $_GET['country'] === $country['Code']): ?> selected="selected"<?php endif; ?> value="<?= $country['Code']; ?>">
                                    <?= $country['Name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="population" class="form-label">Population:</label>
                            <input type="text" value="<?= $_GET['population'] ?? ''; ?>" name="population" id="population" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="region" class="form-label">Region:</label>
                            <input type="text" value="<?= $_GET['region'] ?? ''; ?>" name="region" id="region" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Insert</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>Population</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cities as $city): ?>
                            <tr>
                                <td><?= $city['ID']; ?></td>
                                <td><?= $city['Name']; ?></td>
                                <td><?= $city['CountryName']; ?></td>
                                <td><?= $city['District']; ?></td>
                                <td><?= $city['Population']; ?></td>
                                <td>
                                    <a href="?edit=<?= $city['ID']; ?>">Edit</a> |
                                    <a href="?delete=<?= $city['ID']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?currentPage=<?= $currentPage - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++): 
                                
                                $liClasses = 'page-item';
                                if ($i === $currentPage) {
                                    $liClasses .= ' active';
                                }
                            ?>
                            <li class="<?= $liClasses; ?>">
                                <a class="page-link" href="?currentPage=<?= $i; ?>">
                                    <?= $i; ?> 
                                </a>
                            </li>
                            <?php endfor; ?>
                            <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?currentPage=<?= $currentPage + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </main>
    </body>
</html>