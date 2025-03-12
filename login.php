<?php
// 共通設定を読み込み
include 'common.php';

// データベース接続
$pdo = getDbConnection();

try {
    // PDOオブジェクト生成（DBへ接続）
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
        <!-- 共通CSS -->
        <link rel="stylesheet" href="common.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

        <title>メイン画面</title>
    </head>

    <body>
        <div class="contact-bg">
            <div class="contact-area inner">
                <p class="contact-message">メイン画面</p>

                <!-- 検索フォームと登録ボタン -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-end mb-3">
                    <div class="search-forms d-flex flex-column flex-md-row">
                        <div class="me-3">
                            <p>姓名</p>
                            <input type="search" class="search name-search form-control" placeholder="検索（姓名）">
                        </div>
                        <div class="me-3">
                            <p>性別</p>
                            <input type="search" class="search sex-search form-control" placeholder="検索（性別）">
                        </div>
                        <div class="me-3">
                            <p>住所</p>
                            <input type="search" class="search address-search form-control" placeholder="検索（住所）">
                        </div>
                    </div>
                    <input type="submit" value="登録" class="btn btn-primary" name="button" onclick="location.href='./register_form.php'">
                </div>

                <!-- 登録一覧テーブル -->
                <div class=" table-inner" id="js-search-list">
                    <table class="table table-striped table-hover table-bordered">
                        <div class="d-flex flex-column flex-md-row">
                            <thead>
                                <tr class="tr-bordered">
                                    <th scope="col" class="col blank-col"></th>
                                    <th scope="col" class="sort col id-col" data-sort="id">ID</th>
                                    <th scope="col" class="sort col" data-sort="name">姓名</th>
                                    <th scope="col" class="sort col" data-sort="sex">性別</th>
                                    <th scope="col" class="sort col" data-sort="birthday">誕生日</th>
                                    <th scope="col" class="sort col" data-sort="startdate">入社日</th>
                                    <th scope="col" class="sort col" data-sort="postcord">郵便番号</th>
                                    <th scope="col" class="col address-col">住所</th>
                                    <th scope="col" class="sort col" data-sort="regdate">登録日</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach ($mst_employee as $employee): ?>
                                <tr class="tr-bordered">
                                    <td class="edit-delete">
                                        <div class="edit-container">
                                        <a href="edit_form.php?id=<?php echo $employee['ID']; ?>">編集</a>
                                            </div>
                                        <div class="delete-container">
                                            <a href="delete_confirm.php?id=<?php echo $employee['ID']; ?>">削除</a>
                                        </div>
                                    </td>
                                    <td class="id"><?php echo $employee["ID"]; ?></td>
                                    <td class="name"><?php echo $employee["sei"] . " " . $employee["mei"]; ?></td>
                                    <td class="sex"><?php echo $employee["sex"]; ?></td>
                                    <td class="birthday"><?php echo $employee["birthday"]; ?></td>
                                    <td class="startdate"><?php echo $employee["startdate"]; ?></td>
                                    <td class="postcord"><?php echo $employee["postcord"]; ?></td>
                                    <td class="address"><?php echo $employee["address1"] . " " . $employee["address2"] . " " . $employee["address3"]; ?></td>
                                    <td class="regdate"><?php echo $employee["regdate"]; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </div>
                    </table>
                </div>
            </div>
        </div>

        <!-- <list.js ライブラリを読み込み -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
        <script>
            // ソート機能
            const options = {
                valueNames: [ 'id', 'name', 'sex', 'birthday', 'startdate', 'postcord', 'address', 'regdate' ]
            };

            // 氏名・性別・住所の検索機能
            const jsSearchList = new List('js-search-list', options);

            document.querySelector('.name-search').addEventListener('input', function() {
                jsSearchList.search(this.value, ['name']);
            });

            document.querySelector('.sex-search').addEventListener('input', function() {
                jsSearchList.search(this.value, ['sex']);
            });

            document.querySelector('.address-search').addEventListener('input', function() {
                jsSearchList.search(this.value, ['address']);
            });
        </script>
    </body>
</html>   