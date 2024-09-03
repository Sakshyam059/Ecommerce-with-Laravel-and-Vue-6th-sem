<script>
  import Product from "@/Components/Product.vue"
  import {ref} from "vue"
  // import Swiper core and required modules

  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';

  // Import Swiper styles
  export default {
    components: {
      Product,
      Swiper,
      SwiperSlide,
    },props:{
      'products':Object,
      'sales':Object,
      'heading':String
    },
    setup() {
      const swiperInstance = ref()
      function onSwiper(swiper) {
            swiperInstance.value = swiper
        }
        const swiperNextSlide = () => {
            swiperInstance.value.slideNext()
        };
        const swiperPrevSlide = () => {
            swiperInstance.value.slidePrev()
        };
      return {
        onSwiper,
        swiperPrevSlide,
        swiperNextSlide
      };
    },
  };
</script>
<template>
  <section v-show="products.length>0">
    <h2 class="flex justify-between font-semibold text-stone-600">
    <strong>{{heading}}</strong>
  </h2>
  <div class="relative flex items-center">
      <swiper  
    :slides-per-view="products.length>4?4:products.length"
    :space-between="20"
    :pagination="{ clickable: true }"
    @swiper="onSwiper"
    :autoplay='{
        "delay": 5000,
        "disableOnInteraction": false
    }'
  >
 
  <swiper-slide v-for="product in products" :key="product.id">
      <Product :product="product"/>
    </swiper-slide>
  </swiper>
  <div v-if="products.length>0" class="text-gray-500">
      <button type="button " class="absolute z-40 px-1 text-3xl leading-10 bg-gray-100 border border-gray-300 -left-8 " @click="swiperPrevSlide()">&lt;</button>
      <button type="button " class="absolute z-40 px-1 text-3xl leading-10 bg-gray-100 border border-gray-300 -right-8 " @click="swiperNextSlide()">&gt;</button>
    </div>
</div>
  </section>
</template>