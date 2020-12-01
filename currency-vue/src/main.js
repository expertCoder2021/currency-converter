import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import { routes } from './routes';
import Axios from 'axios';
import $ from "jquery";

window.$ = $;
Vue.prototype.$http = Axios;
Vue.prototype.$http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.baseUrl = 'http://127.0.0.1:8000/';
window.appUrl = 'http://localhost:8080/';
Vue.use(VueRouter);
const router = new VueRouter({
  routes,
  mode: 'history' // this will remove the # from url and default mode is hash
});
Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,
}).$mount('#app')
