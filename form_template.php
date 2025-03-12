<?php
// 共通設定を読み込み
require_once 'common.php';
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- ページタイトルを表示 -->
        <title><?php echo h($pageTitle); ?></title>
        <!-- 共通CSS -->
        <link rel="stylesheet" href="common.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="contact-bg">
            <div class="contact-area inner">
                <p class="contact-message"><?php echo isset($pageTitle) ? $pageTitle : "フォーム"; ?></p>

                <div class="contact-inner container mt-5">
                    <form class="w-50 mx-auto" action="<?php echo isset($formAction) ? $formAction : ''; ?>" method="POST">

                    <!-- idをhiddenで送信 -->
                    <?php if (!empty($message_data['id'])): ?>
                        <input type="hidden" name="id" value="<?php echo h($message_data['id']); ?>">
                    <?php endif; ?>
                    
                    <?php
                        // 項目リスト（表示順を保持）
                        $fields = [
                            'sei' => ['label' => '姓', 'type' => 'text', 'required' => true, 'maxlength' => 20],
                            'mei' => ['label' => '名', 'type' => 'text', 'required' => true, 'maxlength' => 20],
                            'sex' => [
                                'label' => '性別',
                                'type' => 'radio',
                                'required' => true,
                                'options' => ['男性' => '男性', '女性' => '女性']
                            ],
                            'birthday' => ['label' => '生年月日', 'type' => 'date', 'required' => true],
                            'startdate' => ['label' => '入社日', 'type' => 'date', 'required' => true],
                            'postcord' => [
                                'label' => '郵便番号',
                                'type' => 'text',
                                'required' => true,
                                'maxlength' => 7,
                                'pattern' => '^\d{7}$', // 7桁の半角数字のみ許可
                                'class' => 'js-input-number'],
                            'address1' => ['label' => '都道府県', 'type' => 'text', 'required' => true, 'maxlength' => 10],
                            'address2' => ['label' => '市区町村', 'type' => 'text', 'required' => true, 'maxlength' => 30],
                            'address3' => ['label' => 'ビル名', 'type' => 'textarea', 'required' => false, 'maxlength' => 255]
                        ];

                        // 項目ごとに表示
                        foreach ($fields as $name => $field):
                    ?>

                        <!-- フォーム項目 -->
                        <div class="mb-3">
                            <label for="<?php echo $name; ?>" class="form-label"><?php echo $field['label']; ?>
                                <?php if ($field['required']) echo '<span class="essential">必須</span>'; ?>
                            </label>
                            <?php if ($field['type'] === 'radio'): ?>
                                <!-- ラジオボタン -->
                                <div>
                                    <?php foreach ($field['options'] as $value => $label): ?>
                                        <input type="radio" id="<?php echo $value; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>"
                                            <?php echo isset($message_data[$name]) && $message_data[$name] == $value ? 'checked' : ''; ?>
                                            <?php if ($field['required']) echo 'required'; ?>>
                                        <label for="<?php echo $value; ?>"><?php echo $label; ?></label>
                                    <?php endforeach; ?>
                                </div>
                            <?php elseif ($field['type'] === 'textarea'): ?>
                                <!-- テキストエリア -->
                                <textarea id="<?php echo $name; ?>" name="<?php echo $name; ?>" class="form-control"
                                    maxlength="<?php echo $field['maxlength'] ?? ''; ?>"><?php echo isset($message_data[$name]) ? h($message_data[$name]) : ''; ?></textarea>
                            <?php else: ?>
                                <!-- 入力項目 -->
                                <input id="<?php echo $name; ?>" type="<?php echo $field['type']; ?>" name="<?php echo $name; ?>"
                                    class="form-control <?php echo $field['class'] ?? ''; ?>"
                                    maxlength="<?php echo $field['maxlength'] ?? ''; ?>"
                                    value="<?php echo isset($message_data[$name]) ? h($message_data[$name]) : ''; ?>"
                                    <?php if ($field['required']) echo 'required'; ?>>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>

                        <!-- 新規作成時の登録日 -->
                        <?php if (!isset($isEdit) || !$isEdit): ?>
                            <input type="hidden" name="regdate" value="<?php echo date('Y-m-d'); ?>">
                        <?php endif; ?>

                        <!-- 編集時の更新日 -->
                        <?php if (isset($isEdit) && $isEdit): ?>
                            <input type="hidden" name="update" value="<?php echo date('Y-m-d'); ?>">
                        <?php endif; ?>

                        <div class="d-flex justify-content-center gap-2 w-100">
                            <!-- 新規作成時の登録確認ボタン -->
                            <?php if (!isset($isEdit) || !$isEdit): ?>
                                <input type="submit" value="登録確認" class="submit-button btn btn-primary flex-fill" name="submit-button">
                            <?php else: ?>

                            <!-- 編集時の編集確認ボタン -->
                                <input type="submit" value="編集確認" class="submit-button btn btn-primary flex-fill" name="update-button">
                            <?php endif; ?>

                            <!-- 戻るボタン -->
                            <input type="button" value="戻る" class="cancel-button btn btn-secondary flex-fill" name="cancel-button" onclick="history.back()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        // .js-input-number を取得
        document.addEventListener("DOMContentLoaded", function() {
            const inputNumbers = document.querySelectorAll('.js-input-number');

            for (const inputNumber of inputNumbers) {
                // リアルタイムで入力が変化したとき関数を実行
                inputNumber.addEventListener('input', convertInputNumber);
                // IME（日本語変換など）で確定したタイミングで実行
                inputNumber.addEventListener('compositionend', convertInputNumber);
                // フォーカスが外れたタイミングで実行
                inputNumber.addEventListener('blur', convertInputNumber);
            }

            function convertInputNumber(e) {
                setTimeout(() => {
                    let val = this.value;

                    // 全角数字を半角に変換
                    val = val.replace(/[０-９]/g, function(s) {
                        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0); 
                    });

                    // 数字以外の文字を削除
                    val = val.replace(/[^0-9]/g, ''); 

                    // 7桁以上入力できないように制限
                    if (val.length > 7) {
                        val = val.slice(0, 7);
                    }

                    this.value = val;
                }, 0);
            }
        });

        // form を取得
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            
            form.addEventListener("submit", function(event) {
                const birthday = document.getElementById("birthday").value;
                const startdate = document.getElementById("startdate").value;
                const today = new Date().toISOString().split("T")[0]; // 今日の日付（YYYY-MM-DD）

                if (birthday > today) {
                    alert("生年月日は過去の日付を選択してください。");
                    event.preventDefault();
                    return;
                }

                if (startdate > today) {
                    alert("入社日は今日以前の日付を選択してください。");
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>
</html>