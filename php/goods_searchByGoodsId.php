<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");


    $gid = $_GET["gid"];

    if(!$gid) {
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));
    }

    $search = "select * from `goodslist` where productId = '$gid'";

    $result = mysqli_query($conn, $search);

    $item = mysqli_fetch_assoc($result);

    $obj = array();
    if ($item){
        $item["smallList"] = explode(",", $item["smallList"]);
        $item["bigList"] = explode(",", $item["bigList"]);

        $obj["status"] = true;
        $obj["msg"] = "OK";
        $obj["data"] = $item;
    }else{
        $obj["status"] = false;
        $obj["msg"] = "该商品不存在";
    }

    echo json_encode($obj);

?>