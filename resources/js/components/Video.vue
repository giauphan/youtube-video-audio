<template>
  <div class="flex flex-col gap-6 aspect-video">
    <video ref="videoPlayer" width="100%" height="360" :class="[
      'aspect-video h-auto sm:h-[360px] rounded-lg',
      video.type === 'short' && 'h-[500px] w-300px',
    ]" controls autoplay @ended="playNextVideo">
      <source :src="linkVideo" type="video/mp4" />
    </video>
    <h1 class="text-xl text-white font-bold bg-black text-center" id="title">
      {{ title_video }}
    </h1>
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: ['video', 'videolist'],
  data() {
    return {
      linkVideo: this.video.url_video,
      title_video: this.video.title
    };
  },
  methods: {
    playNextVideo() {

      const currentVideoId = this.video.id;
      if (currentVideoId) {
        return;
      }
      const videoIds = Object.keys(this.videolist);
      const currentVideoIndex = videoIds.findIndex((id) => id === currentVideoId);
      if (
        currentVideoIndex !== -1 &&
        currentVideoIndex + 1 < videoIds.length
      ) {
        const nextVideoId = videoIds[currentVideoIndex + 1];
        this.linkVideo = this.videolist[nextVideoId].url_video;
        this.title_video = this.videolist[nextVideoId].title;
        this.$refs.videoPlayer.load()
        this.$refs.videoPlayer.play()
      }

    },
  },
};
</script>
