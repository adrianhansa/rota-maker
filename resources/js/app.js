require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'


Vue.use(Vuetify)

import {store} from './store/index'
import {routes} from './routes'


import VCalendar from 'v-calendar';
import 'v-calendar/lib/v-calendar.min.css';

Vue.use(VCalendar, {
  firstDayOfWeek: 2,  // Monday

});

Vue.use(VueRouter)

const router = new VueRouter({
	routes,
	mode:'history'
})

Vue.component('welcome', require('./components/Welcome.vue'));
Vue.component('home', require('./components/Home.vue'));
Vue.component('login', require('./components/auth/Login.vue'));
Vue.component('register', require('./components/auth/Register.vue'));
Vue.component('app-header', require('./components/Header.vue'));

const app = new Vue({
    el: '#app',
    store,
    router
});
