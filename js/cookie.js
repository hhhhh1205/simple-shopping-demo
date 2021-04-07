function setCookie(key, val, day = 0, path = "/") {

    if (day) {  // 如果有day  设置过期时间
        var date = new Date();
        date.setDate(date.getDate() + day);
        document.cookie = key + "=" + encodeURIComponent(val) + ";expires=" + date.toUTCString() + ";path=" + path;
    } else {  //没有  就默认浏览器关闭过期
        document.cookie = key + "=" + encodeURIComponent(val) + ";path=" + path;
    }
}


function getCookie(key) {
    var cookie = document.cookie;
    if (cookie) {
        var dataList = cookie.split("; ");
        console.log(dataList);
        for (var i = 0; i < dataList.length; i++) {
            var item = dataList[i];// "user=a123123", "pwd=123123", 
            var attr = item.split("=")[0]; // "user" 
            var val = item.split("=")[1]; //"a123123"
            if (key == attr) {
                return decodeURIComponent(val);
                // return val;
            }
        }
    }
    return "";
}


function delCookie(key) {
    setCookie(key, "", -1);
}

function judgeCookies() {

    var arr = document.cookie.split("; ");
    console.log(arr);

    var obj = {};
    arr.forEach(function (item) {
        var list = item.split("=");
        console.log(list[0], list[1]);
        obj[list[0]] = list[1];
    })
    console.log(obj);
    return obj;
}