import 'flowbite';
import './bootstrap';
import '../css/app.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from './routes';
import { createPinia } from 'pinia'
import { setAxiosGlobally } from './general-lib/globalAxios';
import mitt from 'mitt'
const emitter = mitt()
setAxiosGlobally()

const pinia = createPinia()

createApp(App)
      .use(pinia)
      .use(router)
      .provide('emitter', emitter)
      .mount("#app")
