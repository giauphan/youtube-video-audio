<template>
  <div class="flex flex-col gap-6 aspect-video">
    <iframe
      :src="video.url_video"
      allowfullscreen
      width="100%"
      height="360px"
      :class="[
        'aspect-video h-auto sm:h-[360px] rounded-lg',
        video.type == 'short' && 'h-[500px] w-300px',
      ]"
    ></iframe>
    <h1 class="text-xl text-white font-bold bg-black text-center" id="title">
      {{ video.title }}
    </h1>

    <slot></slot>
  </div>
</template>
<script>
export default {
  props: ['video'],
}
</script>