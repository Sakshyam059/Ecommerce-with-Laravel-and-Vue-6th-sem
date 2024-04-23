<script setup>
import InputError from "@/Components/InputError.vue";
import AutheticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {  useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const props=defineProps({
    categories:Object
})
const form = useForm({
    name: '',
    description: '',
    category_id: '',
    base_price: '',
    stock: '',
    image: '',
    discount: '',
    discount_type: '',
});
const fileInput=ref(null);
const product_img=ref(null);


const getImage = (event) => {
        form.image = event.target.files[0];
        product_img.value=URL.createObjectURL(form.image);
};
const submit = () => {
    form.post(route('product.store'));
};
</script>

<template>
<AutheticatedLayout>
    <form  @submit.prevent="submit" method="post" enctype="multipart/form-data" >
        <div class="flex justify-between mb-2">
            <h1 class="inline-flex items-center text-2xl font-bold  ">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zM3.8 6h16.4M16 10a4 4 0 1 1-8 0"/></svg></span>
                <span class="pl-2">Add New Product</span>    
            </h1>
            <button type="submit" class="inline-flex items-center bg-gray-700 text-white px-6 py-2 my-2 rounded-full">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></span>
                <span class="pl-2">Add Product</span>    
            </button>
        </div>
        <div class="flex gap-8 justify-between">
            <div class="w-full font-medium text-sm ">
                <div class="bg-gray-100/60 border border-gray-400/40 px-5 py-4 rounded-xl mb-4">
                    <h2 class="text-base font-bold pb-2 " >
                        General Information
                    </h2>
                    <label class="block pt-2">Product name <small class="text-base font-bold text-red-600">*</small></label>
                    <input type="text" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded" v-model="form.name" name="name"/>
                    <InputError class="mt-2" :message="form.errors.name" />
                    
                    <label class="block pt-2">Description <small class="text-base font-bold text-red-600">*</small></label>
                    <textarea class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded" rows="4" v-model="form.description" name="description"></textarea>
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>
                <div class="bg-gray-100/60 border border-gray-400/40 px-5 py-4 rounded-xl">
                    <h2 class="text-base font-bold pb-4 " >
                        Pricing and Stocks
                    </h2>
                    <div class="flex justify-between gap-8">
                        <div class="w-full">
                            <label>Base Pricing <small class="text-base font-bold text-red-600">*</small></label>
                            <input type="text" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded" v-model="form.base_price" name="base_price"/>
                            <InputError class="mt-2" :message="form.errors.base_price" />
                            
                        </div>
                        <div class="w-full">
                            <label>Stock <small class="text-base font-bold text-red-600">*</small></label>
                            <input type="text" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded" v-model="form.stock" name="stock"/>
                            <InputError class="mt-2" :message="form.errors.stock" />
                            
                        </div>
                    </div>
                    <div class="flex justify-between gap-8 ">
                        <div class="w-full py-2">
                            <label>Discount</label>
                            <input type="text" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded" v-model="form.discount" name="discount"/>
                        </div>
                        <div class="w-full py-2">
                            <label>Discount Type</label>
                            <input type="text" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded" v-model="form.discount_type" name="discount_type"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/2 ">
                <div class="bg-gray-100/60 border border-gray-400/40 mb-6 px-6 py-4  rounded-md">
                    <h2 class="text-base font-bold pb-2 mb-2" >
                        Upload Image
                    </h2>
                    <div v-if="product_img" class="w-full">
                        <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border-2 border-blue cursor-pointer hover:bg-blue hover:text-blue-600">
                            <img  :src="product_img&&product_img" class="h-56 bg-emerald-300"/>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                    <div v-else class="flex w-full items-center  bg-grey-lighter">
                        <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border-2 border-blue cursor-pointer hover:bg-blue hover:text-blue-600">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-base leading-normal">Select a file</span>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                </div>
                <div class="bg-gray-100/60 border border-gray-400/40 px-6 py-4  rounded-md ">
                    <h2 class="text-base font-bold pb-2 " >
                        Category <small class="text-base font-bold text-red-600">*</small>
                    </h2>
                    <label class="text-sm">Product Category</label>
                    <select v-model="form.category_id" name="category" id="category" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded">
                        <option value="" selected disabled>Choose a category</option>
                        <option v-for="category in categories" :value="category.id"  >{{ category.name }}</option>
                    </select>
                    <InputError class="mt-2" v-if="form.errors.category_id" message="Category field is required." />

                    <!-- <input type="text" class="bg-white/40 outline-none border-gray-400/60 block w-full my-2 rounded" v-model="form.category_id" name="category"/> -->
                </div>
            </div>
        </div>
    </form>
</AutheticatedLayout>
</template>