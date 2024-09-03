<script setup>
import ContentLayout from '@/Layouts/ContentLayout.vue';
import CategoryBar from "@/Components/Sections/CategoryBar.vue";

import Product from '@/Components/Product.vue';
defineProps({
    products:Object,
    categories:Object
})

</script>
<template>
    <ContentLayout>
        <template #category>
            <div  class="fixed left-0 right-0 w-full border-b border-gray-800/15">
                <CategoryBar :categories="categories"/>
            </div>
        </template>
        <h2 class="pb-3 text-2xl font-semibold text-gray-900 w-fit">All Products</h2>
        <div class="grid grid-cols-4 gap-4">
            <div v-for="product in products">
                <Product :product="product"/>
            </div>
        </div>
    </ContentLayout>
</template>