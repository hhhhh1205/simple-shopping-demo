<?php
    // 配置PHP文件返回的文本类型(适配低版本浏览器) => PHP向前端返回的数据类型为utf-8
    @header("Content-Type: text/html; charset=UTF-8");

    const host = "localhost:3306";
    const user = "root";
    const pwd = "root";
    const dbName = "210322";

    $conn = mysqli_connect(host, user, pwd, dbName);

    if(!$conn) {
        exit("数据库链接失败");
    }

    mysqli_query($conn, "set names utf8");
    mysqli_query($conn, "set character set utf8");

?>