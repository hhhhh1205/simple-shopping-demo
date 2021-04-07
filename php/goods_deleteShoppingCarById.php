<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $ids = $_GET['ids'];

    if(!($ids)){   // 如果参数不完整  =>  请传入完整参数 
        $obj = array();
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    $del = "delete from `shoppingcar` where id in ($ids)";

    $result = mysqli_query($conn, $del);

    //  删除
    //  $rows =mysqli_affected_rows($conn);   接收一个链接的对象返回受影响的函数
    //  $row > 0     删除成功  
    //  $row = 0     语句执行成功,表格数据未改变 (数据不存在 数据已经被删除了)
    //  $row = -1    语法有误,导致语句执行失败   ( 删除  1.语法问题  2.唯一值重复 )

    $rows = mysqli_affected_rows($conn);

    $obj = array();
    if($rows>0){
        $obj["status"] = true;
        $obj["msg"] = "删除成功";
    }else if($rows==0){
        $obj["status"] = true;
        $obj["msg"] = "该数据已被删除";
    }else{
        $obj["status"] = false;
        $obj["msg"] = "删除失败,请检查sql语句";
        $obj["sql"] = $del;
    }

    echo json_encode($obj);

?>