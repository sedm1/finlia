<script setup lang="ts">
const userStore = useUserStore();
</script>

<template>
  <header>
    <div class="container">
      <div class="header_block">
        <h2 class="header_logo">Finlia</h2>

        <nav>
          <ul class="header_menu">
            <li class="headerMenu_item">
              <NuxtLink to="/main">Главная</NuxtLink>
            </li>
          </ul>
        </nav>

        <ClientOnly>
          <div class="header_right">
            <p class="headerRight_profile">{{ userStore.nickname }}</p>
          </div>
        </ClientOnly>
      </div>
    </div>
  </header>
</template>

<style scoped lang="sass">
header
  padding: 20px 0

.header
  &_block
    display: flex
    align-items: center
    justify-content: space-between
  &_logo
    font-size: 30px
    font-weight: 700
</style>
