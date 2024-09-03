<script setup>
import ContentLayout from "@/Layouts/ContentLayout.vue";
import { Link } from "@inertiajs/vue3";

import { useCartStore } from "@/Pages/Cart/cart";
const cartStore = useCartStore();
cartStore.$reset();

defineProps({
    amount:Number,
    ref_id:Number
})
</script>

<template>
    <ContentLayout>
        <section class="mb-6 h-96 ">
            <div class="flex flex-col justify-between w-1/2 p-6 mx-auto border rounded-md h-fit bg-gray-50 border-gray-600/40">
                <div class="grid grid-cols-3 gap-6">
                <div class="inline-flex flex-col items-center justify-center text-sm font-bold text-green-600">
                    <svg class="pr-2" width="68px" height="68px" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect width="48" height="48" fill="white" fill-opacity="0.01"></rect> <path d="M24 4L29.2533 7.83204L35.7557 7.81966L37.7533 14.0077L43.0211 17.8197L41 24L43.0211 30.1803L37.7533 33.9923L35.7557 40.1803L29.2533 40.168L24 44L18.7467 40.168L12.2443 40.1803L10.2467 33.9923L4.97887 30.1803L7 24L4.97887 17.8197L10.2467 14.0077L12.2443 7.81966L18.7467 7.83204L24 4Z" fill="#01b20d" stroke="#303030" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M17 24L22 29L32 19" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    <span class="pt-3">Payment Successful!</span>
                </div> 
                    <div class="col-span-2">
                        <h3 class="text-xl font-bold">Order Details</h3>   
                       <ul class="py-4 space-y-2 text-sm">
                        <li>Ref No. : <span>{{ref_id}}</span></li> 
                        <li>Total Amount : <span>Rs {{amount}}</span></li> 
                        <li>Payment method : <span>Khalti</span></li> 
                       </ul>
                    </div>
                </div>
                
                <div class="text-center ">
                
                <p class="py-4 text-sm font-medium text-gray-600">Thank you, your orders have been paid successfully.<br> Your order will arrive soon.</p>      
                <Link :href="route('orders.index')" class="px-6 py-2 mt-4 text-white rounded bg-green-500/80">Continue</Link>
           
            </div>
        </div>
        </section>
    </ContentLayout>
</template>