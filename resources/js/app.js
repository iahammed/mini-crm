require('./bootstrap');
import Vue from 'vue'
import store from './store'
import router from './routes'

//Main pages
import App from './components/app.vue'

const app = new Vue({
	el: '#app',
	router,
	store,
	components: { App }
});
