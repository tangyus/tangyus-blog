
/**
 * 后台JS
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
Vue.use(VueRouter);

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

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    router,
    render: (h) => h(App)
    // render: h => {
    //     return h(App)
    // }
}).$mount('#app');
