<script setup>
import { Link } from "@inertiajs/vue3";
import ContentLayout from "@/Layouts/ContentLayout.vue";
import StarRating from 'vue-star-rating'
// import ProductSpecification from "./Partials/ProductSpecification.vue";
import CustomerReviews from "./Review/CustomerReviews.vue";
import { computed, ref, toRefs } from "vue";
import { useCartStore } from "@/Pages/Cart/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore()
const {cart} = storeToRefs(cartStore)

const props = defineProps({
  product: Object,
  myreview: Object,
  reviews: Object,
})

const stock=()=>{
    if(props.product.stock>0){
        return true
    }else{
        return false
    }
}
let availability=ref(stock())

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
    <ContentLayout>     
            <div class="flex justify-between gap-10 mb-4">
            <img :src="'/images/product/' + product.image" class="w-2/5" />
            <div class="">
                <h1 class="  text-3xl font-extrabold pt-8">
                    {{product.name}}
                    
                </h1>
                <h4  class="text-sm py-2 text-gray-900"><span class="font-medium">Category &gt; </span> <Link :href="route('category.product',{name:product.category.name})" class="text-blue-600">{{ product.category.name }}</Link></h4>
                <div class="py-1">             
                    <star-rating :rating="product.rating" :read-only="true"  :show-rating="false" :padding="10"></star-rating>
             
                <h4 v-if="availability" class="mt-6 mb-3 text-sm font-semibold text-green-600">In stock*</h4>
                <h4 v-else class="mt-6 mb-3 text-sm font-semibold text-red-600">Out of stock*</h4>
                
                <strong class="font-bold items-center flex gap-2">
                    <span class=" text-2xl">Rs {{product.base_price}}</span>
                </strong>
                <!--<Ratings />-->
                <p class="text-sm py-4 text-stone-400">Rem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, nemo nesciunt veritatis ratione, consectetur dolorum beatae perspiciatis fugiat dignissimos ut sequi quas maxime, quidem dolores magni fuga. Eos, adipisci voluptatem. Lorem ipsumorem ipsum dolor sit amet consectetur adipisicing elit.
                Asperiores, nemo nesciunt Asperiores, nemo nesciunt  consectetur adipisicing elit.orem ipsum dolor sit amet consectetur adipisicing elit.
                Asperiores, nemo nesciunt Asperiores, nemo nesciunt  consectetur adipisicing elit.</p>
                <!-- <OrderQuantity /> -->
            </div>
                <div class="flex justify-between items-center gap-6">
                    <button :disabled="isAlreadyInCart" class="w-full border  text-white text-sm py-3  my-2 rounded" :class="isAlreadyInCart?'bg-gray-800 ':'bg-orange-500 border-orange-800'" @click="addToCart(product)" >
                        {{isAlreadyInCart?'Added to Cart':'Add to Cart'}}
                    </button>
                </div>
            <!-- <button
                type="submit"
                class="w-full  text-gray-800 border border-gray-800 text-sm py-3  rounded"
            >
                Order Now
            </button> -->
            </div>
        </div>
        <!-- <ProductSpecification /> -->
        <CustomerReviews :product_id="product.id" :myreview="myreview" :reviews="reviews"/>
    </ContentLayout>
</template>
