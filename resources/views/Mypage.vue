<template>
    <div v-if="!isLoaded">
    </div>
    <div v-if="emailVerification">
        <h3>メール認証をしてください。</h3>
        <a @click="resendEmail">メールを再送する</a>
    </div>
    <div v-if="isLoaded">
        <h2>メモ共有してこ</h2>
        <p>Name: {{ user.name }}</p>
        <p>Email: {{ user.email }}</p>
        <button @click="logout">ログアウト</button>
        <button @click="newmemo">あたらしーメモをツクルヨ</button>
        <h3>自分が作ったメモ</h3>
        <div v-for="memo in memos">
            <router-link
                :to="{ path: '/loginTest/aaa/public/memo/', query: { id: memo.urlparam } }">{{ memo.memotitle }}</router-link>
        </div>
        <h3>参加したメモ</h3>
        <div v-for="memo in othersmemos">
            <router-link
                :to="{ path: '/loginTest/aaa/public/memo/', query: { id: memo.urlparam } }">{{ memo.memotitle }}</router-link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router'
import { useLoginState } from '../store/auth.js'
const router = useRouter()
const user = ref({});
const isLoaded = ref(false);
const emailVerification = ref(false)
const memos = ref([]);
const othersmemos = ref([]);


onMounted(async () => {
    try {
        const memores = await axios.get('/api/showmemotitles');
        memos.value = memores.data.mymemo
        othersmemos.value = memores.data.othersmemo
        console.log(othersmemos);
        const response = await axios.get('/api/user');
        if (!response.data.email_verified_at) {
            emailVerification.value = true
        }
        user.value = response.data;
        isLoaded.value = true;
    } catch (error) {
        console.error(error.response.data);
    }
});
const logout = async () => {
    await axios.post('/fortify/logout');
    router.push('/loginTest/aaa/public/login')
}
const resendEmail = async () => {
    await axios.post('fortify/email/verification-notification');
    router.push('/loginTest/aaa/public/login')
}

const newmemo = async () => {
    const randomString = Math.random().toString(36).substring(2);
    const creatememo = ref({
        memotitle: 'めもたいとる',
        param: randomString,
    });
    creatememo.value.memotitle = "あったらし～～！めも"
    await axios.post('api/creatememobutton', creatememo.value);
    router.push({ path: '/loginTest/aaa/public/memo/', query: { id: randomString } })
}

</script>
