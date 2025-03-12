<?php
ob_start(); // バッファリング開始

// 共通設定を読み込み
include 'common.php';

// 今日の日付を取得
$today = date('Y-m-d');

// データベース接続
$pdo = getDbConnection();
    
try{
    // SQL文作成（データ削除）
    $stmt = $pdo->prepare('DELETE FROM mst_employee WHERE id = :id');

    // 削除するデータのidをセット
    $stmt->bindValue(':id', $_POST['id'] ?? 0, PDO::PARAM_INT);

    // SQLの実行
    if ($stmt->execute()) {
        header("Location: delete_complete.php");
        exit();
    } else {
        echo "削除に失敗しました";
        exit();
    } 
} catch (PDOException $e) {
    // エラーが発生した場合
    echo "エラー: " . $e->getMessage();
    exit;
}
ob_end_flush(); // バッファリング終了
?>