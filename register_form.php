
<!DOCTYPE html>
<html lang= "ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="register.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>登録</title>
    </head>

    <script>
        // 対象となる全ての入力フィールドを取得
        const inputNumbers = document.querySelectorAll('.js-input-number');
        
        // 各フィールドにイベントリスナーを追加
        for (const inputNumber of inputNumbers) {
            // 入力時に半角数字に変換
            inputNumber.addEventListener('input', convertInputNumber);

            // IME（日本語入力）が確定したときに変換
            inputNumber.addEventListener('compositionend', convertInputNumber);

            // フォーカスが外れた際に半角数字に変換
            inputNumber.addEventListener('blur', convertInputNumber);
        }

        // 入力された値を処理する関数
        function convertInputNumber(e) {
            // 入力が確定してから少し待って値を取得
            setTimeout(() => {
                let val = this.value;

                // 全角数字を半角数字に変換
                val = val.replace(/[０-９]/g, function(s) {
                    return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
                });

                // 半角数字以外を除去
                val = val.replace(/[^0-9]/g, '');
                
                // フィールドの値を更新
                this.value = val;
            }, 0);  // setTimeoutを使い、入力後に値を取得
        }
    </script>

    <body>
        <div class="contact-bg">
            <div class="contact-area inner">
                <p class="contact-message">登録画面</p>

                <div class="contact-inner">
                    <form action="register_confirm.php" method="POST">
                        <table class="contact-table">
    
                            <tr class="table-list">
                                <th>
                                    <label for="name">お名前<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="sei" type="text" name="sei" placeholder="姓" class="input-area" maxlength="20" size="20" required>
                                </td>
                                <td>
                                    <input id="mei" type="text" name="mei"  placeholder="名" class="input-area" maxlength="20" size="20" required>
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="sex">性別<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="men" type="radio" name="sex" value="男性" required>男性
                                    <input id="women" type="radio" name="sex" value="女性" required>女性
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="birthday">生年月日<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="date" type="date" name="birthday" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="startdate">入社日<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="date" type="date" name="startdate" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="postcord">郵便番号<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="postcord" type="text" name="postcord" class="js-input-number input-area" inputmode="numeric" maxlength="7" size="7" required>
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="address1">都道府県<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="address1" type="text" name="address1" class="input-area" maxlength="10" size="10" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="address2">市区町村<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="address2" type="text" name="address2" class="input-area" maxlength="10" size="10" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="address3">ビル名</label>
                                </th>
                                <td>
                                    <textarea id="address3" type="text" name="address3" maxlength="255" size="255"></textarea>
                                </td>
                                <th>
                                    <input id="date" type="hidden" name="regdate" value="<?php date_default_timezone_set("Asia/Tokyo");
                                        echo date('Y-m-d'); ?>">
                                </th>
                            </tr>
                        </table>
                        <input type="submit" value="確認" class="button" name="submit-button">
                        <input type="button" value="戻る" class="cancel-button" name="cancel-button" onclick="history.back()">
    
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>