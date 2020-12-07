import Vue from 'vue'
import Router from 'vue-router'

import store from './store.js'

import Login from './components/Login'
import Dashboard from './components/Dashboard'
import Client from './components/Client'
import Transaction from './components/Transaction'

Vue.use(Router)

let router = new Router({
	mode: 'history',
	routes : [
		{ path: '/login', component: Login},
		{ path: '/client', component: Client , meta: { requiresAuth: true } },
		{ path: '/transaction', component: Transaction, meta: { requiresAuth: true }  },
		{ path: '/dashboard', component: Dashboard, meta: { requiresAuth: true }  },
	]
})

router.beforeEach((to, from, next) => {
	if(to.matched.some(record => record.meta.requiresAuth)) {
		if (store.getters.isLogedin) {
			next()
			return
		}
		next('/login') 
	} else {
		next() 
	}
})

export default router
