<template>
  <FwbFooter
    footer-type="logo"
    class="mt-10 rounded-none border-t dark:border-gray-700"
    style="background-color: #000 !important"
  >
    <div class="w-full max-w-screen-xl mx-auto px-4 bg-black">
      <slot></slot>
    </div>
  </FwbFooter>
</template>

<script setup>
import { FwbFooter } from 'flowbite-vue'
</script>
