<script setup>
import ContentLayout from "@/Layouts/ContentLayout.vue";
import { Link } from "@inertiajs/vue3";

import { useCartStore } from "@/Pages/Cart/cart";
const cartStore = useCartStore();
cartStore.$reset();

defineProps({
    amount:Number
})
</script>

<template>
    <ContentLayout>
        <section class="mb-6 h-96 ">
            <div class="bg-gray-50 w-1/2 mx-auto h-full p-6 text-center flex flex-col justify-between border border-gray-600/40 rounded-md">
                <h3 class="text-2xl text-green-600 pt-4 font-bold inline-flex flex-col items-center justify-center">
                    <svg class="pr-2" width="68px" height="68px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="48" height="48" fill="white" fill-opacity="0.01"></rect> <path d="M24 4L29.2533 7.83204L35.7557 7.81966L37.7533 14.0077L43.0211 17.8197L41 24L43.0211 30.1803L37.7533 33.9923L35.7557 40.1803L29.2533 40.168L24 44L18.7467 40.168L12.2443 40.1803L10.2467 33.9923L4.97887 30.1803L7 24L4.97887 17.8197L10.2467 14.0077L12.2443 7.81966L18.7467 7.83204L24 4Z" fill="#01b20d" stroke="#303030" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M17 24L22 29L32 19" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    <span class="pt-3">Payment Successful!</span>
                </h3> 
                <p class="text-2xl py-4 text-gray-600 font-extrabold">Rs {{amount}}</p>
                <p class="text-sm text-gray-600 font-medium">Thank you, your orders have been paid successfully.<br> Your order will arrive soon.</p>
             
                <Link :href="route('orders.index')" class="block bg-green-500/80 text-white px-6 py-2 rounded my-4">Continue</Link>
            </div>
        </section>
    </ContentLayout>
</template>