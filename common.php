<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// DB接続設定
function getDbConnection() {
    $pdo = 'mysql:dbname=sample;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    ];

    try {
        return new PDO($pdo, $user, $password, $options);
    } catch (PDOException $e) {
        echo 'データベース接続エラー: ' . $e->getMessage();
        exit;
    }
}
?>
