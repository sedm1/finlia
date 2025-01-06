<script setup lang="ts">
import type Props from '@/ui/input/props'

withDefaults(defineProps<Props>(), {
  isError: false,
  isSecret: false
})

const emit = defineEmits<{
  (e: 'update:modelValue', value: string): void
}>()

/**
 * Экранировать html
 */
const escapeHtml = (val: string) => {
  return val
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;')
      .replace(/`/g, '&#x60;');
}

</script>

<template>
  <input
      :class="{
        'ui-input': true,
        'ui-input-error': isError
      }"
      :placeholder
      :value="modelValue"
      :type="isSecret ? 'password' : 'text'"
      @input="emit('update:modelValue', escapeHtml($event.target!.value.trim()))"
  />
</template>

<style lang="sass" src="@/ui/input/input.sass"></style>
