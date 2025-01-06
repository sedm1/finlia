<template>
  <section class="main">
    <div class="container">
      <div class="main_block">
        <h1 class="mainBlock_title"><span>Finlia</span> - поиск тиммейтов для совместных игр</h1>
        <p class="mainBlock_description">Сервис поможет вам просто и быстро найти игроков на любой вкус и цвет</p>
        <div class="mainBlock_links">
          <UiButton
              title="Регистрация"
              @click="router.push('registration')"
          ></UiButton>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import UiButton from '@/ui/button/button.vue'
import {useRouter} from "#app";

const router = useRouter();

useHead({
  title: 'Главная страница - Finlia'
})
</script>

<style lang="sass" scoped>
.main
  height: 100dvh
  display: flex
  align-items: center

  &_block
    display: flex
    flex-direction: column
    align-items: center
    text-align: center
    gap: 30px

  &Block
    &_title
      font-size: 42px
      font-weight: 800
      line-height: 45px

      span
        color: $blue

    &_description
      font-size: 16px

    &_links
      display: flex
      align-items: center
      gap: 20px

    &Links
      &_registration


@media screen and (max-width: 750px)
  .main
    &_block
      gap: 20px

    &Block
      &_title
        font-size: 5vw
        line-height: normal

      &_description
        font-size: 3vw
        max-width: 80%

      &Links
        &_registration
          padding: 5px 40px
          font-size: 14px
</style>
