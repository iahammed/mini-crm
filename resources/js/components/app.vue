<template>
	<div id="app">
		<div id="nav">
			<nav class="navbar navbar-expand-sm bg-light navbar-light">
				<router-link class="navbar-brand" to="/dashboard">Mini CRM</router-link>
				<div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">    
        			<ul class="navbar-nav">
            			<li class="nav-item">
							<router-link class="nav-link" to="/client">Client</router-link>
            			</li>
            			<li class="nav-item">
							<router-link class="nav-link" to="/transaction">Transactions</router-link>
            			</li>
            			<li class="nav-item">
							<router-link class="nav-link" to="/login">Login</router-link>
            			</li>
        			</ul>
    			</div>
			</nav>
		</div>
		<router-view></router-view>
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
      		
    	},

	};
</script>