<?php
require_once '../App.php';

if (!isset($_GET['path'])) {
    die('Файл не указан.');
}

$path = $_GET['path'];
$app = new App();
$app->setSession($_SESSION['yandex_token']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $newContent = $_POST['content'];

        $app->edit($path, $newContent);

        echo 'Файл успешно обновлен! <a href="../showDirectory.php">Вернуться назад</a>';
    } catch (Exception $e) {
        echo 'Ошибка: ' . $e->getMessage();
    }
    exit();
}

try {
    $fileContent = $app->view($path);
} catch (Exception $e) {
    die('Ошибка: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование файла</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>Редактирование файла: <?= htmlspecialchars(basename($path)) ?></h1>
<form action="edit.php?path=<?= urlencode($path) ?>" method="post">
    <textarea name="content" rows="20" cols="80"><?= htmlspecialchars($fileContent) ?></textarea><br>
    <button type="submit">Сохранить изменения</button>
</form>
<a href="../showDirectory.php">Назад</a>
</body>
</html>
