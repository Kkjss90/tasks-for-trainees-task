<?php
require_once '../App.php';
require_once '../vendor/autoload.php';
$app = new App();
$app->setSession($_SESSION['yandex_token']);

if (!isset($_SESSION['yandex_token'])) {
    header('Location: login.php');
    exit();
}

$pathToDelete = $_POST['path'] ?? null;

if (!$pathToDelete) {
    $response = [
        'result' => 'error',
        'message' => 'Путь к ресурсу не указан.'
    ];
} else {
    try {
        $message = $app->delete($pathToDelete);

        $response = [
            'result' => 'success',
            'message' => $message
        ];
    } catch (Exception $e) {
        $response = [
            'result' => 'error',
            'message' => 'Ошибка: ' . $e->getMessage()
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
