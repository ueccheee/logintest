import { createRouter, createWebHistory } from "vue-router";
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/loginTest/aaa/public/login",
            name: "login",
            component: () => import("../../views/Login.vue"),
        },
        {
            path: "/loginTest/aaa/public/mypage",
            name: "mypage",
            component: () => import("../../views/Mypage.vue"),
        },
        {
            path: "/loginTest/aaa/public/signup",
            name: "signup",
            component: () => import("../../views/Signup.vue"),
        },
        {
            path: "/loginTest/aaa/public/lookatemail",
            name: "lookatemail",
            component: () => import("../../views/lookatemail.vue"),
        },
        {
            path: "/loginTest/aaa/public/forgotPass",
            name: "forgotPass",
            component: () => import("../../views/forgotPass.vue"),
        },
        {
            path: "/loginTest/aaa/public/reset-password",
            name: "resetPass",
            component: () => import("../../views/resetPass.vue"),
        },
        {
            path: "/loginTest/aaa/public/memo",
            name: "memo",
            component: () => import("../../views/memo.vue"),
        },
    ],
});
export default router;
