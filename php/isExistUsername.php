<?php
    @header("Content-Type: text/html;charset=utf-8");

    @include_once("conn.php");

    $username = $_POST['username'];
    // $phone = $_POST['phone'];
    // $email = $_POST['email'];

    if(!$username) {
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请输入完整信息";
        exit(json_encode($obj));
    }

    $search = "select * from `userinfo` where username = '$username'";

    $result = mysqli_query($conn, $search);

    $item = mysqli_fetch_assoc($result);

    $obj = array();
    if(!$item) {
        $obj["status"] = true;
        $obj["msg"] = "不存在，可以注册";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "该用户名已存在";
    }

    echo json_encode($obj);

?>