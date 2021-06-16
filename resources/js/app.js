require('./bootstrap');


window.Vue = require('vue').default;
import router from './routes';
import App from './App.vue';
import vuetify  from './plugins/vuetify'
import store from './store'
import './plugins'
const app = new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
});