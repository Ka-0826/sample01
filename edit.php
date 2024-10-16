<?php

   //DBへの接続準備
    $pdo = 'mysql:dbname=sample;host=localhost;charset=utf8';
    $user = 'root';
    $password = 'root';
    $options = array(
        // SQL実行失敗時にはエラーコードのみ設定
        PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
        // デフォルトフェッチモードを連想配列形式に設定
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
        // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    );

    try {
        // PDOオブジェクト生成（DBへ接続）
        $pdo = new PDO($pdo, $user, $password, $options);

        // SQL作成(GETでIDが渡された場合）
        if (!empty($_GET['id'])) {
            $stmt = $pdo->prepare('SELECT * FROM mst_employee WHERE ID = :id');
            // 値をセット
            $stmt->bindValue( ':id', $_GET['id'], PDO::PARAM_INT);
            // SQLクエリの実行
            $stmt->execute();
            // 表示するデータを取得
            $message_data = $stmt->fetch();

            // 投稿データが取得できないときは管理ページに戻る
            if( empty($message_data) ) {
                header("Location: ./login.php");
                exit;
            }
        }
        
    } catch (PDOException $e) {
        $error_message[] = $e->getMessage();
        exit;
    }

    // POSTでフォームが送信された場合の処理
    if (!empty($_POST)) {

        // SQL文を作成して更新処理
        $stmt = $pdo->prepare('UPDATE mst_employee SET sei = :sei, mei = :mei, sex = :sex, birthday = :birthday, startdate = :startdate, postcord = :postcord, address1 = :address1, address2 = :address2, address3 = :address3 WHERE ID = :id');
    
        // プレースホルダーに値をバインド
        $stmt->bindValue(':sei', $_POST['sei'], PDO::PARAM_STR);
        $stmt->bindValue(':mei', $_POST['mei'], PDO::PARAM_STR);
        $stmt->bindValue(':sex', $_POST['sex'], PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $_POST['birthday'], PDO::PARAM_STR);
        $stmt->bindValue(':startdate', $_POST['startdate'], PDO::PARAM_STR);
        $stmt->bindValue(':postcord', $_POST['postcord'], PDO::PARAM_STR);
        $stmt->bindValue(':address1', $_POST['address1'], PDO::PARAM_STR);
        $stmt->bindValue(':address2', $_POST['address2'], PDO::PARAM_STR);
        $stmt->bindValue(':address3', $_POST['address3'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    
        // クエリ実行
        if ($stmt->execute()) {
            // 更新成功時の処理
            header('Location: login.php');
            exit;
        } else {
            // 更新失敗時のエラーメッセージ
            echo 'データの更新に失敗しました。';
        }
    }

    //DB切断
    $pdo = null;
?>

<!DOCTYPE html>
<html lang= "ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="register.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>編集</title>
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
                <p class="contact-message">編集画面</p>

                <div class="contact-inner">
                    <form method="POST">
                        <table class="contact-table">
    
                            <tr class="table-list">
                                <th>
                                    <label for="name">お名前<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="sei" type="text" name="sei" placeholder="姓" class="input-area" maxlength="20" size="20" value="<?php echo htmlspecialchars($message_data['sei'], ENT_QUOTES ); ?>" required>
                                </td>
                                <td>
                                    <input id="mei" type="text" name="mei"  placeholder="名" class="input-area" maxlength="20" size="20" value="<?php echo htmlspecialchars($message_data['mei'], ENT_QUOTES ); ?>" required>
                                    </td>
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="sex">性別<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="men" type="radio" name="sex" value="男性" <?php if($message_data['sex'] == '男性'){ echo 'checked'; } ?> required>男性
                                    <input id="women" type="radio" name="sex" value="女性"  <?php if($message_data['sex'] == '女性'){ echo 'checked'; } ?> required>女性
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="birthday">生年月日<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="date" type="date" name="birthday" value="<?php echo htmlspecialchars($message_data['birthday'], ENT_QUOTES); ?>" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="startdate">入社日<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="date" type="date" name="startdate" value="<?php echo htmlspecialchars($message_data['startdate'], ENT_QUOTES); ?>" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="postcord">郵便番号<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="postcord" type="text" name="postcord" class="js-input-number input-area" inputmode="numeric" maxlength="7" size="7" value="<?php echo htmlspecialchars($message_data['postcord'], ENT_QUOTES); ?>" required>
                                    </td>
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="address1">都道府県<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="address1" type="text" name="address1" class="input-area" maxlength="10" size="10" value="<?php echo htmlspecialchars($message_data['address1'], ENT_QUOTES); ?>" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="address2">市区町村<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="address2" type="text" name="address2" class="input-area" maxlength="10" size="10" value="<?php echo htmlspecialchars($message_data['address2'], ENT_QUOTES); ?>" required>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="address3">ビル名</label>
                                </th>
                                <td>
                                    <textarea id="address3" name="address3" maxlength="255" size="255"><?php echo htmlspecialchars($message_data['address3'], ENT_QUOTES); ?></textarea>
                                </td>
                                <th>
                                    <input id="date" type="hidden" name="update" value="<?php date_default_timezone_set("Asia/Tokyo");
                                        echo date('Y-m-d'); ?>">
                                </th>
                            </tr>
                        </table>
                        <input type="submit" value="更新" class="button" name="submit-button">
                        <input type="button" value="戻る" class="cancel-button" name="cancel-button" onclick="location.href='./login.php'">
                        <input type="hidden" name="id" value="<?php echo $message_data['ID']; ?>">
    
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>