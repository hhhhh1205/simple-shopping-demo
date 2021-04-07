<?php
    @header('Content-Type: text/html;charset=utf-8');

    @include_once("conn.php");

    $phone = $_POST['phone'];

    if(!$phone) {
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请输入完整信息";
        exit(json_encode($obj));
    }

    $search = "select * from `userinfo` where phone = '$phone'";

    $result = mysqli_query($conn, $search);

    $item = mysqli_fetch_assoc($result);

    $obj = array();
    if(!$item) {
        $obj["status"] = true;
        $obj["msg"] = "不存在，可以注册";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "该手机号已存在";
    }

    echo json_encode($obj);

?>