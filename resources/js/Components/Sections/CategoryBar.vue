<script setup>
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from "@inertiajs/vue3";

defineProps({
    categories:Object
})
</script>
<template>
    <section class="flex items-center w-full text-sm text-white bg-gray-800">
        <Dropdown class="w-1/3 border-t cursor-pointer border-black/10 ">
            <template #trigger>
                    <button type="button" class="inline-flex items-center py-2 text-sm font-medium transition duration-150 ease-in-out rounded-full  hover:text-gray-400 focus:outline-none">
                        <span class="pl-12">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                            </span>
                            <span class="pl-3">
                                All Categories
                            </span>  
                    </button>
            </template>
            <template #content >
                <div class="absolute top-0 left-0 right-0 border-white">             
                    <DropdownLink v-for="category in categories" :key="category.id" class="py-1 pl-12 text-white bg-gray-800 hover:text-gray-800" :href="route('category.product',{name:category.name})"> {{category.name}} </DropdownLink>
                </div>
            </template>
        </Dropdown>
                
            <div class="flex items-center justify-between w-full py-1 pl-6 pr-12 font-medium border-t border-black/10 ">
                <Link :href="route('welcome')" class="block py-1 ">Home</Link>
                <a :href="route('product.index')" class="block p-1 ">Shop</a>
                <Link :href="route('about')" class="block p-1 ">About</Link>
                <a href="" class="block p-1 ">Contact us</a>
            </div>
        </section>
</template>