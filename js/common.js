// 通过编码范围生成对应的字符  =>放到数组中
var numList = [];
for (var i = 48; i <= 57; i++) {
    var char = String.fromCharCode(i);
    // console.log(char);
    numList.push(char);
}
// console.log(numList);

var bigList = [];
for (var i = 65; i <= 90; i++) {
    var char = String.fromCharCode(i);
    // console.log(char);
    bigList.push(char);
}
// console.log(bigList);

var smallList = [];
for (var i = 97; i <= 122; i++) {
    var char = String.fromCharCode(i);
    // console.log(char);
    smallList.push(char);
}
// console.log(smallList);

var speList = ["_", "$"]; //允许使用的特殊字符

var normalList = numList.concat(smallList, bigList, speList);
// console.log(normalList);

// normalList 存在 => 合法的
// normalList 不存在 => 非法的


function randCode() {
    var list = numList.concat(smallList, bigList);

    var str = "";
    for (var i = 0; i < 4; i++) {
        var index = Math.floor(Math.random() * list.length);
        var char = list[index];

        if (str.indexOf(char) == -1) { // 判断字符串中是否存在该字符
            str += char;
        } else {
            i--;
        }

    }

    return str;

}