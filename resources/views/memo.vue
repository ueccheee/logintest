<template>
    <div>
        メモダヨ
    </div>
    <div>
        <form @submit.prevent="addmemo">
            <input v-model="form.title">
            <textarea v-model="form.body" rows="5"></textarea>
            <button type="submit">投稿</button>
        </form>
    </div>
    <div v-for="memo in memos" :key="memo.id">
        <h2>{{ memo.title }}</h2>
        <p>{{ memo.body }}</p>

    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import { useRouter, useRoute } from 'vue-router'
const router = useRouter()
const route = useRoute()
const param = route.query.id
const tokendata = {
    token: param
}
const form = ref({
    title: '',
    body: '',
    memotoken: param,
})
const memos = ref({})

window.Echo.channel('message')
    .listen('MessageCreated', (e) => {
        memos.value.push(e.memo);
        console.log(e.memo);
    })

onMounted(async () => {
    try {
        await axios.post('/api/addmemouser', tokendata);
        const res = await axios.post('/api/getmemo', tokendata);
        memos.value = res.data
        console.log(res.data);
    } catch {
        router.push('/loginTest/aaa/public/login')
    }
})
const addmemo = async () => {
    console.log(form.value);
    await axios.post('/api/addmemo', form.value);

    form.value = '';

}
</script>
