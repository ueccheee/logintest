<template>
    <form @submit.prevent="forgotPass">
        <label for="email">Email:</label>
        <input type="email" v-model="form.email" required>
        <button type="submit">そーしん</button>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'
const router = useRouter()
const form = ref({
    email: ''
})
const forgotPass = async () => {
    try {
        await axios.get('/sanctum/csrf-cookie')
        await axios.post('fortify/forgot-password', form.value).then(() => {

            router.push('/loginTest/aaa/public/login')
        });
    } catch (error) {
        console.error(error.response.data);
    }
};


</script>
