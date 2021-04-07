let $ = {
    // ajax()  get()+post()
    // 函数简写：": function"可以省略，写为 ajax(options = {}){}
    ajax: function (options = {}) {

        var { type = "get", url = "", data = "", async = true, dataType = "text", success } = options;

        var xhr = new XMLHttpRequest();

        if (typeof data == "object") {  //如果数据是对象类型 则拼接形成字符串
            var str = "";
            for (var key in data) {
                str += key + "=" + data[key] + "&";
            }

            data = str.substring(0, str.length - 1);
            // console.log(data);
        }

        if (type.toLowerCase() == "get") {

            if (data) {  //如果有data数据
                xhr.open("get", url + "?" + data, async);
            } else {  //如果 没有data数据
                xhr.open("get", url, async);
            }
            xhr.send();

        } else if (type.toLowerCase() == "post") {
            xhr.open("post", url, async);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(data);
        }

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var result = xhr.responseText; // 默认返回响应文本
                if (dataType == "json") {  //  如果dataType为json就转为json对象
                    result = JSON.parse(xhr.responseText);
                }

                if (success) {  // 请求成功之后,如果有回调函数success则执行该回调函数,并把请求的结果作为实际参数传入
                    success(result);
                }

            }
        }
    }
}