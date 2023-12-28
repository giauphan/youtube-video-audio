<script setup>
import DropDown from './DropDown.vue'
import InputGroup from './InputGroup.vue'
import route from 'ziggy-js'
</script>
<template>
  <nav class="shadow-md border-b border-gray-700">
    <div class="container mx-auto w-5/6">
      <div class="flex items-center justify-between h-16">
        <a class="text-lg font-semibold text-white" href="/"> KINGKING </a>
        <button class="block md:hidden px-2 py-1 text-gray-600 hover:text-gray-900 focus:outline-none" type="button"
          data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
          aria-expanded="false" aria-label="Toggle navigation">
          <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
              d="M3.293 4.293a1 1 0 011.414 0L12 12.586l7.293-7.293a1 1 0 111.414 1.414l-8 8a1 1 0 01-1.414 0l-8-8a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
        </button>

        <div class="flex items-center justify-center self-center py-3">
          <!-- Left Side Of Navbar -->
          <ul class="flex items-center gap-5">
            <slot></slot>
            <li class="text-white">
              <DropDown :lable_name="lable" class="bg-none text-white">
               <a :href="route('lang','en')" class="block py-2 text-sm text-black"><MenuItem >English</MenuItem></a> 
               <a :href="route('lang','vi')" class="block py-2 text-sm text-black"> <MenuItem >Tiếng Việt</MenuItem></a>
              </DropDown>
            </li>
          </ul>
        </div>
        <!-- Right Side Of Navbar -->
        <ul class="flex items-center space-x-4">
          <li>
            <a class="text-gray-600 hover:text-gray-900" href="">{{
              lableLogin
            }}</a>
          </li>

          <li>
            <a class="text-gray-600 hover:text-gray-900" href="">{{
              lableSign
            }}</a>
          </li>
          <DropDown v-if="user" :name="user.name"> </DropDown>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script >

export default {
  props: ['user', 'lableLogin', 'lableSign', 'lable'],
  components: { InputGroup, DropDown },
}
</script>
