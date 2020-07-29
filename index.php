<?php

spl_autoload_register(function ($class) {
    require $class . '.php';
});

// PHP Задание 1. Напишите код (функцию, класс), которая проверяет простое число или нет
// На вход - число, выход - да/нет
echo PrimeNumberCalculator::isPrimeNumber(43) . PHP_EOL;

// PHP Задание 2. Есть счет, в котором указана сумма с НДС, есть дата счета и все прочие атрибуты.
// Напишите класс, в нем метод - в который на вход поступает информация о счете, на выходе - стоимость без НДС (страна -
// Российская Федерация)
$invoice = new Invoice('1500');
echo InvoiceHandler::getPriceWithoutVat($invoice) . PHP_EOL;

// XML Задание 2. Напишите код (на PHP) выдающий массив данных:
//   - Должник: id, тип, имя
//   - Список лотов: по каждому - номер, стоимость, описание.
$xml = simplexml_load_file('test.xml');
$bankruptInfo = $xml->BankruptInfo;
$lots = $xml->MessageInfo->Auction->LotTable->AuctionLot;

echo 'Должник: id ' . $bankruptInfo->BankruptPerson->attributes()['Id'] . ' тип ' .
    $bankruptInfo->attributes()['BankruptType'] . ' имя ' . $bankruptInfo->BankruptPerson->attributes()['FirstName'] . PHP_EOL;

foreach ($lots as $lot) {
    echo 'Лот номер: ' . $lot->Order . ', стоимость: ' . $lot->StartPrice . ', описание: ' . $lot->Description;
}

// MySQL Задание 2. Выведите имена пользователей и названия офисов, в которых они сидят

$dataBaseSettings = [
    'host' => 'localhost',
    'userName' => 'root',
    'password' => '123456',
    'dbName' => 'test',
    'charset' => 'utf8mb4'
];

$dsn = "mysql:host={$dataBaseSettings['host']};dbname={$dataBaseSettings['dbName']};charset={$dataBaseSettings['charset']}";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $dataBaseSettings['userName'], $dataBaseSettings['password'], $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$query = "SELECT users.name, offices.name as office FROM users LEFT JOIN offices ON users.office_id = offices.id";

$searchResult = $pdo->query($query)->fetchAll();

foreach ($searchResult as $item) {
    echo 'Имя: ' . $item['name'] . ', офис: ' . $item['office'] . PHP_EOL;
}

// MySQL Задание 3. Выведите названия офисов, в котором сидят больше, чем один пользователь
$query = "SELECT offices.name, COUNT(users.id) as quantity FROM users LEFT JOIN offices ON users.office_id = offices.id
GROUP BY offices.name HAVING quantity > 1";

$searchResult = $pdo->query($query)->fetchAll();

foreach ($searchResult as $item) {
    echo 'Название офиса: ' . $item['name'] . PHP_EOL;
}

