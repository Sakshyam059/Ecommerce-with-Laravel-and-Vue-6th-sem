<script setup>
import { Link } from "@inertiajs/vue3";
import { Transition, ref } from "vue";
import { computed, toRefs } from "vue";
import { useCartStore } from "@/Pages/Cart/cart";
import { storeToRefs } from "pinia";

import StarRating from 'vue-star-rating'

const cartStore = useCartStore()
const {cart} = storeToRefs(cartStore)

const show = ref(false);
const props = defineProps({
  product: Object,
})
const { product } = toRefs(props);

const addToCart = (product) => {
  let price=cartStore.priceLimit()+product.total_price
  if(price>0 && price<=1000){
    cart.value.push({product_id:product.id,total_price:product.total_price})
  }
}

const isAlreadyInCart = computed(() => {
    let res = cart.value.find(c => c.product_id === product.value.id)
    if(res) return true
    return false
})
</script>
<template>
    <div class="relative text-sm border p-4 my-4 w-52 min-h-52 overflow-hidden" @mouseover="show = true" @mouseleave="show=false" :data="{ id: product.id }">
      <Transition name="fade-slide" appear >
            <div v-if="show" class="absolute top-1 right-2 w-10">
            <button type="button" :disabled="isAlreadyInCart" @click="addToCart(product)" class="w-full flex items-center justify-center my-2 p-2 bg-white border border-gray-300 rounded-full hover:bg-gray-50" >
                <svg xmlns="http://www.w3.org/2000/svg" class="p-1"  viewBox="0 0 24 24" fill="none" stroke="#fb8d31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
            </button>
            <button type="button" class="w-full flex items-center justify-center  p-2 bg-white border border-gray-300 rounded-full hover:bg-gray-50" >
                <svg xmlns="http://www.w3.org/2000/svg" class="p-1"  viewBox="0 0 24 24" fill="none" stroke="#fb8d31" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </button>
        </div>
        </Transition>
        <Link :href="route('product.about',{id:product.id})">
          <div>
            <img :src="'/images/product/'+ product.image" class="h-44 object-cover"/>
          </div>
          <div>
            <strong class="block mt-2 font-bold text-stone-800">{{ product.name }}</strong>
          <h6 class="text-xs text-stone-500 ">New features with 2TB SSD</h6>
          </div>
          <div class="my-2">
            <star-rating :rating="product.rating" :read-only="true" :star-size="16"  :show-rating="false" :padding="10"></star-rating>
          </div>
          <div>
            <strong class="inline-flex mt-2 ">Rs {{ product.total_price }}           
            <small class="ml-2  text-red-600 line-through">Rs {{ product.base_price }} </small>
          </strong>
          </div>
          <div class="absolute top-1 left-1 px-3 py-1 font-semibold bg-yellow-400">
            <small class="block text-gray-800">{{ product.discount }}% Off</small>
          </div>
        </Link> 
    </div>
</template>
<style scoped>

.fade-slide-enter-active,
.fade-slide-leave-active {
  transition: opacity 1s ease, transform 0.4s ease-in-out;
  transform: translateY(0px);
}

.fade-slide-enter-from,
.fade-slide-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}
</style>
