<template>
  <div class="grid grid-cols-1 sm:grid-cols-4 my-10 gap-5">
    <section class="col-span-3 rounded">
      <div class="flex flex-col gap-6 aspect-video">
        <video ref="videoPlayer" width="100%" height="360" :class="[
          'aspect-video h-auto sm:h-[360px] rounded-lg',
          video.type === 'short' && 'h-[500px] w-300px',
        ]" controls autoplay @ended="playNextVideo()">
          <source :src="linkVideo" type="video/mp4" />
        </video>
        <h1 class="text-xl text-white font-bold bg-black text-center" id="title">
          {{ title_video }}
        </h1>
        <slot></slot>
      </div>
    </section>
    <section>
      <h1 class="text-xl text-white font-bold bg-black ">
        Danh sách phát tiếp theo
      </h1>
      <a :href="route('video.index', ('video', list.id))" :key="list.id" class="flex flex-col"
        v-for=" (list, key) in videolist ">
        <img :src="list.thumbnail ?? null" class="aspect-video w-full h-auto rounded-lg"
          :alt="truncateTitle(list.title)" />
        <div class="flex justify-between gap-4">
          <h1 class="text-lg text-white font-bold bg-black" id="title_list">{{ list.title }}</h1>
          <form :action="route('videoList.delete')" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="video_id" :value="list.id">
            <Buttons class="text-white">Delete</Buttons>
          </form>
        </div>
      </a>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import route from 'ziggy-js';
import Buttons from './Buttons.vue';

const props = defineProps(['video', 'videolist', 'csrf'])

const linkVideo = ref(props.video.url_video)
const title_video = ref(props.video.title)
const videoPlayer = ref(null);

const playNextVideo = () => {
  const videolist = props.videolist
  const video = props.video
  let currentVideoId = video.id;
  const videoIds = Object.keys(videolist);
  const currentVideoIndex = videoIds.findIndex((id) => id === currentVideoId);
  if (
    currentVideoIndex !== -1 &&
    currentVideoIndex + 1 < videoIds.length
  ) {
    const nextVideoId = videoIds[currentVideoIndex + 1];
    linkVideo.value = videolist[nextVideoId].url_video;
    title_video.value = videolist[nextVideoId].title;
    video.id = videolist[nextVideoId].id;
  } else {
    const nextVideoId = videoIds[0];
    linkVideo.value = videolist[nextVideoId].url_video;
    title_video.value = videolist[nextVideoId].title;
    video.id = videolist[nextVideoId].id;
  }
  videoPlayer.value.load();
  videoPlayer.value.play();

}
const truncateTitle = (title) => {
  return title.length > 40 ? `${title.substring(0, 40)}...` : title;
}


</script>
