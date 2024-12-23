<?php
require_once '../App.php';
require_once '../vendor/autoload.php';
$app = new App();
$app->setSession($_SESSION['yandex_token']);

if (!isset($_SESSION['yandex_token'])) {
    header('Location: pages/login.php');
    exit();
}
$fileName = $_FILES['file']['name'];
$tmpPath = $_FILES['file']['tmp_name'];
$diskPath = $_SESSION['path'] . $fileName;
$localPath = __DIR__ . '/temp/' . $fileName;

if (!is_dir(__DIR__ . '/temp')) {
    mkdir(__DIR__ . '/temp', 0777, true);
}

try {
    if (!move_uploaded_file($tmpPath, $localPath)) {
        throw new Exception('Не удалось сохранить файл на сервере.');
    }

    if ($app->disk->getResource($diskPath)->has()) {
        $response = [
            'result' => 'error',
            'text' => "Файл $fileName уже загружен.",
            'fileName' => $fileName,
            'path' => $diskPath
        ];
    } else {
        $result = $app->upload($localPath, $diskPath);

        unlink($localPath);

        $response = [
            'result' => $result,
            'fileName' => $fileName,
            'path' => $diskPath,
            'message' => 'Файл успешно загружен на Яндекс.Диск.'
        ];
        header('Location: ../index.php');
        exit;
    }
} catch (Exception $e) {
    if (file_exists($localPath)) {
        unlink($localPath);
    }

    $response = [
        'result' => 'error',
        'text' => 'Ошибка: ' . $e->getMessage()
    ];
}

header('Content-type: application/json');
echo json_encode($response);
exit();
?>
