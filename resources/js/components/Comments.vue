<template>
  <div>
   
    <div v-for="comment in post.comments" :key="comment.id" class="text-white flex flex-col gap-3">
      <div>
        <div>
          <span class="text-white"> {{ comment.user.name }} : </span>{{ comment.body }}
        </div>
        <!-- Reply form for parent comment -->
        <form :action="route('posts.comments', post)" method="post" class="flex mt-2">
          <slot></slot>
          <input type="hidden" name="parent_id" :value="comment.id">
          <Input name="body" placeholder="Reply to this post"/>
          <button type="submit" class="bg-gray-700 p-2 text-white">Submit Reply</button>
        </form>
      </div>

      <!-- Show replies -->
      <div v-if="comment.replies && comment.replies.length" class="flex flex-col gap-3 mb-3">
        <div v-for="reply in comment.replies" :key="reply.id">
          <div class="text-green-500">
            <span class="text-green-500"> @{{ comment.user.name }} : </span>{{ comment.body }}
          </div>
          <span class="text-white"> {{ reply.user.name }} : </span>{{ reply.body }}
          <!-- Reply form for reply -->
          <!-- <form :action="route('posts.comments', post)" method="post" class="flex mt-2">
            <slot></slot>
            <input type="hidden" name="parent_id" :value="reply.id">
            <Input name="body" placeholder="Reply to this post"/>
            <button type="submit" class="bg-gray-700 p-2 text-white">Submit Reply</button>
          </form> -->
        </div>
      </div>
    </div>

    <form :action="route('posts.comments', post)" method="post" class="flex mt-5">
        <slot></slot>
        <input type="hidden" name="parent_id">
        <!-- <input type="text" placeholder="Reply to this post" name="body" class="mr-2 text-black"> -->
        <Input name="body" placeholder="Reply to this post"/>
        <button type="submit" class="bg-gray-700 p-2 text-white">Submit Reply</button>
      </form>
  </div>
</template>

<script setup>
import route from 'ziggy-js'
import Input from './Input.vue';

const props = defineProps(['post'])
</script>