
/**
 * 后台JS
 */

require('./bootstrap');

window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');
// window.toastr = require('toastr');
// window.innerHeight = 800;
//
// window.toastr.options = {
//     positionClass: "toast-bottom-right",
//     showDuration: "300",
//     hideDuration: "1000",
//     timeOut: "5000",
//     extendedTimeOut: "1000",
//     showEasing: "swing",
//     hideEasing: "linear",
//     showMethod: "fadeIn",
//     hideMethod: "fadeOut"
// };

import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import axios from 'axios';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(VueRouter);

/**
 * Create Axios
 */
export const http = axios.create({
    baseURL: '/api',
})

http.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
if (window.localStorage.token_type && window.localStorage.access_token) {
	http.defaults.headers.common['Authorization'] = window.localStorage.token_type + ' ' + window.localStorage.access_token
}

// 响应时拦截
http.interceptors.response.use(function (response) {
    return response;
}, function (error) {
		const { response } = error;

		if ([401].indexOf(response.status) >= 0) {
				if (response.status == 401 && response.data.error.message != 'Unauthorized' ) {
						return Promise.reject(response);
				}

				console.log(response);
				window.location = '/login';
		} else if ([422].indexOf(response.status) >= 0) {
				return response;
		}

    // 当响应异常时做一些处理
    return Promise.reject(error);
});
Vue.prototype.$http = http;

import routes from './routes.js';
import App from './App.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// 初始化路由
const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: routes
});

const app = new Vue({
    router,
    render: (h) => h(App)
}).$mount('#app');
