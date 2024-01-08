<template>
    <RadioGroup v-model="plan" class="flex flex-col gap-3">
        <RadioGroupLabel>Plan</RadioGroupLabel>
        <RadioGroupOption v-for="plan in plans" :key="plan" :value="plan" as="template" v-slot="{ active, checked }"
          class="flex w-full items-center justify-between" >
            <li :class="{
                ' text-white bg-sky-900/75 relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none': active,
                'bg-white text-black relative flex cursor-pointer rounded-lg px-5 py-4 shadow-md focus:outline-none': !active,
            }">
                {{ plan }}
                <CheckIcon v-show="checked" class="h-5 w-5" />
            </li>
        </RadioGroupOption>
    </RadioGroup>
</template>
  
<script setup>
import { ref } from 'vue'
import {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
} from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/20/solid'

const plans = ['Startup', 'Business', 'Enterprise']
const plan = ref(plans[0])
</script>