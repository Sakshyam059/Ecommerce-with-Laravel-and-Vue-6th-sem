<script>
  // import Swiper core and required modules
  import { Navigation, Pagination,Autoplay } from 'swiper/modules';

  // Import Swiper Vue.js components
  import { Swiper, SwiperSlide } from 'swiper/vue';

  // Import Swiper styles
  import 'swiper/css';
  import 'swiper/css/navigation';
  import 'swiper/css/pagination';

  // Import Swiper styles
  export default {
    components: {
      Swiper,
      SwiperSlide,
    },props:{
        'banners':Object,
    },
    setup() {
     
      return {
        modules: [Autoplay,Pagination,Navigation],
      };
    },
  };
</script>
<template>
 
    <div class="my-4 overflow-hidden rounded shadow-sm border-gray-400/30 shadow-black/40">
        <swiper
        :modules="modules"
    :slides-per-view="1"
    :space-between="50"
    :pagination="{ clickable: true }"
    :autoplay='{
        "delay": 5000,
        "disableOnInteraction": false
    }'
  >
    <swiper-slide v-if="banners" v-for="banner in banners" :key="banner.id">
        <img :src="'/images/banner/'+banner.image" class="h-[400px] object-center w-full hover:scale-125 transition ease-in duration-500" />
    </swiper-slide>
   
  </swiper>
    </div>        
</template>