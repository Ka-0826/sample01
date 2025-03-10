<?php
ob_start(); // バッファリング開始

// 共通設定を読み込み
include 'common.php';

// 今日の日付を取得
$today = date('Y-m-d');

// データベース接続
$pdo = getDbConnection();

// POSTデータの取得
$sei = $_POST['sei'] ?? '';
$mei = $_POST['mei'] ?? '';
$sex = $_POST['sex'] ?? '';
$birthday = $_POST['birthday'] ?? '';
$startdate = $_POST['startdate'] ?? '';
$postcord = $_POST['postcord'] ?? '';
$address1 = $_POST['address1'] ?? '';
$address2 = $_POST['address2'] ?? '';
$address3 = $_POST['address3'] ?? '';
$regdate = date('Y-m-d'); // 登録日を現在の日付に設定

// 未来日付のチェック
if ($birthday > $today) {
    die("生年月日は過去の日付を指定してください。");
}
if ($startdate > $today) {
    die("入社日は今日以前の日付を指定してください。");
}

// SQL文作成（データ挿入）
$sql = 'INSERT INTO mst_employee (sei, mei, sex, birthday, startdate, postcord, address1, address2, address3, regdate)
    VALUES (:sei, :mei, :sex, :birthday, :startdate, :postcord, :address1, :address2, :address3, :regdate)';

$stmt = $pdo->prepare($sql);
    
// 登録するデータをセット
 if ($stmt->execute([
    ':sei' => $sei,
    ':mei' => $mei,
    ':sex' => $sex,
    ':birthday' => $birthday,
    ':startdate' => $startdate,
    ':postcord' => $postcord,
    ':address1' => $address1,
    ':address2' => $address2,
    ':address3' => $address3,
    ':regdate' => $regdate
 ])) {
    // 登録成功時の処理 
    header("Location: register_complete.php");
    exit;
} else {
    // エラーが発生した場合
    echo "データベースへの登録に失敗しました。";
} 
ob_end_flush(); // バッファリング終了
?>