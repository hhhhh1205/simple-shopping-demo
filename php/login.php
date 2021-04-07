<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $name = $_POST['name'];
    $password = $_POST['password'];

    if(!($name && $password)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "登录信息不完整";
        exit(json_encode($obj));  
    }

    $search = "select id,username,password,phone,email from `userinfo` where username = '$name' or phone = '$name' or email = '$name'";

    $result = mysqli_query($conn, $search);

    // 查找的数据需要解析
    $item = mysqli_fetch_assoc($result);

    $obj = array();
    if($item){
        $obj["status"] = true;
        $obj["msg"] = "OK";
        $obj["data"] = $item;
        echo json_encode($obj);
    }else{
        $obj["status"] = false;
        $obj["msg"] = "该用户不存在";
        $obj["data"] = array("username"=>"", "password"=>"", "phone"=>"", "email"=>"");
        echo json_encode($obj);
    }

?>