<script setup lang="ts">
import PrimaryButton from "./buttons/PrimaryButton.vue";
</script>
<template>
  <article class="max-w-md shadow-md p-6 rounded-2xl space-y-2">
    <header>Card title</header>
    <hr />
    <main>
      <p class="line-clamp-3">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Id cum eaque fugit fuga
        blanditiis minus veniam quisquam delectus? Recusandae dolorum cupiditate ullam
        minima, fugiat nesciunt? Assumenda maxime optio corrupti maiores.
      </p>
    </main>
    <hr />
    <footer>
      <PrimaryButton aria-label="veja mais sobre o filme"> Veja mais</PrimaryButton>
    </footer>
  </article>
</template>
<style scoped lang="scss"></style>
