<?php

date_default_timezone_set("Asia/Tokyo");

//フォーム入力、登録を押下した時
if(!empty($_POST["submit-button"])) {

    //名前(姓)
    if(!empty($_POST["sei"])) {
        $sei = $_POST["sei"];
    }
    //名前(名)
    if(!empty($_POST["mei"])) {
        $mei = $_POST["mei"];
    }
    //性別
    if(!empty($_POST["sex"])) {
       $sex = $_POST["sex"];
    }
    //生年月日
    if(!empty($_POST["birthday"])) {
        $birthday = $_POST["birthday"];
    }
    //入社日
    if(!empty($_POST["startdate"])) {
        $startdate = $_POST["startdate"];
    }
    //都道府県
    if(!empty($_POST["address1"])) {
        $address1 = $_POST["address1"];
    }
    //市区町村
    if(!empty($_POST["address2"])) {
        $address2 = $_POST["address2"];
    }
    //登録日
    $regdate = date("Y-m-d");
}



