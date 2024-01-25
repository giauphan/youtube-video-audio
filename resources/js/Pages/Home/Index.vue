<template>
    <section class="my-10 ">
        <TabGroup>
            <TabList class="my-10 flex gap-3">
                <Tab as="template" class="focus-visible::border-none" v-slot="{ selected }">
                    <Buttons
                        :class="['focus-visible::border-0 p-1 rounded', selected ? 'bg-white text-black' : 'bg-gray-500 text-white']">
                        Video
                    </Buttons>
                </Tab>
                <Tab v-slot="{ selected }">
                    <Buttons
                        :class="['focus-visible::border-0 p-1 rounded', selected ? 'bg-white text-black' : 'bg-gray-500 text-white']">
                        Short Video
                    </Buttons>
                </Tab>
                <Tab v-slot="{ selected }">
                    <Buttons
                        :class="['focus-visible::border-0 p-1 rounded', selected ? 'bg-white text-black' : 'bg-gray-500 text-white']">
                        History video
                    </Buttons>
                </Tab>
            </TabList>
            <TabPanels>
                <TabPanel>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 min-h-[300px]">
                        <a :href="route('video.index', { 'type_video': video.type == 'video' ? 'web-video' : video.type, 'video': video.video_id })"
                            v-if="videos" v-for="video in videos.data">
                            <img :src="video.thumbnail ?? null" class="mb-5 aspect-video w-full h-56 rounded-lg"
                                :alt="truncateTitle(video.title)" />
                            <h1 class="text-xl text-white font-bold bg-black overflow-hidden" style="display: -webkit-box;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 2;">{{ video.title }}</h1>
                        </a>
                    </div>
                    <Paginate :pagination="videos" v-if="videos" />
                </TabPanel>
                <TabPanel>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 min-h-[300px]">
                        <a :href="route('video.index', { 'type_video': video.type == 'video' ? 'web-video' : video.type, 'video': video.video_id })"
                            v-if="video_short" v-for="video in video_short.data">

                            <img :src="video.thumbnail ?? null" class="mb-5 aspect-video w-full h-56 rounded-lg"
                                :alt="truncateTitle(video.title)" />
                            <h1 class="text-xl text-white font-bold bg-black overflow-hidden" style="display: -webkit-box;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 2;">{{ video.title }}</h1>
                        </a>
                    </div>
                    <Paginate :pagination="video_short" v-if="video_short" />
                </TabPanel>

                <TabPanel>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 min-h-[300px]">
                        <template v-if="videos" v-for="video in videos.data">
                            <a :href="route('video.index', { 'type_video': video.type == 'video' ? 'web-video' : video.type, 'video': video.video_id })"
                                v-if="video.history_video">
                                {{ console.log(video.history_video) }}
                                <img :src="video.thumbnail ?? null" class="mb-5 aspect-video w-full h-56 rounded-lg"
                                    :alt="truncateTitle(video.title)" />
                                <h1 class="text-xl text-white font-bold bg-black overflow-hidden" style="display: -webkit-box;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 2;">{{ video.title }}</h1>
                            </a>
                        </template>
                    </div>
                    <Paginate :pagination="videos" v-if="videos" />
                </TabPanel>
            </TabPanels>

        </TabGroup>

    </section>
</template>


<script setup>
import route from 'ziggy-js'
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
import Paginate from '../../components/Paginate.vue';
import Buttons from '../../components/Buttons.vue';

const props = defineProps(['videos', 'video_short'])

const truncateTitle = (title) => {
    return title.length > 40 ? `${title.substring(0, 40)}...` : title;
};
</script>