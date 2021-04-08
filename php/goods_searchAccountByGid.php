<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $gid = $_POST['gid'];
    $buyNum = $_POST['buyNum'];

    if(!($gid&&$buyNum)) {
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));
    }

    $search = "select id, goodsName, price, smallList, bigList, round($buyNum * price, 2) as subTotal from `goodslist` where productId = '$gid'";

    $result = mysqli_query($conn, $search);

    $arr = array();
    while($item = mysqli_fetch_assoc($result)){
        $item["smallList"] = explode(",", $item["smallList"]);
        $item["bigList"] = explode(",", $item["bigList"]);
        $item["img"] = $item["bigList"][0];
        // $item["subTotal"] = $item["subTotal"] * 1;
        array_push($arr, $item);
    }

    echo json_encode($arr);
?>