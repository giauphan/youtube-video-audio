<script setup>
import { ArrowLeftIcon, ArrowRightIcon } from '@heroicons/vue/24/solid'
</script>

<template>
  <nav aria-label="Navigation" className="my-10 w-full ">
    <ul
      className="flex h-8 min-w-full items-center justify-center gap-4 text-sm"
    >
      <li v-for="page in pagination.links" :key="page.url">
        <a
          :href="page.url ? page.url : '#'"
          :class="{
            'pagination-link flex h-8 items-center justify-center px-4 leading-tight  rounded': true,
            'bg-[#34AEE6] text-white': page.active,
            'bg-white text-black': !page.active,
          }"
        >
          <template v-if="page.label.includes('laquo;')">
            <ArrowLeftIcon class="h5 w-5" />
          </template>
          <template v-else-if="page.label.includes('raquo;')">
            <ArrowRightIcon class="h5 w-5" />
          </template>
          <template v-else>
            {{ getPageLabel(page) }}
          </template>
        </a>
      </li>
    </ul>
  </nav>
</template>
<script>
export default {
  props: ['pagination'],
  setup(props) {
    const isActive = (page) => page === props.pagination.currentPage

    const getPaginationClasses = (page) => ({
      active: isActive(page),
      'hover:bg-primary-100': !isActive(page),
    })

    return {
      isActive,
      getPaginationClasses,
    }
  },
  methods: {
    getPageLabel(page) {
      if (page.url) {
        return page.label
      } else {
        const pageNumber = parseInt(page.label)
        return isNaN(pageNumber) ? '' : pageNumber
      }
    },
  },
}
</script>