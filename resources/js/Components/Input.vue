<script setup>

const props = defineProps(['class','lable','name','id']);
</script>
<template>
    <div>
      <label :for="id" class="block text-sm font-medium leading-6 text-white">{{ props.lable}}</label>
      <div class="relative mt-2 rounded-md shadow-sm">
        
        <input type="text" :id="id" :name="props.name" :class="[ 'block w-full rounded-md  py-1.5 pl-7 pr-20 text-white  sm:text-sm sm:leading-6 bg-black',$props.class ]" />
      </div>
    </div>
  </template>

