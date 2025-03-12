<?php
// 共通設定を読み込み
require_once 'common.php';
?>
<!DOCTYPE html>
<html lang= "ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="common.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo h($pageTitle); ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="contact-bg">
            <div class="contact-area inner">
                <p class="contact-message"><?php echo h($pageTitle); ?></p>
                <p class="message-notice"><?php echo h($message); ?></p>
                <div class="d-flex justify-content-center gap-2">
                    <input type="button" value="メイン画面へ戻る" class="submit-button btn btn-primary" name="top-button" onclick="location.href='./login.php'">
                </div>
            </div>
        </div>
    </body>
</html>                    