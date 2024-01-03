<template>
    <Tooltip trigger="click" placement="top"> 
        <template #trigger>
            <div class="text-white">
                Tooltip click
            </div>
        </template>
        <template v-slot:content>
            <div class="bg-white">
                Tooltip content
            </div>
        </template>
    </Tooltip>
</template>
  
<script>
import { Tooltip } from 'flowbite-vue';

export default {
    components: {
        Tooltip,
    },
    props: ['name'],
};
</script>
