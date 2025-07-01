import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())


router.beforeEach((to, from, next) => {
    const defaultTitle = 'Cine Mágico'
    document.title = to.meta.title ? `${to.meta.title} - ${defaultTitle}` : defaultTitle
    next()
})

app.use(router)

app.mount('#app')
