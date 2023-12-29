
<script setup>
import { Menu, MenuButton, MenuItems } from '@headlessui/vue'


</script>

<template>
  <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton
        :class="['inline-flex w-full justify-center gap-x-1.5 rounded-md bg-balck px-3 py-2 text-sm font-semibold text-white shadow-sm  bg-gray-700',class_name]">
        {{ lable_name }}
      </MenuButton>
    </div>
    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems
        class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-black shadow-lg ring-1 ring-gray-800 ring-opacity-5 focus:outline-none w-full">
        <div class="py-1 flex flex-col justify-center items-center border border-gray-800 ">
          <slot></slot>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>
<script>
export default {

  props: ['lable_name','class_name']
}
</script>