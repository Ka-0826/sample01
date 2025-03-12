<?php
// 共通設定を読み込み
include 'common.php';

// データベース接続
$pdo = getDbConnection();

$message_data = [];

// SQL作成(id
if (!empty($_GET['id'])) {
    try {
        $stmt = $pdo->prepare('SELECT * FROM mst_employee WHERE id = :id');
        // 値をセット
        $stmt->bindValue( ':id', $_GET['id'], PDO::PARAM_INT);
        // SQLクエリの実行
        $stmt->execute();
        // 表示するデータを取得
        $message_data = $stmt->fetch(); 
    } catch (PDOException $e) {
        $error_message[] = $e->getMessage();
        exit;
    }
}

// 投稿データが取得できないときは管理ページに戻る
if( empty($message_data) ) {
    header("Location: ./login.php");
    exit;
} 

// DB切断
$pdo = null;

$pageTitle = "編集画面";
$formAction = "edit_confirm.php";
$isEdit = true;
include 'form_template.php';
?>