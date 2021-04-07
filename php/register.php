<?php
    @header("Content-Type: text/html;charset=utf-8");

    @include_once("conn.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if(!($username && $password && $phone && $email)) {
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "注册信息不完整";
        exit(json_encode($obj));
    }

    $insert = "insert into `userinfo` (username, password, phone, email, uptime) value ('$username', '$password', '$phone', '$email', now());";

    $result = mysqli_query($conn, $insert);

    $rows = mysqli_affected_rows($conn);

    $obj = array();
    if($rows > 0) {
        $obj["status"] = true;
        $obj["msg"] = "新增".$rows."条数据成功";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "新增失败，请检查SQL语句";
        $obj["sql"] = $insert;
    }
    echo json_encode($obj);
?>