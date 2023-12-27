<script setup>
import Buttons from './Buttons.vue'
import SearchIcon from './icon/SearchIcon.vue'

const props = defineProps(['size', 'placeholder', 'color', 'class', 'name'])
</script>
<template>
  <div class="relative mt-2 flex">
    <input
      type="text"
      :name="props.name"
      :class="[
        'block w-full rounded-md  py-1.5 pl-2 pr-20 text-white  sm:text-sm sm:leading-6 bg-black',
        $props.class,
      ]"
      :placeholder="props.placeholder"
    />
    <Buttons class="rounded absolute right-0 h-full w-10 bg-none">
      <SearchIcon />
    </Buttons>
  </div>
</template>
