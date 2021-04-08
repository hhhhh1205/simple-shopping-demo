<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $user = $_POST['user'];
    $prov = $_POST['prov'];
    $urban = $_POST['urban'];
    $district = $_POST['district'];
    $detailaddr = $_POST['detailaddr'];

    if(!($name&&$phone&&$user&&$prov&&$district&&$detailaddr)){
        $obj = array();
        $obj['status'] = false;
        $obj['msg'] = "请输入完整参数";
        exit(json_encode($obj));
    }


    $insert = "insert into `shopaddress` (name, phone, user, prov, urban, district, detailaddr) values ('$name', '$phone', '$user', '$prov', '$urban', '$district', '$detailaddr')";
    
    $result = mysqli_query($conn, $insert);

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