<?php
require_once 'App.php';
$app = new App();
if (!isset($_SESSION['yandex_token'])) {
    header('Location: pages/login.php');
    exit();
}
$app->setSession($_SESSION['yandex_token']);

include './components/header.php';
?>
<?php
$count = $app->countItems();
echo '<div class="count">Количество элементов: ' . $count . '</div>';
echo '<div class="button"><a id="showUploadForm">Загрузить файл</a></div>';
echo '<div id="formContainer" style="display: none;"><form class="upload-form" action="pages/upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Выберите файл для загрузки:</label>
    <input type="file" name="file" id="file" required>
    <input type="submit" value="Загрузить файл"></form></div>';
try {
    $app->show();
} catch (Exception $e) {
    throw new Exception('Ошибка: ' . $e->getMessage());
}
echo '<div class="button"><a href="pages/logout.php">Выйти</a></div>';
?>
<?php
include './components/footer.php';
?>
