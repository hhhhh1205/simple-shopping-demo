<?php
    @header("Content-Type: text/html; charset=utf-8");

    @include_once("conn.php");

    $key = $_GET["key"];   // 搜索的关键词
    $orderCol = $_GET["orderCol"];   // 排序的列名 column(id,chinese math english total)
    $orderType = $_GET["orderType"];   //  排序的方式  asc desc
    $pageIndex = $_GET["pageIndex"];
    $showNum = $_GET["showNum"];
    $goodsType = $_GET["goodsType"];

    $obj = array();

    if(!($orderCol&&$orderType&&$pageIndex&&$showNum&&$goodsType)){
        $obj["status"] = false;
        $obj["msg"] = "请传入完整参数";
        exit(json_encode($obj));  
    }

    // 后端分页    => 借助sql语法  limit  m,n  跳过m条,显示n跳
    // 第1页   limit 0,5
    // 第2页   limit 5,5
    // 第3页   limit 10,5
    // ...    
    // $pageIndex   =>  limit  ($pageIndex-1)*$showNum

    // $pageIndex => 可能超出最大值,也有可能小于1   =>限制范围

    //页码的最大值 pageMax = count / showNum => 向上取整

    // 查询数据的总数量 (按照搜索的关键词查询)
    getNum();

    function getNum(){
        global $goodsType,$key,$conn,$item,$count,$maxPage,$pageIndex,$skipNum,$showNum;
        $searchAll = "select count(*) as count from `goodslist` where cat = '$goodsType' and goodsName like '%$key%'";
        $resultAll = mysqli_query($conn,$searchAll);
        $item = mysqli_fetch_assoc($resultAll);
        // print_r($item);
        $count = $item["count"];  // 满足条件的数据的总数量
        $maxPage = ceil($count/$showNum);  // 向上取整
    
        if($pageIndex >= $maxPage){
            $pageIndex = $maxPage;
        }
    
        if($pageIndex <= 1){
            $pageIndex = 1;
        }
    
        // 计算的式子不能直接往SQL语句中放，会拼接不会计算，得先赋值再放
        $skipNum = ($pageIndex - 1) * $showNum;
    }


    if($key){

        if($goodsType == "手机"){
            $goodsType = "手机";
            getNum();
        }else if($goodsType == "耳机"){
            $goodsType = "耳机";
            getNum();
        }else if($goodsType == "音箱"){
            $goodsType = "音箱";
            getNum();
        }else if($goodsType == "笔记本电脑"){
            $goodsType = "笔记本电脑";
            getNum();
        }else if($goodsType == "转接线"){
            $goodsType = "转接线";
            getNum();
        }else if($goodsType == "平板"){
            $goodsType = "平板";
            getNum();
        }else if($goodsType == "手表"){
            $goodsType = "手表";
            getNum();
        }else if($goodsType == "护眼仪"){
            $goodsType = "护眼仪";
            getNum();
        }else if($goodsType == "枕头"){
            $goodsType = "枕头";
            getNum();
        }

        $search = "select id,productId,goodsName,slogan,price,bigList,cat from `goodslist` where goodsName like '%$key%'  order by $orderCol $orderType limit $skipNum,$showNum";

        $result = mysqli_query($conn, $search);
    }else{
        
        $search = "select id,productId,goodsName,slogan,price,bigList,cat from `goodslist` where cat = '$goodsType' order by $orderCol $orderType limit $skipNum,$showNum";
        $result = mysqli_query($conn, $search);
        
    }
    
    $arr = array();
    while($item = mysqli_fetch_assoc($result)){
        $item["bigList"] = explode(",", $item["bigList"]);
        $item["img"] = $item["bigList"][0];
        array_push($arr,$item);
    }

    
    
    
    
    $obj["status"] = true;
    if($count == 0){
        $obj["status"] = false;
    }
    $obj["count"] = $count * 1;  // 数据的总数量
    $obj["pageIndex"] = $pageIndex * 1;  // 当前页是第几页
    $obj["maxPage"] = $maxPage * 1;  // 最大页码
    $obj["data"] = $arr;

    echo json_encode($obj);

?>