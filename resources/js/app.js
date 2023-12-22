import "./bootstrap";
import "../css/app.css";
import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import { createPinia } from "pinia";
import { createPersistedState } from "pinia-plugin-persistedstate";
const app = createApp(App);
const pinia = createPinia();

app.use(router);
pinia.use(createPersistedState());
app.use(pinia)
app.mount("#app");
