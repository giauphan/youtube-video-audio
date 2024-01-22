<template>
    <div class="mx-auto my-10 max-w-5xl px-4 sm:px-6 md:my-20 md:px-8">
        <div class="mb-6 flex flex-col gap-4 text-white">
            <h2 v-if="post && post.title" class="mb-6 text-3xl font-bold md:text-5xl">{{ post.title }}</h2>

            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <a :href="route('posts.index')" class="flex items-center gap-2 ">
                <ChevronLeftIcon class="h-5 w-5 text-white" />
                Quay lại
                </a>

                <div class="flex flex-wrap justify-start gap-6 ">
                    <div class="flex gap-2">
                        Lượt xem:<strong>{{ post.view }}</strong>
                    </div>
                    <div>
                        Danh mục:<strong>{{ post.CategoryBlog.name }}</strong>
                    </div>
                    <strong>{{ post.published_at }}</strong>
                </div>
            </div>

            <div class="text-lg tracking-wide text-gray-700">{{ post.description }}</div>
        </div>

        <template v-if="post.thumbnail">
            <img :src="post.thumbnail" :alt="post.title" class="mb-6 w-full object-cover" />
        </template>
        <div class="prose prose-xl mb-20 transition-all hover:prose-a:text-white text-white " v-html="post.content"></div>

    </div>
</template>

<script setup>
import { ChevronLeftIcon } from '@heroicons/vue/24/solid';
import route from 'ziggy-js'

const props = defineProps(['post'])
</script>