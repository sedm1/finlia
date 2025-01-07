<script setup lang="ts">
import UiInput from '@/ui/input/input.vue'
import UiButton from '@/ui/button/button.vue'

const nickname = ref('')
const password = ref('')

const checkUserData = computed(() => {
  return nickname.value && password.value
})
const login = async () => {
  if (!checkUserData.value) return;

  const res = await $fetch('/api/user/login', {
    method: 'POST',
    body: {
      nickname: nickname.value,
      password: password.value
    }
  })
}
</script>

<template>
  <section class="main">
    <div class="container">
      <h1 class="main_title">Войти в аккаунт</h1>
      <div class="main_form">
        <UiInput
            placeholder="Ваш никнейм"
            v-model="nickname"
        ></UiInput>

        <UiInput
            placeholder="Пароль"
            :isSecret="true"
            v-model="password"
        />

        <UiButton title='Войти' @click="login()"/>
      </div>
      <p class="mainForm_link">Еще нет аккаунта?
        <NuxtLink to="/registration">Регистрация</NuxtLink>
      </p>
    </div>
  </section>
</template>

<style lang="sass" scoped>
.main
  height: 100dvh
  display: flex
  align-items: center

  &_title
    font-size: 42px

  &_form
    display: flex
    flex-direction: column
    gap: 15px
    max-width: 550px
    align-items: flex-start
    margin-top: 20px

  &Form
    &_button
      margin-top: 10px

    &_link
      font-size: 14px
      display: flex
      align-items: center
      gap: 2px
      margin-top: 10px

      a
        font-size: 14px
        color: $blue
</style>
