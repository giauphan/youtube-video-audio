import { createApp } from 'vue'
import DropDown from './Components/DropDown.vue'
import Header from './Components/Header.vue'
import Input from '@/Components/Input.vue'
import Buttons from '@/Components/Buttons.vue'
import InputGroup from '@/Components/InputGroup.vue'
import Alert from '@/Components/Alert.vue'
import Video from '@/Components/Video.vue'
import Paginate from '@/Components/Paginate.vue'


const app = createApp({})

app.component('drop-down-component',DropDown)
app.component('header-component',Header)
app.component('input-component',Input)
app.component('button-component',Buttons)
app.component('input-group-component',InputGroup)
app.component('alert-component', Alert)
app.component('video-component', Video)
app.component('paginate-component', Paginate)

app.mount('#app')