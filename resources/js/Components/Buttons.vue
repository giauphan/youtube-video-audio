<script setup>
const props = defineProps([
  'type',
  'icon',
  'shadow',
  'disabled',
  'size',
  'iconPosition',
  'color',
  'class',
  'id'
])

const getSize = () => {
  switch (props.size) {
    case 'sm':
      return 'px-4 py-2.5 text-sm'
    case 'md':
      return 'px-6 py-3.5 text-base'
    case 'lg':
      return 'px-8 py-4 text-lg'
  }
}

const getColor = () => {
  switch (props.color) {
    case 'primary':
      return 'bg-primary-500 text-white hover:bg-primary-600 hover:shadow-primary-600/50 disabled:bg-primary-200'
    case 'gray':
      return 'bg-gray-900 text-white hover:bg-gray-800 hover:shadow-gray-700/50 disabled:bg-gray-200'
    case 'danger':
      return 'bg-red-500 text-white hover:bg-red-700 hover:shadow-red-600/50 disabled:bg-red-200'
    case 'success':
      return 'bg-green-500 text-white hover:bg-green-600 hover:shadow-green-700/50 disabled:bg-green-200'
    case 'warning':
      return 'bg-amber-500 text-white hover:bg-amber-600 hover:shadow-amber-400/50 disabled:bg-amber-200'
    case 'white':
      return 'bg-white text-gray-900 hover:bg-gray-100 hover:shadow-gray-100/50 disabled:bg-gray-200'
  }
}

const getIcon = () => {
  if (!props.icon) {
    return null
  }

  return createElement(icon, {
    className: size === 'sm' ? 'w-4 h-4' : 'w-6 h-6',
  })
}
</script>

<template>
  <button
    :type="props.type"
    :id="id"
    role="button"
    :class="[
      'font-semibold transition-all',
      props.shadow && 'hover:shadow-[0_6px_20px_0]',
      props.disabled &&
        'disabled:cursor-not-allowed disabled:hover:shadow-none',
      icon &&
        `inline-flex items-center justify-center gap-2 ${
          props.size === 'sm' ? 'gap-2' : 'gap-3'
        }`,
      getSize(),
      getColor(),
      props.class,
    ]"
  >
    <template v-if="icon && iconPosition === 'start'">
      {{ getIcon() }}
    </template>
    <slot></slot>
    <template v-if="icon && iconPosition === 'end'">
      {{ getIcon() }}
    </template>
  </button>
</template>
