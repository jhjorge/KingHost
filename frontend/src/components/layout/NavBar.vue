<script setup lang="ts">
import { RouterLink } from "vue-router";
import Logo from "@/components/ui/Logo.vue";
import PrimaryButton from "@/components/ui/buttons/PrimaryButton.vue";
import HamburgerButton from "../ui/buttons/HamburgerButton.vue";
import { ref } from "vue";

const menu: { title: string; link: string; icon?: string }[] = [
  {
    title: "Home",
    link: "/",
    icon: "",
  },
  {
    title: "About",
    link: "/about",
    icon: "",
  },
];
const toggle_menu = ref(false);

const toggleMenu = () => {
  toggle_menu.value = !toggle_menu.value;
};
</script>
<template>
  <header class="bg-[var(--color-fourth)] shadow-md sticky w-full z-20 top-0 start-0">
    <nav class="container mx-auto">
      <div
        class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4"
      >
        <RouterLink to="/" class="w-12">
          <Logo />
        </RouterLink>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
          <PrimaryButton> Login</PrimaryButton>

          <HamburgerButton :toggle_menu @toggle="toggleMenu" />
        </div>
        <div
          class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
          id="navbar-sticky"
        >
          <ul class="flex gap-6 font-medium">
            <RouterLink
              v-for="(item, index) in menu"
              :key="index"
              :to="item.link"
              class="hover:text-[var(--color-primary)]transition-colors duration-200"
            >
              {{ item.title }}
            </RouterLink>
          </ul>
        </div>
      </div>
      <div
        :class="[
          'items-center justify-between w-full md:hidden fixed ',
          toggle_menu ? 'block' : 'hidden',
        ]"
        id="navbar-sticky"
      >
        <ul
          class="flex flex-col gap-2 font-medium rounded-b-md p-2 bg-[var(--color-fifth)]"
        >
          <li v-for="(item, index) in menu" :key="index">
            <RouterLink
              :to="item.link"
              class="block space-y-4 rounded md:p-0 hover:text-[var(--color-primary)] transition-colors duration-200"
            >
              {{ item.title }}
            </RouterLink>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</template>

<style lang=""></style>
