<template>
    <div v-if="isShowModal"  class="fixed placeholder-opacity-10 w-full z-40 top-0 left-0  h-screen   "
        tabindex="-1" aria-labelledby="drawer-label">

        <div class="  px-10 bg-black h-screen  py-4 w-60 sm:w-1/2 overflow-y-auto opacity-100" >
            <div class="w-full flex justify-end">
                <XMarkIcon class="h-5 w-5 text-white" @click="handleOpen" />
            </div>
            <div>
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script>
import { XMarkIcon } from '@heroicons/vue/24/solid';

export default {
    props: ['isShowModal', 'onClose'],
    methods: {
        handleOpen() {
            if (this.onClose) {
                this.onClose();
            }
        }
    },
    components: { XMarkIcon }
}
</script>