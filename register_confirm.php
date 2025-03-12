<?php
$pageTitle = "登録確認画面";
$message = "下記スタッフを登録しますか？";

// 登録用の処理ページ
$formAction = "dbconnect_register.php"; 

// 受け取るデータ
$formData = $_POST;

include 'confirm_template.php';
?>