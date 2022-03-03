/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// const files = require.context('./components/', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('list-users', require('./components/users/ListUsers.vue').default);
Vue.component('users-form', require('./components/users/UsersForm.vue').default);
Vue.component('header-tool-bar', require('./components/HeaderToolBar.vue').default);



import Vue from 'vue';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/es'
import 'element-ui/lib/theme-chalk/index.css';

window.Vue.use(ElementUI, { locale })

const app = new Vue({
    el: '#app',
});
