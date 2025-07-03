<script setup lang="ts">
import { RouterView } from "vue-router";
import NavBar from "@/components/layout/NavBar.vue";
import FooterBar from "./components/layout/FooterBar.vue";
import { useToastStore } from "@/stores/toast";
import Toast from "@/components/ui/Toast.vue";
const toastStore = useToastStore();
</script>

<template>
  <div class="bg-[var(--color-third)]">
    <NavBar />
    <main>
      <Toast
        v-for="(toast, index) in toastStore.toasts"
        :key="index"
        v-bind="toast"
        @close="toastStore.removeToast(index)"
      />
      <Transition mode="in-out" name="page-trasition">
        <RouterView />
      </Transition>
    </main>
    <FooterBar />
  </div>
</template>

<style lang="sass" scoped>
.page-transition-enter-active, .page-transition-leave-active
  transition: opacity 0.4s ease, transform 0.4s ease

.page-transition-enter-from, .page-transition-leave-to
  opacity: 0
  transform: translateY(20px)

.page-transition-enter-to, .page-transition-leave-from
  opacity: 1
  transform: translateY(0)
</style>
