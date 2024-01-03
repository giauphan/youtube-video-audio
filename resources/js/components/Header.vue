<script setup>
import { ListBulletIcon } from '@heroicons/vue/24/solid'
import DropDown from './DropDown.vue'
import InputGroup from './InputGroup.vue'
import route from 'ziggy-js'
import { ref } from 'vue'
import DrawerVue from './Drawer.vue'

const isShowModal = ref(false)

const handleOpen = () => {
  isShowModal.value = true
}

const onClose = () => {
  isShowModal.value = false
}
</script>
<template>
  <nav class="shadow-md border-b border-gray-700">
    <div class="container mx-auto w-5/6">
      <div class="flex items-center justify-between h-16">
        <button class="block md:hidden px-2 py-1 text-white" type="button" @click="handleOpen"
          aria-label="List Bullet Icon">
          <ListBulletIcon class="h-5 w-5" />
        </button>
        <a class="text-lg font-semibold text-white" href="/"> KINGKING </a>
        <DrawerVue :isShowModal="isShowModal" :onClose="onClose">
          <ul class="flex justify-center items-center flex-col gap-6">
            <slot></slot>
            <li class="text-white flex justify-center item">
              <DropDown :lable_name="lable">
                <a :href="route('lang', 'en')"
                  class="block py-2 text-sm text-white w-full border-b border-gray-700 text-center">
                  <MenuItem>English</MenuItem>
                </a>
                <a :href="route('lang', 'vi')" class="block py-2 text-sm text-white">
                  <MenuItem>Tiếng Việt</MenuItem>
                </a>
              </DropDown>
            </li>
          </ul>
        </DrawerVue>

        <div class="hidden md:flex items-center justify-center self-center py-3">
          <!-- Left Side Of Navbar -->
          <ul class="flex items-center gap-5">
            <slot></slot>
            <li class="text-white">
              <DropDown :lable_name="lable" class="">
                <a :href="route('lang', 'en')" class="block py-2 text-sm text-white">
                  <MenuItem>English</MenuItem>
                </a>
                <a :href="route('lang', 'vi')" class="block py-2 text-sm text-white">
                  <MenuItem>Tiếng Việt</MenuItem>
                </a>
              </DropDown>
            </li>
          </ul>
        </div>
        <!-- Right Side Of Navbar -->
        <ul class="flex items-center space-x-4">
          <DropDown v-if="user" :lable_name="user.name" class="w-40">
            <a class="block py-2 text-sm text-white" :href="route('user.video.index')">
              <MenuItem>Saved Video</MenuItem>
            </a>
            <p class="block py-2 text-sm text-white">
              <a :href="route('logout')" @click.prevent="logout">
                {{ lable_logout }}
              </a>
            <form ref="logoutForm" :action="route('logout')" method="POST" style="display: none;">
              <input type="hidden" name="_token" autocomplete="off" :value="csrf">
            </form>
            </p>
          </DropDown>
          <template v-else>
            <li>
              <a class="text-white whitespace-normal" :href="route('login')">{{
                lable_login
              }}</a>
            </li>
            <li>
              <a class="text-white whitespace-normal" :href="route('register')">{{ lable_sign }}</a>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  props: ['user', 'lable_login', 'lable_sign', 'lable', 'lable_logout', "csrf"],
  components: { InputGroup, DropDown },
  methods: {
    logout() {
      this.$refs.logoutForm.submit();
    },
  }
}
</script>
