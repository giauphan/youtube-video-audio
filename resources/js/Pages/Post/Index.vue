<template>
    <div className="mx-auto my-10 max-w-5xl px-4 sm:px-6 md:my-20 md:px-8">
        <Header :categorys="categorys"></Header>

        <div className="flex flex-col justify-center gap-y-10">
            <div :key="post.id" className="flex flex-col gap-4" v-for="post in posts.data" v-if="posts.data">
                <h2
                    className="relative text-3xl font-bold transition-all before:absolute before:-start-10 before:top-0 text-white before:content-['#'] hover:text-primary-500 hover:before:text-gray-200 sm:text-4xl lg:text-2xl">
                    <a :href="route('posts.show', post.slug)">{{ post.title }}</a>
                </h2>
                <p class="text-white font-semibold "> {{ post.summary }}</p>

            </div>
        </div>

        <Paginate :pagination="posts" v-if="posts" />
    </div>
</template>


<script setup>
import route from 'ziggy-js'
import Paginate from '../../components/Paginate.vue';
import Header from './Header.vue';

const props = defineProps(['posts', 'categorys'])
</script>