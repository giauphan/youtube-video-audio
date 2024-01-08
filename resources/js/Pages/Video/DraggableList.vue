<template>
  <div @drop="onDrop($event, 1)" @dragenter.prevent @dragover.prevent>
    <div v-for="(list, key) in videodrag" :key="key" @dragstart="startDrag($event, key)">
      <a :href="route('video.index', ['video', list.id])" class="flex flex-col">

        <img :src="list.thumbnail || null" class="aspect-video w-full h-auto rounded-lg"
          :alt="truncateTitle(list.title)" />
        <div class="flex justify-between gap-4">
          <h1 class="text-lg text-white font-bold bg-black" id="title_list">{{ list.title }}</h1>
          <form :action="route('videoList.delete')" method="post">
            <input type="hidden" name="_token" :value="csrf" />
            <input type="hidden" name="video_id" :value="list.id" />
            <Buttons class="text-white">Delete</Buttons>
          </form>
        </div>
      </a>
    </div>
  </div>
</template>

<script setup>
import route from 'ziggy-js';
import { ref, onMounted, defineProps, onUnmounted, getCurrentInstance } from 'vue';
import Buttons from '../../components/Buttons.vue';

const props = defineProps(['videodrag', 'csrf']);

const startDrag = (event, index) => {
  event.dataTransfer.dropEffect = 'move';
  event.dataTransfer.effectAllowed = 'move';
  event.dataTransfer.setData('itemIndex', index);
};

const onDrop = (event, newIndex) => {
  try {
    console.log(event, newIndex);
    const draggedIndex = event.dataTransfer.getData('itemIndex');

    // Create a copy of the array to modify
    const updatedList = [...props.videodrag.value];

    // Remove the dragged item from its original position
    const [draggedItem] = updatedList.splice(draggedIndex, 1);

    // Insert the dragged item into the new position
    updatedList.splice(newIndex, 0, draggedItem);

    // Update the local state
    props.videodrag.value = updatedList;

    // Emit an event to update the prop in the parent component
    const instance = getCurrentInstance();
    instance?.emit('updateVideosDrag', updatedList);
  } catch (error) {
    console.error('Error in onDrop:', error);
  }
};

const truncateTitle = (title) => {
  return title.length > 40 ? `${title.substring(0, 40)}...` : title;
};

onMounted(() => {
  // Any initialization logic you want to perform on component mount

  // Cleanup on component unmount
  onUnmounted(() => {
    // Cleanup logic
  });
});
</script>

