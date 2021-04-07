<?php

    @include_once("conn.php");

    // $user = $_POST["user"]; 
    // echo isExist("user","a123123");
    // echo isExist("phone","13312332111");
    // echo isExist("email","123@qq.com");

    
    // 低版本不传参会报错，所以要判断是否存在字段名
    // $user = $_POST["user"]; 
    // $phone = $_POST["phone"]; 
    // $email = $_POST["email"]; 

    $obj = array();
    if(isset($_POST["user"])){  // isset()  是否存在字段 user  (适配低版本)
        $user = $_POST["user"];
        $flag = isExist("user",$user);
        if(!$flag){ // 不存在该用户 
            $obj["status"] = true;
            $obj["msg"] = "可以注册的用户名";
        }else{ // 存在该用户
            // 存在  => 该用户已注册
            $obj["status"] = false;
            $obj["msg"] = "该用户名已注册";
        }
    }else if(isset($_POST["phone"])){  // isset()  是否存在字段 phone  (适配低版本)
        $phone = $_POST["phone"];
        $flag = isExist("phone",$phone);
        if(!$flag){ // 不存在该用户 
            $obj["status"] = true;
            $obj["msg"] = "可以注册的手机号";
        }else{ // 存在该用户
            // 存在  => 该用户已注册
            $obj["status"] = false;
            $obj["msg"] = "该手机号已注册";
        }
    }else if(isset($_POST["email"])){  // isset()  是否存在字段 email  (适配低版本)
        $email = $_POST["email"];
        $flag = isExist("email",$email);
        if(!$flag){ // 不存在该用户 
            $obj["status"] = true;
            $obj["msg"] = "可以注册的邮箱";
        }else{ // 存在该用户
            // 存在  => 该用户已注册
            $obj["status"] = false;
            $obj["msg"] = "该邮箱已注册";
        }
    }else{
        $obj["status"] = false;
        $obj["msg"] = "请传入正确的参数";
    }

    echo json_encode($obj);
    
    function isExist($key,$val){

        global $conn;  // 允许局部变量使用全局变量
        
        $search = "select * from `userinfo` where $key = '$val'";
    
        $result = mysqli_query($conn,$search);
    
        $item = mysqli_fetch_assoc($result);
    
        // print_r($item);
        if($item){
            return true;
        }else{
            return false;
        }
    }




?>