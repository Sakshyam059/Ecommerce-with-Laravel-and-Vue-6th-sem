<script setup>

import { computed, ref } from "vue";
import { useCartStore } from "@/Pages/Cart/cart";
import { storeToRefs } from "pinia";
import ContentLayout from "@/Layouts/ContentLayout.vue";
import InputError from "@/Components/InputError.vue";
import {  useForm } from '@inertiajs/vue3';
import { onMounted } from "vue";
import axios from "axios";
import { reactive } from "vue";

const props=defineProps({
    destinations:Object
})
const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);


let cart_products=ref([])
const handleCart=async()=>{ 
    await axios.get('http://127.0.0.1:8000/api/cart/products',{params:{cart:cart.value}})
    .then( (response)=>{ 
        cart_products.value=response.data;
    });
}
onMounted(()=>{
    handleCart()
})

const removeFromCart = (id) => {
    cartStore.removeProductFromCart(id);
    handleCart()
};
const total = computed(() => {
    let total = 0;
    if(cart_products.value.length>0){
        cart_products.value.forEach((c) => {
            total += c.total_price;
        });
    }else{
        total=0
    }
    if (total > 0) {
        return total.toFixed(2);
    }
    return 0;
});

const totalWithoutDot = () => {
    let num = String(total.value).split('.').join('')
    return Number(num)
}

const order = useForm({
    products:cart,
    destination_id:'',
    total_amount:total,
})

const submit=()=>{
    order.post(route('khalti.pay'));
}

</script>

<template>
    <ContentLayout >
        <div class="flex gap-3 items-center text-2xl font-semibold -mt-10 text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1e40af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
            <strong>Shopping Cart</strong>
        </div>
        <div class="flex gap-4">
            <div class="w-full h-fit bg-white py-4 mt-8 border-2 border-gray-100 rounded">
                <div v-if="!cart.length" class="text-center font-bold text-xl py-20">
                    Your Cart is empty
                </div>
                <div v-else class="p-4" v-for="product in cart_products" :key="product.id" >
                    <div>
                        <div class="flex justify-between items-center border-b">
                        <img :src="'/images/product/'+product.image" class="w-20 h-20 mb-4 " />
                        <div class="w-full flex items-center ">          
                            <div class="px-6">
                                <h3 class="uppercase text-gray-900 pb-2  font-bold ">
                                {{ product.name }}
                            </h3>
                            <span class="text-gray-400">
                            {{
                                product.description.substring(0, 180)
                            }}</span>
                            <h4 class="font-medium text-sm text-teal-600 py-2">In Stock</h4>
                            </div>
                        </div>
                        <div class="w-1/2 flex items-center font-bold pl-20">
                            <span>Rs {{ product.total_price }}</span>
                        </div>
                        
                        <div @click="removeFromCart(product.id)" class=" inline-flex items-center text-sm text-white  rounded-md hover:underline cursor-pointer">
                            <span class="p-3 rounded bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>    
            <div class="font-extrabold pt-4 pr-10 text-right">
                Purchase amount: Rs {{ total }}
            </div>
            </div>
            <form @submit.prevent="submit" method="post" class="bg-white w-1/2 p-4 mt-8 h-fit  border-2 rounded-md border-gray-100">
                <h2 class="font-bold text-lg text-gray-700 mb-2 ">Order Summary</h2>
                <div class="flex justify-between mb-2 text-sm ">
                    <h3>Total items</h3>
                    <span>{{ cart.length }}</span>
                </div>
                <div class="flex justify-between mb-2 text-sm ">
                    <h3>Shipping amount</h3>
                    <span>{{ cart.length }}</span>
                </div>
                <div class="flex justify-between mb-2 text-sm">
                    <h3>Total amount</h3>
                    <span>Rs {{ total }}</span>
                </div>
                <h2 class="font-bold text-lg text-gray-700 mt-4 ">Shipping Details</h2>
                <div class=" my-2 text-sm ">     
                    <h3 class="mb-3">Shipping Address</h3>
                    <select v-model="order.destination_id" name="destination_id" id="destination" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded">
                        <option value="" selected disabled>Choose a address</option>
                        <option v-for="destination in destinations" :value="destination.id"  >{{ destination.address }}</option>
                    </select>
                    <InputError class="mt-2" :message="order.errors.destination_id" />
                    <!-- <input type="text" class="w-full h-8 bg-gray-100/60 border border-gray-300/50 rounded" name="shipping_address"/> -->     
                </div>
                
                <div class=" my-2 text-sm ">     
                    <input type="hidden" v-model="order.total_amount" class="w-full h-8 bg-gray-100/60 border border-gray-300/50 rounded" name="total_amount"/>
                
                </div>
               
           
                <button
                    class="block mt-4 w-full text-center text-white py-2 font-bold text-sm rounded-lg border shadow-sm cursor-pointer"
                    :disabled="Number(total) === 0.0"
                    :class="
                        Number(total) === 0.0
                            ? 'bg-gray-400 '
                            : 'bg-purple-800  hover:bg-purple-500'
                    ">
                    Pay with Khalti
                </button>
            </form>
        </div>
    </ContentLayout>
</template>