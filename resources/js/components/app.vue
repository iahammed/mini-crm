<template>
	<div>
		<div id="nav">
			<nav class="navbar navbar-expand-sm bg-light navbar-light">
				<router-link class="navbar-brand" to="/dashboard">Mini CRM</router-link>
				
				<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">    
        			<ul class="navbar-nav">
            			<li class="nav-item" v-if="$store.state.isLogedin">
							<router-link class="nav-link" to="/client">Client</router-link>
            			</li>
            			<li class="nav-item" v-if="$store.state.isLogedin">
							<router-link class="nav-link" to="/transaction">Transactions</router-link>
            			</li>
            			<li class="nav-item" v-if="!$store.state.isLogedin">
							<router-link class="nav-link" to="/login">Login</router-link>
            			</li>
						<li v-if="$store.state.isLogedin">
							<p class="nav-link"  @click="logput">logout</p>
						</li>
        			</ul>
    			</div>
			</nav>
		</div>
		<div class="container">
			<router-view></router-view>
		</div>
	</div>
</template>
<script>
	const default_layout = "default";

	export default {
		data() {
			return {
				message:'Hello World'
			}
		},
		computed : {
			
		},

		methods: {
			logput() {
				axios.get('/api/logout', {
            		headers: {
                		'Authorization': `Bearer ${this.$store.state.token}`
            		}
        		}).then(response => {
					this.$store.commit('logout')
					this.$router.push('login')
				})
			}
    	},

	};
</script>