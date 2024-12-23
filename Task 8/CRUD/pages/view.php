<?php
require_once '../App.php';
if (!isset($_GET['path'])) {
    die('Файл не указан.');
}

$path = $_GET['path'];
$app = new App();
$app->setSession($_SESSION['yandex_token']);

try {
    $fileContent = $app->view($path);
    echo '<link rel="stylesheet" href="../css/style.css">';
    echo '<h1>Просмотр файла: ' . htmlspecialchars(basename($path)) . '</h1>';
    echo '<pre>' . htmlspecialchars($fileContent) . '</pre>';
    echo '<a href="../showDirectory.php">Назад</a>';
} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage();
}
?>
