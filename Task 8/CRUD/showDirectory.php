<?php
require_once 'App.php';
$app = new App();

include './components/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['path'])) {
    $path = $_POST['path'];
    $app->setSession($_SESSION['yandex_token'], $path);

    $app->show();
} else {
    echo "Путь не указан.";
}

echo '<div><a href="index.php">Назад</a></div>';

include './components/footer.php';
?>
