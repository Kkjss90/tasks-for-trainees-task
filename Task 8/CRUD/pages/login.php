<?php
session_start();
require_once '../config/config.php';

if (!empty($_SESSION['yandex_token'])) {
    header('Location: ../index.php');
    exit();
}

if (!empty($_GET['logout'])) {
    unset($_SESSION['yandex_token']);
    header('Location: login.php');
    exit();
}
if (!empty($_GET)) {
    $state = $_GET['state'];
}

if (!empty($_GET['code'])) {
    $params = array(
        'grant_type' => 'authorization_code',
        'code' => $_GET['code'],
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET,
    );

    $ch = curl_init('https://oauth.yandex.ru/token');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $data = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($data, true);
    if (!empty($data['access_token'])) {
        $_SESSION['yandex_token'] = $data['access_token'];
        header('Location: ../index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Яндекс.Диск CRUD</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h1>CRUD приложение для Яндекс.Диска</h1>
</header>
<div class="container">
    <section id="login" class="login-page">
        <div class="login-form">
            <h2>Вход в Яндекс</h2>
            <div class="login-container">
                <p id="error-message"></p>
                <?php
                $params = array(
                    'client_id' => CLIENT_ID,
                    'redirect_uri' => REDIRECT_URI,
                    'response_type' => 'code',
                    'state' => '123'
                );

                $url = 'https://oauth.yandex.ru/authorize?' . urldecode(http_build_query($params));
                echo '<a href="' . $url . '">Авторизация через Яндекс</a>';
                ?>

            </div>
        </div>
    </section>
</div>
</body>
</html>
