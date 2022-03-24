require('./bootstrap');
window.Vue = require('vue').default;

Vue.component('config-component', require('./components/ExampleComponent.vue').default);
Vue.component('agora-rtc', require('./components/AgoraWebComponent.vue').default);
Vue.component('hash-key-component', require('./components/HashKeyComponent.vue').default);



Vue.component('index-component', require('./admin_components/IndexComponents.vue').default);
const app = new Vue({
    el: '#app',
});
