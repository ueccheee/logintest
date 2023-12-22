<template>
    <div v-if="logincheck">
        <form @submit.prevent="login">
            <label for="email">Email:</label>
            <input type="email" v-model="form.email" required>
            <label for="password">Password:</label>
            <input type="password" v-model="form.password" required autocomplete="off">
            <button type="submit">Login</button>
        </form>
        <button @click="goToRegister">ユーザー登録</button>
        <button @click="passReset">パスワード忘れた場合</button>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'
import {useLoginState} from '../store/auth.js'
const router = useRouter()
const logincheck = ref(false)
const form = ref({
    email: '',
    password: '',
})

onMounted(async () => {
    try {
        await axios.get('/api/user');
        router.push('/loginTest/aaa/public/mypage')
    } catch (a) {
        logincheck.value = true
    }
});

const login = async () => {
    try {
        await axios.get('/sanctum/csrf-cookie')
        await axios.post('fortify/login', form.value).then((res) => {
            console.log(res);
            const loginres = res.data.id
            router.push('/loginTest/aaa/public/mypage')
        });
    } catch (error) {
        console.error(error.response.data);
    }
};

const goToRegister = () => {
    router.push('/loginTest/aaa/public/signup')
}

const passReset = () => {
    router.push('/loginTest/aaa/public/forgotPass')
}
</script>
