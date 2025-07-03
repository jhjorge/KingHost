<script setup lang="ts">
import { useToastStore } from "@/stores/toast";
import Toast from "@/components/ui/Toast.vue";

const toastStore = useToastStore();
</script>

<template>
  <div class="fixed bottom-4 right-4 z-50 flex flex-col gap-2">
    <Toast
      v-for="(toast, index) in toastStore.toasts"
      :key="index"
      v-bind="toast"
      @close="toastStore.removeToast(index)"
    />
  </div>
</template>
