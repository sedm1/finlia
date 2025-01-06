<template>
  <section class="main">
    <div class="container">
      <h1 class="main_title">Регистрация</h1>
      <div class="main_form">
        <UiInput
            placeholder="Желаемый никнейм"
            v-model="nickname"
        />
        <UiInput
            placeholder="Ваша почта"
            v-model="email"
            :isError="!isEmailRegexpCorrect && email.length > 0"
        />
        <UiInput
            placeholder="Введите пароль"
            :isSecret="true"
            v-model="password"
            :isError="!isPasswordsIdentity"
        />
        <UiInput
            placeholder="Повторите пароль"
            :isSecret="true"
            v-model="secondPassword"
            :isError="!isPasswordsIdentity"
        ></UiInput>
        <UiButton
            @click="sendUserForm()"
            title="Зарегистрироваться"
            class="mainForm_button"
        ></UiButton>

        <NuxtLink></NuxtLink>
      </div>
    </div>
  </section>
</template>

<script setup>
import UiInput from '@/ui/input/input.vue'
import UiButton from '@/ui/button/button.vue'

useHead({
  title: 'Finlia - Регистрация'
})

const nickname = ref('');
const email = ref('');
const password = ref('');
const secondPassword = ref('')

/**
 * Проверка идентичности паролей
 */
const isPasswordsIdentity = computed(() => password.value === secondPassword.value)

/**
 * Проверка соответствия почти регулярке
 */
const isEmailRegexpCorrect = computed(() => {
  if (!email.value) return;

  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  return regex.test(email.value);
})

const checkUserData = () => {
  if (!isPasswordsIdentity.value) return false;
  if (!isEmailRegexpCorrect.value) return false;
  if (!nickname.value) return false;

  return true;
}

/**
 * Отправить данные клиента на сервер
 */
const sendUserForm = async () => {
  // if (!checkUserData()) return;

  const data = await $fetch('/api/user/registration', {
    method: 'post',
    body: {
      nickname: nickname.value,
      email: email.value,
      password: password.value
    }
  })

  console.log(data)
}
</script>

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
</style>
