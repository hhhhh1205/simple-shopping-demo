
// 将所有的ajax请求，用Promise封装  =》 返回一个Promise实例
// 相当于对ajax进行二次封装，要先引入ajax.js再引入此文件


// 在“request_第一版.js”中不难发现，封装的函数中有大量重复的代码
// 可以在第一版的基础上将那些重复的代码再次封装


// 在“request_第二版.js”中不难发现，除了request()函数之外，其他的函数都很简洁，只有一个return语句，完全可以改为箭头函数，让代码更简洁


function request(url, params, type = "get") {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: type,
            url,
            data: {
                ...params
            },
            dataType: "json",
            success: res => resolve(res)
        });
    })
}


// 箭头函数：先将普通函数改为匿名函数
// 然后给每个匿名函数命名一遍调用
// 用const声明一个变量接收匿名函数，防止被修改


// 注册页面
// 将注册信息存入数据库
const register = params => request("../php/register.php", params, "post");

// 判断用户名是否存在
const isExistUsername = params => request("../php/isExistUsername.php", params, "post");

// 判断电话是否存在
const isExistPhone = params => request("../php/isExistPhone.php", params, "post");

// 判断邮箱是否存在
const isExistEmail = params => request("../php/isExistEmail.php", params, "post");
// --------------------------------------------------------------


// 登录页面
const login = params => request("../php/login.php", params, "post");
// -------------------------------------------------------------- 


// 商品列表
const goodsSearchAllLimit = params => request("../php/goods_searchAllLimit.php", params, "get");

// 商品详情
const goodsSearchByGoodsId = params => request("../php/goods_searchByGoodsId.php", params, "get");

// 加入购物车
const goodsAddToShoppingCar = params => request("../php/goods_addToShoppingCar.php", params, "post");

// 根据登录用户查新该用户的购物车
const goodsSearchShoppingCarByUser = params => request("../php/goods_searchShoppingCarByUser.php", params, "post");

// 修改购物车中商品数量
const goodsUpdateShoppingCarById = params => request("../php/goods_updateShoppingCarById.php", params, "post");

// 删除购物车中商品
const goodsDeleteShoppingCarById = params => request("../php/goods_deleteShoppingCarById.php", params, "get");

