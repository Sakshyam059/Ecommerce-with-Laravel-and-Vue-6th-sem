<script setup>
import InputError from '@/Components/InputError.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue'
const props=defineProps({
    product:Object,
    sale:Object
})

const fileInput=ref(null);
const sale_img=ref(null);

const getImage = (event) => {
        form.image = event.target.files[0];
        sale_img.value=URL.createObjectURL(form.image);
};
const form=useForm({
    discount:props.product.discount,
    image:''
})
const sale_amount = computed(() => {
    let amount =props.product.base_price - props.product.base_price*form.discount/100;
    return amount;
})
const submit=()=>{
    form.post(route('sales.add',{product_id:props.product.id}));
}
</script>
<template>
    <AuthenticatedLayout>
       <h2 class="py-2 text-2xl font-bold"> Add Sales</h2>
       <form @submit.prevent="submit()" method="post" class="my-4">
            <div class="flex justify-between gap-16">
                <div class="w-full bg-gray-100/60 px-6 py-4 rounded-md border border-gray-400/50">
                    <div class="my-3">      
                        <label>Product name</label>
                        <input class="block mt-2 text-white bg-gray-800/80 w-full rounded" type="text" :value="product.name" disabled/>
    
                    
                    </div>
                    <div class="my-3">      
                        <label>Base Price</label>
                        <input class="block mt-2 text-white bg-gray-800/80 w-full rounded" type="text" v-model="product.base_price" disabled/>
                    </div>
                    <div class="my-3">      
                        <label>Discount rate</label>
                        <input class="block mt-2 bg-white w-full rounded" type="text" v-model="form.discount" />
                    </div>
                    <div class="my-3">      
                        <label>Sale amount</label>
                        <input class="block mt-2 text-white bg-gray-800/80 w-full rounded" type="text" v-model="sale_amount" disabled/>
                    </div>
                </div>
                <div class="w-1/2 h-fit bg-gray-100/60 border border-gray-400/40 p-6 rounded-md">
                    <h2 class="text-base font-bold pb-2 mb-2" >
                        Upload Image
                    </h2>
                    <div v-if="sale_img" class="w-full">
                        <label class="w-full flex flex-col items-center px-4 py-8 bg-white text-blue rounded-lg tracking-wide uppercase border-2 border-blue cursor-pointer hover:bg-blue hover:text-blue-600">
                            <img  :src="sale_img&&sale_img" class="h-56 bg-emerald-300"/>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                    <div v-else class="flex w-full items-center  bg-grey-lighter">
                        <label v-if="sale" class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border-2 border-blue cursor-pointer hover:bg-blue hover:text-blue-600">
                            <img  :src="'/images/sale/'+sale.image" class="h-56 bg-emerald-300"/>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                        <label v-else class="w-full flex flex-col items-center  px-4 py-16 bg-white text-blue rounded-lg tracking-wide uppercase border-2 border-blue cursor-pointer hover:bg-blue hover:text-blue-600">
                            
                            <svg  class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-base leading-normal">Select a file</span>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="absolute top-2 right-0 text-sm bg-blue-800 font-semibold text-white mt-2 px-8 py-2 rounded-xl border border-gray-500">Add to Sale</button>
        </form>
    </AuthenticatedLayout>
</template>