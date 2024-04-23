<script setup>
import CategoryBar from '@/Components/Sections/CategoryBar.vue';
import Product from '@/Components/Product.vue';
import ContentLayout from '@/Layouts/ContentLayout.vue';

defineProps({
    products:Object,
    categories:Object,
    category_name:Object,
})
</script>
<template>
    <ContentLayout>
        <template #category>
            <div  class="w-full fixed left-0 right-0  border-b border-gray-800/15">
                <CategoryBar :categories="categories"/>
            </div>
        </template>
        <div class="mt-5">
            <strong class="text-xl ">Category</strong> > 
            <small class="text-blue-600 font-medium">{{ category_name }}</small>
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