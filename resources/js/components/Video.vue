<template>
  <div class="grid grid-cols-1 sm:grid-cols-4 my-10 gap-5">
    <section class="col-span-3 rounded">
      <div class="flex flex-col gap-6 aspect-video">
        <video ref="videoPlayer" width="100%" height="360" :class="[
          'aspect-video h-auto sm:h-[360px] rounded-lg',
          video.type === 'short' && 'h-[500px] w-300px',
        ]" controls @ended="playNextVideo">
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
      <div @drop="onDrop($event, 1)" @dragenter.prevent @dragover.prevent @touchstart="touchstart" @touchmove="touchmove"
        @touchend="touchend">
        <div v-for="(list, key) in videolist_play" :key="key" @dragstart="startDrag($event, key)">
          <a :href="route('video.index', ('video', list.id))" class="flex flex-col">
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

    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Buttons from './Buttons.vue';
import route from 'ziggy-js';

const props = defineProps(['video', 'videos_drag', 'csrf']);

const linkVideo = ref(props.video.url_video);
const title_video = ref(props.video.title);
const videoPlayer = ref(null);
const videolist_play = ref(props.videos_drag);


const startDrag = (event, index) => {
  event.dataTransfer.dropEffect = 'move';
  event.dataTransfer.effectAllowed = 'move';
  event.dataTransfer.setData('itemIndex', index);
};

const onDrop = (event, newIndex) => {
  try {
    const draggedIndex = event.dataTransfer.getData('itemIndex');
    console.log(videolist_play.value)
    const updatedList = [...Object.values(videolist_play.value)];

    const [draggedItem] = updatedList.splice(draggedIndex, 1);

    updatedList.splice(newIndex, 0, draggedItem);
    videolist_play.value = updatedList;

  } catch (error) {
    console.error('Error in onDrop:', error);
  }
};

let touchStartIndex = null;
const touchstart = (event) => {
  touchStartIndex = event.currentTarget.dataset.index;
};

const touchmove = (event) => {
  event.preventDefault();

};

const touchend = (event) => {
  const newIndex = event.currentTarget.dataset.index;

  if (touchStartIndex !== null && newIndex !== null) {
    onDrop({ dataTransfer: { getData: () => touchStartIndex } }, newIndex);
  }

  touchStartIndex = null;
};

const truncateTitle = (title) => {
  return title.length > 40 ? `${title.substring(0, 40)}...` : title;
};


const playNextVideo = () => {
  try {
    const videolist = videolist_play.value;
    const video = props.video;
    const videoArray = Object.values(videolist);
    let currentVideoId = video.id;
    const currentVideoIndex = videoArray.findIndex((item) => item.id === currentVideoId);

    if (currentVideoIndex !== -1 && currentVideoIndex + 1 < videoArray.length) {
      const nextVideo = videoArray[currentVideoIndex + 1];
      linkVideo.value = nextVideo.url_video;
      title_video.value = nextVideo.title;
      video.id = nextVideo.id;

      // Remove the next video from the array
      videoArray.splice(currentVideoIndex + 1, 1);
    } else {
      const nextVideo = videoArray[0];
      linkVideo.value = nextVideo.url_video;
      title_video.value = nextVideo.title;
      video.id = nextVideo.id;
    }


    videoPlayer.value.load();
    videoPlayer.value.play();
  } catch (error) {
    console.error('Error in playNextVideo:', error);
  }
};


</script>
