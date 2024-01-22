<template>
    <div className="mb-10 flex flex-col   px-4 py-3 border-b border-gray-700">
        <h2 className="mb-4 text-xl font-bold"></h2>
        <ul className="flex flex-wrap justify-between items-center gap-x-3 gap-y-2 text-gray-600">
            <li :key="category.id" className="font-semibold transition-all " v-for="category in categorys">
                <a :href="route('posts.index') + `?category_blog_name=${category.slug}`" :class="['font-semibold text-lg hover:underline capitalize whitespace-nowrap', isActive(route('posts.index') + `?category_blog_name=${category.slug}`) ? 'text-blue-300' : 'text-white']" >{{
                    category.name }}</a>
            </li>
        </ul>
    </div>
</template>

<script setup>
import route from 'ziggy-js';
const isActive = (url) => {
  const currentParams = new URLSearchParams(window.location.search);
  const urlParams = new URL(url).searchParams;
  const currentCategoryBlogName = currentParams.get('category_blog_name');
  const urlCategoryBlogName = urlParams.get('category_blog_name');

  return currentCategoryBlogName === urlCategoryBlogName;
};
const props = defineProps(['categorys'])
</script>