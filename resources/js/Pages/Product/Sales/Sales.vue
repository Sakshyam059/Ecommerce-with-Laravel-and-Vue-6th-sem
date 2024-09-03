<!-- <script setup>
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
            <h2 class="pb-3 text-2xl font-semibold text-gray-900 w-fit">Top Sales</h2>

        <section class="flex flex-wrap gap-4">
            <div v-if="sales.length>0" v-for="sale in sales">
                <Product :product="sale.product" />           
            </div>
            <div v-else class="grid w-full text-3xl font-medium text-gray-400 min-h-80 place-items-center">
                No any products sale listed
            </div>
        </section>
</section>
</ContentLayout>
</template> -->