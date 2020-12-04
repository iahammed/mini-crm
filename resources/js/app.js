// require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store/store'
import Axios from 'axios'
//Main pages
import App from './components/app.vue'

import Login from './components/Login'
import Dashboard from './components/Dashboard'
import Client from './components/Client'
import Transaction from './components/Transaction'

Vue.use(VueRouter)

const routes = [
	{ path: '/login', component: Login },
	{ path: '/client', component: Client },
	{ path: '/transaction', component: Transaction },
	{ path: '/dashboard', component: Dashboard },
]

const router = new VueRouter({
	routes,
	mode: 'history'
})

// Vue.prototype.$http = Axios;
// const token = localStorage.getItem('token')
// if (token) {
//   Vue.prototype.$http.defaults.headers.common['Authorization'] = token
// }

const app = new Vue({
	el: '#app',
	router,
	components: { App }
});

// http://mini-crm.test/spa