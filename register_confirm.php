<?php
    $sei = $_POST['sei'];
    $mei = $_POST['mei'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $startdate = $_POST['startdate'];
    $postcord = $_POST['postcord'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $address3 = $_POST['address3'];
    $regdate = $_POST['regdate'];
?>

<!DOCTYPE html>
<html lang= "ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="register.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>登録確認</title>
    </head>
    <body>
        <div class="contact-bg">
            <div class="contact-area inner">
                <p class="contact-message">登録確認画面</p>
                <p class="message-notice">下記スタッフを追加しますか？</p>
    
                <div class="contact-inner">
                    <form action="dbconnect.php" method="POST">
                        <table class="contact-table">
    
                            <tr class="table-list">
                                <th>
                                    <label for="name">お名前<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="sei" type="hidden" name="sei" value="<?php echo htmlspecialchars($sei, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($sei, ENT_QUOTES); ?></p>
                                </td>
                                <td>
                                    <input id="mei" type="hidden" name="mei" value="<?php echo htmlspecialchars($mei, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($mei, ENT_QUOTES); ?></p>
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="sex">性別<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="sex" type="hidden" name="sex" value="<?php echo htmlspecialchars($sex, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($sex, ENT_QUOTES); ?></p>
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="birthday">生年月日<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="birthday" type="hidden" name="birthday" value="<?php echo htmlspecialchars($birthday, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($birthday, ENT_QUOTES); ?></p>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="startdate">入社日<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="startdate" type="hidden" name="startdate" value="<?php echo htmlspecialchars($startdate, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($startdate, ENT_QUOTES); ?></p>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="postcord">郵便番号<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="postcord" type="hidden" name="postcord" value="<?php echo htmlspecialchars($postcord, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($postcord, ENT_QUOTES); ?></p>
                                </td>
                            </tr>
    
                            <tr class="table-list">
                                <th>
                                    <label for="address1">都道府県<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="address1" type="hidden" name="address1" value="<?php echo htmlspecialchars($address1, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($address1, ENT_QUOTES); ?></p>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="address2">市区町村<span class="essential">必須</span></label>
                                </th>
                                <td>
                                    <input id="address2" type="hidden" name="address2" value="<?php echo htmlspecialchars($address2, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($address2, ENT_QUOTES); ?></p>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="address3">ビル名</label>
                                </th>
                                <td>
                                    <input id="address3" type="hidden" name="address3" value="<?php echo htmlspecialchars($address3, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($address3, ENT_QUOTES); ?></p>
                                </td>
                            </tr>

                            <tr class="table-list">
                                <th>
                                    <label for="regdate">登録日</label>
                                </th>
                                <td>
                                    <input id="regdate" type="hidden" name="regdate" value="<?php echo htmlspecialchars($regdate, ENT_QUOTES); ?>">
                                    <p class="td-list"><?php echo htmlspecialchars($regdate, ENT_QUOTES); ?></p>
                                </td>
                            </tr>
    
                        </table>
                    
                        <input type="submit" value="登録" class="button" name="submit-button">
                        <input type="button" value="修正" class="cancel-button" name="cancel-button" onclick="history.back()">
    
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>