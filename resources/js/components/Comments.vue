<template>
    <div>
      <div v-for="comment in post.comments" :key="comment.id" class="text-white">
        <div>{{ comment.body }}</div>
        <!-- Reply form for parent comment -->
        <form :action="route('posts.comments', post)" method="post">
          <slot></slot>
          <input type="hidden" name="parent_id" :value="comment.id">
          <input type="text" placeholder="Reply to this comment" name="body" class="mr-2 text-black">
          <button type="submit" class="bg-white p-2 text-black">Submit Reply</button>
        </form>
        <!-- Show replies -->
        <div v-if="comment.replies && comment.replies.length">
          <div v-for="reply in comment.replies" :key="reply.id" class="ml-4">
            {{ reply.body }}
            <!-- Reply form for reply -->
            <form :action="route('posts.comments', post)" method="post">
              <slot></slot>
              <input type="hidden" name="parent_id" :value="reply.id">
              <input type="text" placeholder="Reply to this comment" name="body" class="mr-2 text-black">
              <button type="submit" class="bg-white p-2 text-black">Submit Reply</button>
            </form>
          </div>
        </div>
      </div>
      <!-- Reply form for new comment if no comments exist -->
      <template v-if="post.comments.length === 0">
        <form :action="route('posts.comments', post)" method="post">
          <slot></slot>
          <input type="hidden" name="parent_id">
          <input type="text" placeholder="Reply to this post" name="body" class="mr-2 text-black">
          <button type="submit" class="bg-white p-2 text-black">Submit Reply</button>
        </form>
      </template>
    </div>
  </template>
  
  <script setup>
  import route from 'ziggy-js'
  
  const props = defineProps(['post'])
  </script>
  