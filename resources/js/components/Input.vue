<script setup>
const props = defineProps(['class', 'lable', 'name', 'id','placeholder'])
</script>
<template>
  <input
    type="text"
    :id="id"
    :name="props.name"
    :class="[
      'block rounded-md  py-1.5 pl-7 pr-20 text-white  border border-gray-700 sm:text-sm sm:leading-6 bg-black ',
      $props.class,
      
    ]"
    :placeholder="placeholder"
  />
</template>
