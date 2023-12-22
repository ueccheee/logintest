<template>
    <form @submit.prevent="register">
        <label for="name">Name:</label>
        <input type="text" v-model="form.name" required>
        <label for="email">Email:</label>
        <input type="email" v-model="form.email" required>
        <label for="password">Password:</label>
        <input type="password" v-model="form.password" required autocomplete="off">
        <label for="password">password_confirmation:</label>
        <input type="password" v-model="form.password_confirmation" required autocomplete="off">
        <button type="submit">Register</button>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'
const router = useRouter()
const form = ref({
    email: '',
    name: '',
    password: '',
    password_confirmation: ''
})
const register = async () => {
    try {
        await axios.get('/sanctum/csrf-cookie')
        await axios.post('fortify/register', form.value).then(() => {
            router.push('/loginTest/aaa/public/login')
        })
    } catch (error) {
        console.error(error.response.data.errors); // Handle error
    }
};
</script>
