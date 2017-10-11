import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import querystring from 'querystring';
import moment from 'moment';
import pushjs from 'push.js'

window.Vue = Vue;
window.axios = axios;
window.querystring = querystring;
window.moment = moment;
window.pushjs = pushjs;

Vue.use(VueAxios, axios);
Vue.component('firebase-messages', require('./components/Message.vue'));

const app = new Vue({
    el: '#app'
});