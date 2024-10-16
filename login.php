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

        $stmt = $pdo->prepare('SELECT * FROM mst_employee');
        $stmt->execute();
        // SQL文の実行結果を配列で取得する
        $mst_employee = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $error_message[] = $e->getMessage();
        exit;
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

        <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>

        <title>メイン画面</title>
    </head>
    <body>
        <div class="contact-bg">
            <div class="contact-area inner">
                <p class="contact-message">メイン画面</p>

                <div class="table-inner" id="js-search-list">
                        <input type="search" class="search" placeholder="検索　（姓名/性別/郵便番号/住所）">
                        <table class="table-bordered">
                                <thead>
                                    <tr class="tr-bordered">
                                        <th scope="col" class="col">ID</th>
                                        <th scope="col" class="sort col" data-sort="name">姓名</th>
                                        <th scope="col" class="col">性別</th>
                                        <th scope="col" class="col">誕生日</th>
                                        <th scope="col" class="sort col" data-sort="startdate">入社日</th>
                                        <th scope="col" class="sort col" data-sort="postcord">郵便番号</th>
                                        <th scope="col" class="col">住所</th>
                                        <th scope="col" class="col">登録日</th>
                                        <th scope="col" class="col"></th>

                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php foreach ($mst_employee as $employee): ?>
                                    <tr class="tr-bordered">
                                        <td scope="row" class="id row"><?php print $employee["ID"] ?></td>
                                        <td scope="row" class="name row"><?php echo $employee["sei"]. $employee["mei"] ?></td>
                                        <td scope="row" class="sex row"><?php echo $employee["sex"] ?></td>
                                        <td scope="row" class="birthday row"><?php echo $employee["birthday"] ?><tdh>
                                        <td scope="row" class="startdate row"><?php echo $employee["startdate"] ?></td>
                                        <td scope="row" class="postcord row"><?php echo $employee["postcord"] ?></td>
                                        <td scope="row" class="address row"><?php echo $employee["address1"]. $employee["address2"]. $employee["address3"] ?></td>
                                        <td scope="row" class="regdate row"><?php echo $employee["regdate"] ?></td>
                                        <td scope="row" class="row"><a href="edit.php?id=<?php echo $employee['ID']; ?>">編集</a></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>

                        </table>
                        <input type="submit" value="登録" class="button" name="button" onclick="location.href='./register_form.php'">
                </div>
            </div>
        </div>

        <script>
            // DOMが読み込まれたらリストを初期化
            document.addEventListener('DOMContentLoaded', function () {
                const options = {
                    valueNames: [ 'name', 'sex', 'startdate', 'postcord', 'address' ]
                };
                const tableInner = new List('js-search-list', options);
            });
        </script>
       
    </body>
</html>   