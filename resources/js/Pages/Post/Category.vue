<template>
    <div className="mb-10 flex flex-col   px-4 py-3">
           <h2 className="mb-4 text-xl font-bold"></h2>
           <ul className="flex flex-wrap gap-x-3 gap-y-2 text-gray-600">
                    <li :key="category.id" className="font-semibold transition-all " v-for="category in categorys">
                   <a :href="route('posts.index', [`category_blog_name=${category.slug}`])" class="text-gray-400">{{ category.name }}</a>
               </li>
           </ul>
       </div>
</template>

<script setup>
import route from 'ziggy-js'

const props = defineProps(['categorys'])
</script>