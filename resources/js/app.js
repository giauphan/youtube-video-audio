import { createApp } from 'vue'
import DropDown from './Components/DropDown.vue'
import Header from './Components/Header.vue'

const app = createApp({})

app.component('drop-down-component',DropDown)
app.component('header-component',Header)
app.mount('#app')