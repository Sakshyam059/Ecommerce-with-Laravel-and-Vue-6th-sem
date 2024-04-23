<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { useCartStore } from "@/Pages/Cart/cart";

import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import axios from "axios";
import { watch } from "vue";
import debounce from "lodash.debounce";
import { onBeforeUnmount } from "vue";
import { storeToRefs } from "pinia";
import useDetectOutsideClick from '@/OutsideClickDetect.js'

const cartStore = useCartStore();
const {cart} = storeToRefs(cartStore)
const searchKeyword = ref("")
const products = ref([])

const user = usePage().props.auth.user;

const debouncedWatch = debounce(() => {
    handleSearch(searchKeyword.value)
}, 500);

watch(searchKeyword, debouncedWatch);

onBeforeUnmount(() => {
  debouncedWatch.cancel();
})
const show=ref(true)
const handleSearch=async(searchKeyword)=>{
    show.value=true
    if(searchKeyword!==""){   
    await axios.get(`http://127.0.0.1:8000/api/products/search/${searchKeyword}`)
    .then( (response)=>{ 
        products.value=response.data;
    });
    }else{
        products.value=[];
    }
}
const resetCart=()=>{
    cartStore.$reset();
}
const searchRef = ref()
useDetectOutsideClick(searchRef, () => { 
    show.value=false
})
const searchProduct=()=>{
    router.visit(route('search.result',{keyword:searchKeyword.value}))
}
</script>

<template>
        <nav class="flex justify-between flex-no-wrap items-center px-12 py-5 bg-white border-b border-gray-200">
            <div class="w-fit">
            <Link href="/" class="tracking-wide bg-gradient-to-r from-gray-700 via-gray-600 to-gray-600  inline-block text-transparent bg-clip-text text-2xl font-extrabold">
                Prommerce
            </Link>
            </div>
        <form @submit.prevent="searchProduct" method="get" class="relative w-2/5" ref="searchRef">
            <div class=" relative flex justify-end items-center  rounded-sm overflow-hidden z-50">      
                <input type="text"
                    v-model="searchKeyword" 
                    placeholder="Search for products" 
                    class="w-full text-xs py-3 pl-4 pr-16  text-gray-500  border border-gray-700 rounded-sm outline-none focus:ring-gray-700 focus:bg-white  focus:border-gray-700 placeholder:text-sm" />
                
                    <button type="submit" class="absolute top-0 bottom-0 right-0 bg-gray-700 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" >
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>
                
            </div>
            <div v-if="show && products.length>0" class="absolute top-6 right-0 left-0  z-40 bg-gray-50 text-xs  text-gray-700 rounded border border-gray-700">
                <Link :href="route('product.about',product.id)" v-for="product in products" :key="product.id" class="block py-2  first:pt-6  even:bg-slate-100/80  hover:bg-gray-50/40 last:rounded-b">
                   <div class="flex items-center gap-2">
                    <img :src="'/images/product/'+ product.image" class="w-8 h-6 pl-4"/>
                    <h3 class="pl-4">{{ product.name }}</h3>
                   </div>
                </Link>
            </div>
           
        </form>
        <div class=" flex items-center justify-end  text-stone-600 font-medium">
            <Link :href="route('mycart')" class="relative w-full flex items-center justify-center mb-1 p-2">
                <svg class="stroke-gray-700" xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="20.5" r="1"/><circle cx="18" cy="20.5" r="1"/><path d="M2.5 2.5h3l2.7 12.4a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.6l1.6-8.4H7.1"/></svg>
                <span v-if="cartStore.cart.length > 0" class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1 rounded-2xl h-fit">{{ cartStore.cart.length }}</span>
            </Link>
            <div v-if="$page.props.auth.user" class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Settings Dropdown -->
                <div class="ms-3 relative ">
                    <Dropdown align="right" width="w-full"  >
                        <template #trigger>
                            <div class="inline-flex w-10 h-10 rounded-full mb-1 ">
                                <img v-if="user.image" :src="'/images/profile/'+user.image" class="w-10 h-10 rounded-full object-cover  inline-flex items-center text-sm leading-4 font-medium  text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                           
                                <div v-else class="w-10 h-10  inline-flex justify-center items-center">
                                    <svg  xmlns="http://www.w3.org/2000/svg" class="cursor-pointer stroke-gray-700" width="26" height="26" viewBox="0 0 24 24" fill="none"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
                                </div>
                            
                            </div>
                        </template>
                        <template #content>
                            <DropdownLink :href="route('home')"> Home </DropdownLink>
                            <DropdownLink :href="route('orders.index')"> My Orders </DropdownLink>
                            <DropdownLink :href="route('profile.edit')"> My Profile </DropdownLink>
                            <DropdownLink :href="route('logout')" @click="resetCart"  method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </div>
            <template v-else>
                <Dropdown align="right" width="w-full" >
                        <template #trigger>
                            <span class="inline-flex rounded-md ml-5 py-2">
                                <button type="button" class="bg-gray-50/30 inline-flex  gap-1 px-3 py-2 border border-gray-600/60 text-sm leading-4 rounded-md font-medium   hover:bg-gray-50/80 focus:outline-none transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15"  viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span class="mx-1">Account</span>
                                </button>
                            </span>
                        </template>
                        <template #content>
                            <DropdownLink :href="route('login')"> Login </DropdownLink>
                            <DropdownLink :href="route('register')"> Register </DropdownLink>
                        </template>
                    </Dropdown>
            </template>
        </div>
        </nav>
   
</template>
