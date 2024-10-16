<?php
if(!empty($_POST)){

    $sei = htmlspecialchars($_POST['sei'], ENT_QUOTES);
    $mei = htmlspecialchars($_POST['mei'], ENT_QUOTES);
    $sex = htmlspecialchars($_POST['sex'], ENT_QUOTES);
    $birthday = htmlspecialchars($_POST['birthday'], ENT_QUOTES);
    $startdate = htmlspecialchars($_POST['startdate'], ENT_QUOTES);
    $postcord = htmlspecialchars($_POST['postcord'], ENT_QUOTES);
    $address1 = htmlspecialchars($_POST['address1'], ENT_QUOTES);
    $address2 = htmlspecialchars($_POST['address2'], ENT_QUOTES);
    $address3 = htmlspecialchars($_POST['address3'], ENT_QUOTES);
    $regdate = htmlspecialchars($_POST['regdate'], ENT_QUOTES);
}

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

// PDOオブジェクト生成（DBへ接続）
$pdo = new PDO($pdo, $user, $password, $options);
    
//SQL文(クエリ作成)
$sql = 'INSERT INTO mst_employee (sei, mei, sex, birthday, startdate, postcord, address1, address2, address3, regdate) VALUES (:sei, :mei, :sex, :birthday, :startdate, :postcord, :address1, :address2, :address3, :regdate)';
    
$stmt = $pdo->prepare($sql);
    
//プレースホルダーに値をセットし、SQL文を作成
 if ($stmt->execute(array(':sei' => $sei, ':mei' => $mei, ':sex' => $sex, ':birthday' => $birthday, ':startdate' => $startdate, ':postcord' => $postcord, ':address1' => $address1, ':address2' => $address2, ':address3' => $address3, ':regdate' => $regdate))) {
    // 登録成功時、//DBに登録後はregister_complete.phpへ遷移 
    header("Location: register_complete.php");
    exit();
} else {
    // エラーが発生した場合
    echo "データベースへの登録に失敗しました。";
} 

?>