<template>
  <button class="ui-button">{{ title }}</button>
</template>
<script setup lang="ts">
defineProps<{
  title: String
}>()
</script>
<style src="@/ui/button/button.sass" lang="sass"></style>
