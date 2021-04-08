<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $user = $_POST['user'];
    $all = $_POST['all'];

    if(!$user) {
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));
    }

    if($all){
        $search = "select name, phone, prov, urban, district, detailaddr from `shopaddress` where user = '$user'";
    }else{
        $search = "select name, phone, prov, urban, district, detailaddr from `shopaddress` where user = '$user' limit 0,4";
    }

    $result = mysqli_query($conn, $search);

    $arr = array();
    while($item = mysqli_fetch_assoc($result)){
        
        array_push($arr, $item);
    }

    echo json_encode($arr);
?>