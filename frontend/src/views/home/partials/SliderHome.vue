<template>
  <swiper @swiper="onSwiper" @slideChange="onSlideChange" class="h-[60dvh]">
    <swiper-slide v-for="index in 10" :key="index" class=""
      ><img
        src="@/assets/imgs/banner-de-cinema.avif"
        class="w-full h-full object-cover object-center"
        alt="imagem banner"
    /></swiper-slide>
  </swiper>
</template>
<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";

const onSwiper = (swiper) => {
  console.log(swiper);
};
const onSlideChange = () => {
  console.log("slide change");
};
</script>
