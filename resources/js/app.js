import { createApp } from 'vue'
import DropDown from '@/components/DropDown.vue'
import Header from '@/components/Header.vue'
import Input from '@/components/Input.vue'
import Buttons from '@/components/Buttons.vue'
import InputGroup from '@/components/InputGroup.vue'
import Alert from '@/components/Alert.vue'
import Video from '@/components/Video.vue'
import Paginate from '@/components/Paginate.vue'
import Footer from '@/components/Footer.vue'
import PageHome from '@/Pages/Home/Index.vue'
import { FwbFooterLink, FwbFooterLinkGroup } from 'flowbite-vue'

const app = createApp({})

app.component('drop-down-component', DropDown)
app.component('header-component', Header)
app.component('input-component', Input)
app.component('button-component', Buttons)
app.component('input-group-component', InputGroup)
app.component('alert-component', Alert)
app.component('video-component', Video)
app.component('paginate-component', Paginate)
app.component('footer-component', Footer)
app.component('footer-link-component', FwbFooterLink)
app.component('footer-linkgroup-component', FwbFooterLinkGroup)
app.component('page-home', PageHome)

app.mount('#app')