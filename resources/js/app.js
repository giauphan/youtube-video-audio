import { createApp } from 'vue'
import DropDown from './Components/DropDown.vue'
import Header from './Components/Header.vue'
import Input from '@/Components/Input.vue'
import Buttons from '@/Components/Buttons.vue'

const app = createApp({})

app.component('drop-down-component',DropDown)
app.component('header-component',Header)
app.component('input-component',Input)
app.component('button-component',Buttons)

app.mount('#app')