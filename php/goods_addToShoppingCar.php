<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $user = $_POST['user'];
    $gid = $_POST['gid'];
    $buyNum = $_POST['buyNum'];

    if(!($user&&$gid&&$buyNum)){
        $obj = array();
        $obj['status'] = false;
        $obj['msg'] = "请输入完整参数";
        exit(json_encode($obj));
    }

    $search = "select * from `shoppingcar` where user = '$user' and gid = '$gid'";
    $result = mysqli_query($conn, $search);
    $item = mysqli_fetch_assoc($result);
    // print_r($item);

    if($item){

        $sql = "update `shoppingcar` set buyNum = buyNum + $buyNum where user = '$user' and gid = '$gid'";
    }else{

        $sql = "insert into `shoppingcar` (user, gid, buyNum) values ('$user', '$gid', $buyNum)";
    
    }
    
    $result = mysqli_query($conn, $sql);

    $rows = mysqli_affected_rows($conn);

    $obj = array();
    if ($rows > 0){
        $obj['status'] = true;
        $obj['msg'] = '新增'.$rows.'条数据成功';
    }else{
        $obj['status'] = false;
        $obj['msg'] = '新增失败';
        $obj['sql'] = $insert;
    }

    echo json_encode($obj);
?>