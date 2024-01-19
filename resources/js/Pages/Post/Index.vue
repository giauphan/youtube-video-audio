<template>
<div className="mx-auto my-10 max-w-5xl px-4 sm:px-6 md:my-20 md:px-8">
    <div className="mb-10 flex flex-col   px-4 py-3">
           <h2 className="mb-4 text-xl font-bold"></h2>
           <ul className="flex flex-wrap gap-x-3 gap-y-2 text-gray-600">
                    <li :key="category.id" className="font-semibold transition-all " v-for="category in categorys">
                   <a :href="route('posts.index', [`category_blog_name=${category.slug}`])" class="text-gray-400">{{ category.name }}</a>
               </li>
           </ul>
       </div>
    <div className="flex flex-col justify-center gap-y-10">
        {{ console.log(posts.data) }}
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

const props = defineProps(['posts','categorys'])
</script>