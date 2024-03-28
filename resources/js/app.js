import './bootstrap';
import { createApp } from 'vue';
import store from './store';
import router from './router';
import vuetify from "./vuetify";

const app = createApp({});

app.use(store).use(router).use(vuetify).mount('#app');
