<?php
ob_start(); // バッファリング開始

// 共通設定を読み込み
include 'common.php';

// 今日の日付を取得
$today = date('Y-m-d');

// データベース接続
$pdo = getDbConnection();
 
// POSTでフォームが送信された場合の処理
if (!empty($_POST) && isset($_POST['update-complete-button'])) {
    $birthday = $_POST['birthday'];
    $startdate = $_POST['startdate'];

    // 未来日付のチェック
    if ($birthday > $today) {
        die("生年月日は過去の日付を指定してください。");
    }
    if ($startdate > $today) {
        die("入社日は今日以前の日付を指定してください。");
    }

    // SQL文作成（データ更新）
    $stmt = $pdo->prepare('UPDATE mst_employee SET
        sei = :sei, mei = :mei, sex = :sex, birthday = :birthday, startdate = :startdate, postcord = :postcord, address1 = :address1,
        address2 = :address2, address3 = :address3 WHERE id = :id');

    // 編集するデータをセット
    $stmt->bindValue(':sei', $_POST['sei'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':mei', $_POST['mei'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':sex', $_POST['sex'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':birthday', $_POST['birthday'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':startdate', $_POST['startdate'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':postcord', $_POST['postcord'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':address1', $_POST['address1'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':address2', $_POST['address2'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':address3', $_POST['address3'] ?? '', PDO::PARAM_STR);
    $stmt->bindValue(':id', $_POST['id'] ?? 0, PDO::PARAM_INT);

    // SQLの実行
    $stmt->execute();

    // 更新成功時の処理
    header('Location: edit_complete.php');
    exit;
} else {
    // エラーが発生した場合
    echo "データベースへの登録に失敗しました。";
}
ob_end_flush(); // バッファリング終了
?>