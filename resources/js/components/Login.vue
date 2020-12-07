<template>
    <div>
    <form class="form-signin" @submit.prevent="handlelogin">
        <h1 class="h3 mb-3 font-weight-normal">Please Login</h1>
        
        <div class="form-row">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input class="form-control"
                type="email" 
                v-model = "formData.email"
                placeholder="Email" 
                required>
        </div>
        <div class="form-row">
            <label for="inputPassword" class="sr-only">Password</label>
            <input class="form-control"
                type="password"
                v-model = "formData.password"
                name="password" 
                placeholder="Password" 
                required>
        </div>
        <div class="form-row">
            <button type="submit"
                    class="btn btn-lg btn-primary btn-block"
                    >Login
            </button>	
        </div>
    </form>
    </div>
</template>

<script>

import axios from 'axios'

axios.defaults.withCredentials = true;

export default {
    data(){
        return{
            secret:[],
            formData: {
                email: 'admin@admin.com',
                password: 'password',
            }
        }
    },
    methods:{
        handlelogin(){
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', this.formData).then(response => { 
                    this.$store.commit('login', response.data)
                    this.$router.push('/dashboard')
                }).catch({

                })
            })
        }
    }
    
}
</script>
<style>
    .form-row{
        margin-bottom: 10px;   
    }
</style>