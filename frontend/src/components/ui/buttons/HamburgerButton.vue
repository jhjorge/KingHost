<script setup lang="ts">
defineProps<{ toggle_menu: boolean }>();
defineEmits<{
  (e: "toggle"): void;
}>();
</script>
<template>
  <button
    type="button"
    @click="$emit('toggle')"
    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
    aria-controls="navbar-sticky"
    aria-expanded="false"
  >
    <span class="sr-only">Abrir Menu</span>
    <svg
      class="w-5 h-5"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 17 14"
    >
      <path
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M1 1h15M1 7h15M1 13h15"
      />
    </svg>
  </button>
</template>
