// 使用async关键字来定义函数
// 把Promise改为async

async function judgeUser(user) {
    var reg = /^[a-zA-Z_$][\w$]{5,11}$/;
    if (user) {
        if (reg.test(user)) {

            var res = await isExistUsername({ username: user });
            if (res.status) {
                return ({
                    status: true,
                    msg: ""
                });
            } else {
                throw {
                    status: false,
                    msg: "用户名已存在"
                };
            }

        } else {
            return Promise.reject({
                status: false,
                msg: "用户名由数字,大小写字母,_,$组成 6-12位,不能以数字开头"
            });
        }
    } else {
        throw {
            status: false,
            msg: "用户名不能为空"
        };
    }
}

// function judgeUser(user) {
//     var reg = /^[a-zA-Z_$][\w$]{5,11}$/;
//     return new Promise((resolve, reject) => {
//         if (user) {
//             if (reg.test(user)) {

//                 isExistUsername({ username: user }).then(
//                     res => {
//                         if (res.status) {
//                             resolve({
//                                 status: true,
//                                 msg: ""
//                             });
//                         } else {
//                             reject({
//                                 status: false,
//                                 msg: "用户名已存在"
//                             });
//                         }
//                     }
//                 );

//             } else {
//                 reject({
//                     status: false,
//                     msg: "用户名由数字,大小写字母,_,$组成 6-12位,不能以数字开头"
//                 });
//             }
//         } else {
//             reject({
//                 status: false,
//                 msg: "用户名不能为空"
//             });
//         }
//     });
// }


async function judgePwd(pwd) {
    var reg = /^[\w$]{6,12}$/;
    if (pwd) {
        if (reg.test(pwd)) {

            pwdInp.style.borderColor = "#E5E5E5";
            pwdFlag = true;

            var numFlag = false;
            var smallFlag = false;
            var bigFlag = false;
            var speFlag = false;

            var numReg = /\d/;
            var smallReg = /[a-z]/;
            var bigReg = /[A-Z]/;
            var speReg = /[_$]/;

            if (numReg.test(pwd)) {
                numFlag = true;
            }
            if (smallReg.test(pwd)) {
                smallFlag = true;
            }
            if (bigReg.test(pwd)) {
                bigFlag = true;
            }
            if (speReg.test(pwd)) {
                speFlag = true;
            }

            var sum = numFlag + smallFlag + bigFlag + speFlag;

            if (sum == 4) {
                return {
                    status: true,
                    msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:120px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:180px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:240px;"></span>'
                };
            }
            if (sum == 3) {
                return Promise.resolve({
                    status: true,
                    msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:120px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:180px;"></span>'
                });
            }
            if (sum == 2) {
                return Promise.resolve({
                    status: true,
                    msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:120px;"></span>'
                });
            }
            if (sum == 1) {
                return {
                    status: true,
                    msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span>'
                };
            }
        } else {
            return Promise.reject({
                status: false,
                msg: "密码由数字,字母,下划线,$组成 ,6-12位"
            });
        }
    } else {
        throw {
            status: false,
            msg: "密码不能为空"
        };
    }
}


// function judgePwd(pwd) {
//     var reg = /^[\w$]{6,12}$/;
//     if (pwd) {
//         if (reg.test(pwd)) {

//             pwdInp.style.borderColor = "#E5E5E5";
//             pwdFlag = true;

//             var numFlag = false;
//             var smallFlag = false;
//             var bigFlag = false;
//             var speFlag = false;

//             var numReg = /\d/;
//             var smallReg = /[a-z]/;
//             var bigReg = /[A-Z]/;
//             var speReg = /[_$]/;

//             if (numReg.test(pwd)) {
//                 numFlag = true;
//             }
//             if (smallReg.test(pwd)) {
//                 smallFlag = true;
//             }
//             if (bigReg.test(pwd)) {
//                 bigFlag = true;
//             }
//             if (speReg.test(pwd)) {
//                 speFlag = true;
//             }

//             var sum = numFlag + smallFlag + bigFlag + speFlag;

//             if (sum == 4) {
//                 return Promise.resolve({
//                     status: true,
//                     msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:120px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:180px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:240px;"></span>'
//                 });
//             }
//             if (sum == 3) {
//                 return Promise.resolve({
//                     status: true,
//                     msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:120px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:180px;"></span>'
//                 });
//             }
//             if (sum == 2) {
//                 return Promise.resolve({
//                     status: true,
//                     msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span><span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:120px;"></span>'
//                 });
//             }
//             if (sum == 1) {
//                 return Promise.resolve({
//                     status: true,
//                     msg: '密码强度:<span style="background:#7C91D7;width:50px;height:10px;display:inline-block;position:absolute;top:3px;left:60px;"></span>'
//                 });
//             }
//         } else {
//             return Promise.reject({
//                 status: false,
//                 msg: "密码由数字,字母,下划线,$组成 ,6-12位"
//             });
//         }
//     } else {
//         return Promise.reject({
//             status: false,
//             msg: "密码不能为空"
//         });
//     }
// }


async function judgeRepwd(repwd) {
    var reg = /^[\w$]{6,12}$/;
    if (repwd) {
        if (reg.test(repwd)) {
            if (repwd == pwdInp.value) {
                return {
                    status: true,
                    msg: ""
                };
            } else {
                return Promise.reject({
                    status: false,
                    msg: "确认密码与密码不一致"
                });
            }
        } else {
            return Promise.reject({
                status: false,
                msg: "确认密码由数字,字母,下划线,$组成 ,6-12位"
            });
        }
    } else {
        throw {
            status: false,
            msg: "确认密码不能为空"
        };
    }
}


// function judgeRepwd(repwd) {
//     var reg = /^[\w$]{6,12}$/;
//     if (repwd) {
//         if (reg.test(repwd)) {
//             if (repwd == pwdInp.value) {
//                 return Promise.resolve({
//                     status: true,
//                     msg: ""
//                 });
//             } else {
//                 return Promise.reject({
//                     status: false,
//                     msg: "确认密码与密码不一致"
//                 });
//             }
//         } else {
//             return Promise.reject({
//                 status: false,
//                 msg: "确认密码由数字,字母,下划线,$组成 ,6-12位"
//             });
//         }
//     } else {
//         return Promise.reject({
//             status: false,
//             msg: "确认密码不能为空"
//         });
//     }
// }


async function judgePhone(phone) {
    var reg = /^1[3-9]\d{9}$/;
    if (phone) {
        if (reg.test(phone)) {

            var res = await isExistPhone({ phone });
            if (res.status) {
                return {
                    status: true,
                    msg: ""
                };
            } else {
                throw {
                    status: false,
                    msg: "手机号已注册"
                };
            }

        } else {
            throw {
                status: false,
                msg: "请输入正确的手机号"
            };
        }
    } else {
        throw {
            status: false,
            msg: "手机号不能为空"
        };
    }
}


// function judgePhone(phone) {
//     var reg = /^1[3-9]\d{9}$/;
//     return new Promise((resolve, reject) => {
//         if (phone) {
//             if (reg.test(phone)) {

//                 isExistPhone({ phone }).then(
//                     res => {
//                         if (res.status) {
//                             resolve({
//                                 status: true,
//                                 msg: ""
//                             });
//                         } else {
//                             reject({
//                                 status: false,
//                                 msg: "手机号已注册"
//                             });
//                         }
//                     }
//                 );

//             } else {
//                 reject({
//                     status: false,
//                     msg: "请输入正确的手机号"
//                 });
//             }
//         } else {
//             reject({
//                 status: false,
//                 msg: "手机号不能为空"
//             });
//         }
//     })
// }


async function judgeEmail(email) {
    var reg = /^\S{6,12}@(qq|163|126|139|sohu|gmail|hotmail)\.com$/;
    if (email) {
        if (reg.test(email)) {

            var res = await isExistEmail({ email });
            if (res.status) {
                return {
                    status: true,
                    msg: ""
                };
            } else {
                throw {
                    status: false,
                    msg: "邮箱已注册"
                };
            }

        } else {
            throw {
                status: false,
                msg: "请输入正确的邮箱"
            }
        }
    } else {
        throw {
            status: false,
            msg: "邮箱不能为空"
        }
    }
}


// function judgeEmail(email) {
//     var reg = /^\S{6,12}@(qq|163|126|139|sohu|gmail|hotmail)\.com$/;
//     return new Promise((resolve, reject) => {
//         if (email) {
//             if (reg.test(email)) {

//                 isExistEmail({ email }).then(
//                     res => {
//                         if (res.status) {
//                             resolve({
//                                 status: true,
//                                 msg: ""
//                             });
//                         } else {
//                             reject({
//                                 status: false,
//                                 msg: "邮箱已注册"
//                             });
//                         }
//                     }
//                 );

//             } else {
//                 reject({
//                     status: false,
//                     msg: "请输入正确的邮箱"
//                 })
//             }
//         } else {
//             reject({
//                 status: false,
//                 msg: "邮箱不能为空"
//             })
//         }
//     })
// }


async function judgeCode(code) {
    var reg = new RegExp(code, "i");
    if (code) {
        if (reg.test(createCode.textContent)) {
            return {
                status: true,
                msg: ""
            };
        } else {
            throw {
                status: false,
                msg: "验证码输入有误,请重新输入"
            }
        }
    } else {
        throw {
            status: false,
            msg: "验证码不能为空"
        }
    }
}


// function judgeCode(code) {
//     var reg = new RegExp(code, "i");
//     if (code) {
//         if (reg.test(createCode.textContent)) {
//             return Promise.resolve({
//                 status: true,
//                 msg: ""
//             });
//         } else {
//             return Promise.reject({
//                 status: false,
//                 msg: "验证码输入有误,请重新输入"
//             })
//         }
//     } else {
//         return Promise.reject({
//             status: false,
//             msg: "验证码不能为空"
//         })
//     }
// }
