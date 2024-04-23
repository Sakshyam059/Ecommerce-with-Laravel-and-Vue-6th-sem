<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
defineProps({
    products:Object
})

const destroy=(id)=>{
    router.delete(route('product.delete',id), {preserveScroll: true})    
}

</script>
<template>
    <AuthenticatedLayout>
        <h2 class="w-fit text-2xl font-semibold pt-2  pb-3 text-gray-900">Products</h2>
        <Table  class="border-t pt-5">
            <template #table-head>
                <tr>
                    <th>S.N</th>
                    <th>Product Name</th>
                    <th>Price</th>
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(product,index) in products" class="text-sm">
                    <td class="py-2">{{ index+1 }}</td>
                    <td class="py-2">{{ product.product.name }}</td>
                    <td class="py-2">{{ product.product.base_price }}</td>              
                </tr>
            </template>
        </Table>
    </AuthenticatedLayout>
</template>