<script setup>
import ContentLayout from "@/Layouts/ContentLayout.vue"
import Product from "@/Components/Product.vue"
const props=defineProps({
    products:{
        type:Array,
        default:[]
    },
    keyword:String
})
</script>

<template>
    <ContentLayout>
     <div class="-mt-10">
            <strong class="text-2xl text-gray-600">Search result for <small class="px-2 text-blue-400 font-medium">" {{ keyword }} "</small></strong> 
            
        </div>
        <section class="flex gap-4 flex-wrap">
            <div v-if="products.length>0" v-for="product in products">
                <Product :product="product" />           
            </div>
            <div v-else class="w-full min-h-80 text-gray-400 font-medium grid place-items-center  text-3xl">
                No any products listed
            </div>
        </section>
    </ContentLayout>
</template>