<?php
$pageTitle = "編集確認画面";
$message = "下記の内容で更新しますか？";

// 編集用の処理ページ
$formAction = "dbconnect_edit.php";

// 受け取るデータ
$formData = $_POST;
$isEdit = true;

if (!isset($formData['id']) && isset($_POST['id'])) {
    $formData['id'] = $_POST['id'];
}

include 'confirm_template.php';
?>
