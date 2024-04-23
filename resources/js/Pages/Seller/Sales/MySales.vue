<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import { Link, router } from '@inertiajs/vue3';
const props=defineProps({
    sales:Object
})
const destroy=(id)=>{
    router.delete(route('sales.delete',id), {preserveScroll: true})    
}
</script>
<template>
<AuthenticatedLayout>
    <section>
        <div class="pt-2">        
            <h2 class="w-fit text-2xl font-semibold  pb-3 text-gray-900">My Sales</h2>
        </div>
        <Table v-if="sales.length>0" class="border-t pt-5">
            <template #table-head>
                <tr>
                    <th class="py-2">S.N</th>
                    <th class="py-2">Product Name</th>
                    <th class="py-2">Base price</th>
                    <th class="py-2">Discount rate</th>
                    <th class="py-2">Sale price</th>
                    <th class="py-2">Edit</th>
                    <th class="py-2">Delete</th>
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(sale,index) in sales" :key="sale.id" >
                    <td class="py-2">{{ index+1 }}</td>
                    <td class="py-2">{{ sale.product.name }}</td>
                    <td class="py-2">{{ sale.product.base_price }}</td>
                    <td class="py-2">{{ sale.product.discount }} %</td>
                    <td class="py-2">{{ sale.product.total_price }}</td>
                    <td class="py-2 text-white  ">
                        <Link :href="route('sales.form',{id:sale.product_id})" class=" px-4 py-2 text-xs rounded-3xl  bg-green-600">Edit</Link>
                    </td>
                    <td class="py-2   text-white">
                        <button @click="destroy(sale.id)" class=" px-4 py-2 text-xs rounded-3xl  bg-red-600">Delete</button>
                    </td>
                </tr>
            </template>
        </Table>
        <div v-else class="min-h-80 text-gray-400 font-medium grid place-items-center text-3xl">
            No any sales listed
        </div>
</section>
</AuthenticatedLayout>
</template>