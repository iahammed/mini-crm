import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		status: '',
		token: null,
		isLogedin: false
	},
	mutations: {
	  	login(state, token) {
			state.status = 'success'
			state.token = token
			state.isLogedin = true
		},
		logout(state) {
			state.status = ''
			state.token = null
			state.isLogedin = false
		}
	},
	getters : {
		isLogedin: state => !!state.token,
		authStatus: state => state.status,
	}
})
