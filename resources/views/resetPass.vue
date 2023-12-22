<template>
    <form @submit.prevent="resetPass">
        <label for="password">Password:</label>
        <input type="password" v-model="form.password" required autocomplete="off">
        <label for="password">password_confirmation:</label>
        <input type="password" v-model="form.password_confirmation" required autocomplete="off">
        <button type="submit">リセットじゃよ</button>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router'
const router = useRouter()
const route = useRoute()
const form = ref({
    password: '',
    password_confirmation: '',
    email: route.query.email || "",
    token: route.query.token || "",
})
const resetPass = async () => {
    try {
        await axios.get('/sanctum/csrf-cookie')
        await axios.post('fortify/reset-password', form.value).then(() => {

            router.push('/loginTest/aaa/public/login')
        });
    } catch (error) {
        console.error(error.response.data);
    }
};


</script>
