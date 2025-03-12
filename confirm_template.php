<?php
// 共通設定を読み込み
require_once 'common.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo h($pageTitle); ?></title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="contact-bg">
        <div class="contact-area inner">
            <p class="contact-message"><?php echo h($pageTitle); ?></p>
            <p class="message-notice"><?php echo h($message); ?></p>

            <div class="contact-inner container">
                <form class="w-50 mx-auto p-3" action="<?php echo h($formAction); ?>" method="POST">
                    <!-- idをhiddenで送信 -->
                    <?php if (!empty($formData['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo h($formData['id']); ?>">
                    <?php endif; ?>
                    <?php 
                    // 項目リスト（表示順を保持）
                    $fields = [
                        "sei" => "姓",
                        "mei" => "名",
                        "sex" => "性別",
                        "birthday" => "生年月日",
                        "startdate" => "入社日",
                        "postcord" => "郵便番号",
                        "address1" => "都道府県",
                        "address2" => "市区町村",
                        "address3" => "ビル名",
                        "regdate" => "登録日"
                    ];

                    // 姓名は横並びに表示
                    if (isset($formData["sei"]) && isset($formData["mei"])): ?>
                        <div class="mb-3">
                            <label>お名前</label>
                            <div class="d-flex gap-2">
                                <input type="hidden" name="sei" value="<?php echo h($formData["sei"]); ?>">
                                <input type="hidden" name="mei" value="<?php echo h($formData["mei"]); ?>">
                                <input type="text" class="form-control" value="<?php echo h($formData["sei"]); ?>" disabled>
                                <input type="text" class="form-control" value="<?php echo h($formData["mei"]); ?>" disabled>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php 
                    // 他の項目をループ処理
                    foreach ($fields as $key => $label): 
                        if (($key !== "sei" && $key !== "mei") && isset($formData[$key])): ?>
                            <div class="mb-3">
                                <label for="<?php echo $key; ?>"><?php echo $label; ?></label>
                                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo h($formData[$key]); ?>">
                                <input type="text" class="form-control" value="<?php echo h($formData[$key]); ?>" disabled>
                            </div>
                        <?php endif;
                    endforeach; ?>

                    <div class="d-flex justify-content-center gap-2 w-100">
                        <?php if (isset($isDelete) && $isDelete): ?>
                            <!-- 削除確認ボタン -->
                            <input type="submit" value="削除" class="delete-button btn btn-danger flex-fill" name="delete-button">
                            <input type="button" value="戻る" class="cancel-button btn btn-secondary flex-fill" name="cancel-button" onclick="history.back()">
                        <?php elseif (isset($isEdit) && $isEdit): ?>
                            <!-- 編集確定ボタン -->
                            <input type="submit" value="確定" class="submit-button btn btn-primary flex-fill" name="update-complete-button">
                            <input type="button" value="修正" class="cancel-button btn btn-secondary flex-fill" onclick="history.back()">
                        <?php else: ?>
                            <!-- 新規確認ボタン -->
                            <input type="submit" value="確定" class="submit-button btn btn-primary flex-fill">
                            <input type="button" value="修正" class="cancel-button btn btn-secondary flex-fill" onclick="history.back()">
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
