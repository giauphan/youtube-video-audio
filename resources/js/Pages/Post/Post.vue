<template>
 <div className="flex flex-col justify-center gap-y-10">
            <div :key="post.id" className="flex flex-col gap-4" v-for="post in posts.data"  v-if="posts.data">
                <h2
                    className="relative text-3xl font-bold transition-all before:absolute before:-start-10 before:top-0 text-white before:content-['#'] hover:text-primary-500 hover:before:text-gray-200 sm:text-4xl lg:text-5xl">
                    <a :href="route('posts.show', post.slug)">{{post.title}}</a>
                </h2>
                <p> {{post.description }}</p>
                <div className="flex gap-6">
                    <div>
                        bởi
                        <strong className="ms-1"> {{post }}</strong>
                    </div>
                    <div className="flex gap-2">
                        <!-- <a :href="route('posts.show', [`?tag=$tag.slug}`])" :key="tag.id" v-for="tag in tags">
                          {{  # tags . name }}
                        </a> -->
                    </div>
                    <div> {{post.published_at }}</div>
                </div>
            </div>
        </div>

        <Paginate :pagination="posts" v-if="posts"/> 
</template>

<script>
import route from 'ziggy-js'
import Paginate from '../../components/Paginate.vue';

const props = defineProps(['posts'])
</script>