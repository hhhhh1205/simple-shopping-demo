<?php   
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $id = $_POST["id"];
    $buyNum = $_POST["buyNum"];
    $type = $_POST["type"];

    if(!($id&&$buyNum)){
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    if($type == 1) {  // 增加
        $sql = "update `shoppingcar` set buyNum = buyNum + $buyNum where id = $id";
    }else if($type == 2) {  // 直接在input框中手动修改
        $sql = "update `shoppingcar` set buyNum = $buyNum where id = $id";
    }else {  // 减少
        $sql = "update `shoppingcar` set buyNum = buyNum - $buyNum where id = $id";
    }

    $result = mysqli_query($conn, $sql);

    $rows = mysqli_affected_rows($conn);

    $obj = array();
    if($rows>0){
        $obj["status"] = true;
        $obj["msg"] = "修改数据成功";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "修改数据失败,请检查sql语句";
        $obj["sql"] = $sql;
    }

    echo json_encode($obj);

?>