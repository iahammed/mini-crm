<template>
    <div>
    <form class="login" @submit.prevent="login">
        <h1>Sign in</h1>
        <label>Email</label>
        <input required type="email" placeholder="Name"/>
        <label>Password</label>
        <input required type="password" placeholder="Password"/>
        <hr/>
        <button type="submit">Login</button>
    </form>
    </div>
</template>
