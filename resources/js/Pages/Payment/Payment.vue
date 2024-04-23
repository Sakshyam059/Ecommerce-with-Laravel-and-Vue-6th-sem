<script setup>
import ContentLayout from "@/Layouts/ContentLayout.vue"

import { computed } from "vue";
import { useCartStore } from "@/Pages/Cart/cart";
import { storeToRefs } from "pinia";
import axios from "axios";
import { useForm } from "@inertiajs/vue3";

const formData=useForm({
    amount:100,
})
const submitForm=()=>{
    formData.post(route('khalti.pay'));
}

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);


const total = computed(() => {
    let total = 0;
    cart.value.forEach((c) => {
        total += c.price;
    });
    if (total > 0) {
        return total.toFixed(2);
    }
    return 0;
});

const totalWithoutDot = () => {
    let num = String(total.value).split('.').join('')
    return Number(num)
}
</script>
<template>
    <ContentLayout>
            
        <h1 class="text-xl font-bold py-3 border-b border-gray-300 mb-4">Payment Details</h1>
        <form @submit.prevent="submitForm" method="post" class="flex justify-between gap-8">
            <div class="w-full">
                <div class="flex justify-between gap-8">
                    <div class="w-full">
                    <label for="">First Name</label>
                    <input type="text" class="block w-full p-2 text-sm h-10 my-2 bg-gray-50 rounded border-gray-300"/>
                </div>
                <div class="w-full">
                    <label for="">Last Name</label>
                    <input type="text" class="block w-full p-2 text-sm h-10 my-2 bg-gray-50 rounded border-gray-300"/>
                </div>
                </div>
                <div  class="flex justify-between gap-8">
                    <div class="w-full">
                    <label for="">Mobile Number</label>
                    <input type="text" class="block w-full p-2 text-sm h-10 my-2 bg-gray-50 rounded border-gray-300"/>
                </div>
                <div class="w-full">
                    <label for="">Email Address</label>
                    <input type="text" class="block w-full p-2 text-sm h-10 my-2 bg-gray-50 rounded border-gray-300"/>
                </div>
                </div>
                <div>
                    <label for="">Shipping Address</label>
                    <input type="text" class="block w-full p-2 text-sm h-10 my-2 bg-gray-50 rounded border-gray-300"/>
                </div>
                <div>
                    <label for="">Remarks</label>
                    <textarea class="block w-full p-3 my-2 bg-gray-50 rounded border-gray-300 text-sm" name="remarks" id="" cols="30" rows="3"></textarea>
                </div>
            </div>
            <div class="w-1/3 mx-auto p-6 border "> 
                <h2 class="pb-2 text-lg font-bold">Total Billings</h2>
                <div>
                    <label for="amount" class="flex justify-between py-1"><span>Amount</span><span>{{ formData.amount }}</span></label>
                    <input type="hidden" name="amount" class="block w-full my-2" disabled  v-model="formData.amount">
                </div>
                <div>
                    <label for="shipping_amount" class="flex justify-between pt-1 pb-3"><span>Shipping amount</span><span>50</span></label>
                    <input type="hidden" name="shipping_amount" class="block w-full my-2"  v-model="formData.amount">
                </div>
                <div class="border-t">
                    <label for="total_amount" class="flex justify-between py-1"><span>Total amount</span><span>150</span></label>
                    <input type="hidden" name="total_amount" class="block w-full my-2"  v-model="formData.amount">
                </div>
                <div class="h-fit">
                    <button type="submit" class="w-full text-white block  bg-purple-900 mt-4 px-16 py-2 rounded-md">
                        <span>Pay with Khalti</span>
                    </button>
                </div>    
            </div>
    </form>
    </ContentLayout>
</template>