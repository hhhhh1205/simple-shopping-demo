<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $user = $_POST['user'];

    if(!$user) {
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));
    }

    $search = "select s.id,s.user,s.gid,s.buyNum,g.goodsName,g.price,g.bigList,round(s.buyNum*g.price, 2) as subTotal from `shoppingcar` as s,`goodslist` as g where s.gid = g.productId and user = '$user'";

    $result = mysqli_query($conn, $search);

    $arr = array();
    while($item = mysqli_fetch_assoc($result)){
        $item["bigList"] = explode(",", $item["bigList"]);
        $item["img"] = $item["bigList"][0];
        $item["buyNum"] = $item["buyNum"] * 1;
        // $item["subTotal"] = $item["subTotal"] * 1;
        array_push($arr, $item);
    }

    echo json_encode($arr);
?>