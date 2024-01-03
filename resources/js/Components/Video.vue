<template>
    <div class="flex flex-col gap-6 aspect-video">
        <iframe :src="video.url_video" allowfullscreen width="100%" height="360px"
            :class="['aspect-video h-auto sm:h-[360px] rounded-lg', (video.type == 'short') && 'h-[500px] w-300px']"></iframe>
        <!-- Add settings button -->
        <button @click="showQualitySettings" class="bg-blue-500 text-white px-4 py-2 rounded-md">
            Quality Settings
        </button>
        <h1 class="text-xl text-white font-bold bg-black text-center" id="title">{{ video.title }}</h1>

        <RadioGroup />
<Tooltip />
        <!-- Add quality settings dropdown -->
        <div v-if="showSettings" class="absolute right-0 mt-2 bg-white border rounded-md p-2">
            <label>
                Quality:
                <select v-model="selectedQuality" @change="changeQuality">

                    <option value="360" id="360p">360p</option>
                </select>
            </label>
        </div>

        <slot></slot>
    </div>
</template>

<script>
import RadioGroup from './RadioGroup.vue';
import Tooltip from './Tooltip.vue';

export default {
    props: ['video'],
    data() {
        return {
            showSettings: false,
            selectedQuality: null
        };
    },
    methods: {
        showQualitySettings() {
            this.showSettings = !this.showSettings;
        },
        changeQuality() {
            // Implement logic to change video quality based on selectedQuality
            console.log('Selected quality:', this.selectedQuality);
        }
    },
    components: { RadioGroup, Tooltip }
}
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
