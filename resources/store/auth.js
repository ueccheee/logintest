import { defineStore } from "pinia";
export const useLoginState = defineStore("loginstate", {
    state: () => ({
        login: false,
    }),
    actions: {
        setLogin(e) {
            this.login = e;
        },
        setLogout() {
            this.login = false;
        },
    },
    persist: true,
});
