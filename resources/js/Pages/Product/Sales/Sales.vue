<script setup>
import ContentLayout from '@/Layouts/ContentLayout.vue';
import Table from '@/Components/Table.vue';
import { Link, router } from '@inertiajs/vue3';
import Product from '@/Components/Product.vue';

const props=defineProps({
    sales:Object
})
const destroy=(id)=>{
    router.delete(route('sales.delete',id), {preserveScroll: true})    
}
</script>
<template>
<ContentLayout>
    <section class="-mt-10">      
            <h2 class="w-fit text-2xl font-semibold  pb-3 text-gray-900">Top Sales</h2>

        <section class="flex gap-4 flex-wrap">
            <div v-if="sales.length>0" v-for="sale in sales">
                <Product :product="sale.product" />           
            </div>
            <div v-else class="w-full min-h-80 text-gray-400 font-medium grid place-items-center  text-3xl">
                No any products sale listed
            </div>
        </section>
</section>
</ContentLayout>
</template>