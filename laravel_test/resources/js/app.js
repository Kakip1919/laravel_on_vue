/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

Vue.component('config-component', require('./components/ExampleComponent.vue').default);
Vue.component('agora-rtc', require('./components/AgoraWebComponent.vue').default);
Vue.component('hash-key-component', require('./components/HashKeyComponent.vue').default);
const app = new Vue({
    el: '#app',
});
