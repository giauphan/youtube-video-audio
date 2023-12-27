<template>
    <div class="flex flex-col gap-6">
        <video id="video" width="100%" height="360px" class="aspect-video sm:h-[360px] rounded-lg" controls>
            <source :src="url_video" type="video/mp4">
        </video>
        <h1 class="text-xl text-white font-bold bg-black">{{ title }}</h1>
    </div>
</template>

<script>
export default {
    props: ['title', 'url_video']
}
</script>