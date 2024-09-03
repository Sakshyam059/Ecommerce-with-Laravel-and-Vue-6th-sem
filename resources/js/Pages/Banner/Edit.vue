<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue'
const props=defineProps({
    categories:Object,
    banner:Object
})

const fileInput=ref(null);
const banner_img=ref(null);

const getImage = (event) => {
        form.image = event.target.files[0];
        banner_img.value=URL.createObjectURL(form.image);
};
const form=useForm({
    category_id:props.banner.category_id,
    image:props.banner.image,
})

const submit=()=>{
    form.put(route('banner.update',{'banner':props.banner.id}));
}
</script>
<template>
    <AuthenticatedLayout>
       <h2 class="py-2 text-2xl font-bold"> Update Banner</h2>
       <form @submit.prevent="submit()" method="post" class="my-4">
            <div class="">
                <div class="w-full px-6 py-4 border rounded-md bg-gray-100/60 border-gray-400/50">
                    <div class="my-3">      
                        <label>Category</label>
                       <select class="block" name="category_id" id="" v-model="form.category_id">
                        <option selected disabled>Choose a category</option>
                        
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                       </select>
                    
                    </div>
                    
                </div>
                <div class="p-6 border rounded-md h-fit bg-gray-100/60 border-gray-400/40">
                    <h2 class="pb-2 mb-2 text-base font-bold" >
                        Upload Image
                    </h2>
                    <div v-if="banner_img" class="w-full">
                        <label class="flex flex-col items-center w-full px-4 py-8 tracking-wide uppercase bg-white border-2 rounded-lg cursor-pointer text-blue border-blue hover:bg-blue hover:text-blue-600">
                            <img  :src="banner_img&&banner_img" class="h-56 bg-emerald-300"/>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                    <div v-else class="flex items-center w-full bg-grey-lighter">
                        <label v-if="banner" class="flex flex-col items-center w-full px-4 py-6 tracking-wide uppercase bg-white border-2 rounded-lg cursor-pointer text-blue border-blue hover:bg-blue hover:text-blue-600">
                            <img  :src="'/images/banner/'+banner.image" class="h-56 bg-emerald-300"/>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                        <label v-else class="flex flex-col items-center w-full px-4 py-16 tracking-wide uppercase bg-white border-2 rounded-lg cursor-pointer text-blue border-blue hover:bg-blue hover:text-blue-600">
                            
                            <svg  class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-base leading-normal">Select a file</span>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="absolute right-0 px-8 py-2 mt-2 text-sm font-semibold text-white bg-blue-800 border border-gray-500 top-2 rounded-xl">Update Banner</button>
        </form>
    </AuthenticatedLayout>
</template>