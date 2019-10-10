require('./bootstrap');
import axios from 'axios';

import Vue from 'vue';

import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';

import BootstrapVue from 'bootstrap-vue';
import CxltToastr from 'cxlt-vue2-toastr';

import Index from './Index';
import router from './router';

import VuePhoneNumberInput from 'vue-phone-number-input';
import 'vue-phone-number-input/dist/vue-phone-number-input.css';

window.Vue = Vue;

Vue.router = router;
Vue.use(VueRouter);

Vue.use(VueAxios, axios)
Vue.use(BootstrapVue);
Vue.use(CxltToastr, {
    position: 'top-right',
});

const app = new Vue(Vue.util.extend({router}, Index)).$mount('#app');