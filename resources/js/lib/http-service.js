
axios = require('axios');

QS = require('qs');

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//自动切换环境
axios.defaults.baseURL = process.env._BASEURL
//设置超时时间
axios.defaults.timeout = 10000;
// post请求头
axios.defaults.headers.post['Content-Type'] = 'application/json;charset=UTF-8'
axios.defaults.withcredentials = true

//请求拦截(请求发出前处理请求)
// axios.interceptors.request.use((config) => {
//     //在发送请求之前如果为post序列化请求参数
//     if (config.method === 'post') {
//         config.data = config.data;
//     }
//     return config;
// }, (error) => {
//     return Promise.reject(error);
// });

// // 响应拦截器（处理响应数据）
// axios.interceptors.response.use((res) => {
//     //对响应数据做判断，与后台协议统一接口返回格式
//     console.log('>>>>>>>response: ', res);
//     if (res.data.state) { //这个判断可根据实际情况修改
//         return res;
//     }
//     return res;
// }, (error) => {
//     return error;
// });
//

axios.interceptors.response.use(
    response => {
        // 如果返回的状态码为200，说明接口请求成功，可以正常拿到数据
        // 否则的话抛出错误
        if (response.status === 200) {
            return Promise.resolve(response);
        } else {
            return Promise.reject(response);
        }
    },
    // 服务器状态码不是2开头的的情况
    // 这里可以跟你们的后台开发人员协商好统一的错误状态码
    // 然后根据返回的状态码进行一些操作，例如登录过期提示，错误提示等等
    // 下面列举几个常见的操作，其他需求可自行扩展
    error => {
        console.log(error.response.data)
        if (error.response.status) {
            switch (error.response.status) {
                // 401: 未登录
                // 未登录则跳转登录页面，并携带当前页面的路径
                // 在登录成功后返回当前页面，这一步需要在登录页操作。
                case 401:
                    toastr.warning('身份验证失败，请关闭重新进入。')
                    break;

                // 403 token过期
                // 登录过期对用户进行提示
                // 清除本地token和清空vuex中token对象
                // 跳转登录页面
                case 403:
                    toastr.warning('登录过期，请关闭重新进入。')
                    // 清除token
                    break;

                // 404请求不存在
                case 404:
                    $("body").find(".modal").modal('hide')
                    toastr.warning('您访问的网页不存在。')
                    break;
                // 其他错误，直接抛出错误提示
                default:
                    console.log(error.response.data.message);
            }
            return Promise.reject(error.response);
        }
    }
);


class Axios {
    get(url, params) {
        return new Promise((resolve, reject) => {
            axios.get(url, params).then(res => {
                resolve(res.data);
            }).catch(err => {
                // reject(err.data);
            })
        });
    }
    post(url, params) {
        return new Promise((resolve, reject) => {
            axios.post(url, params).then(res => {
                resolve(res.data);
            }).catch(err => {
                // reject(err.data);
            })
        });
    }

    request({method, url, data}){
        if(method === 'get'){
            return this.get(url, data);
        }else if(method === 'post'){
            return this.post(url, data);
        }
    }
}

window.Axios  = Axios;