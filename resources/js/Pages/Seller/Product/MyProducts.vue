<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
defineProps({
    products:Object
})

const destroy=(id)=>{
    router.delete(route('product.delete',id),{ onSuccess: () => {
        router.visit(route('categories'))
    }})    
}

</script>
<template>
    <AuthenticatedLayout>
        <div class="relative pt-2">         
            <h2 class="pb-3 text-2xl font-semibold text-gray-900 w-fit">Products</h2>
            <Link :href="route('add.product')" class="absolute right-0 flex items-center px-4 py-3 text-xs text-white bg-gray-800 rounded bottom-2 ">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" strokeinecap="round" strokeinejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></span>
            <span class="pl-2">Add Product</span>
        </Link>    
        </div>
     
        <Table  class="pt-5 border-t">
            <template #table-head>
                <tr>
                    <th>S.N</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Stocks</th>           
                    <th>Action</th>
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(product,index) in products" class="text-sm">
                    <td class="py-2">{{ index+1 }}</td>
                    <td class="py-2">{{ product.name }}</td>
                    <td class="py-2">{{ product.base_price }}</td>
                    <td class="py-2">{{ product.category.name }}</td>
                    <td class="py-2">{{ product.stock }}</td>
                   
         
                    <td class="py-2 space-x-4 ">
                        <Link :href="route('edit.product',product.id)" class="px-4 py-2 text-xs text-white bg-gray-700 rounded-3xl">Update</Link>
                            <button @click="destroy(product.id)"  class="px-4 py-2 text-xs text-white bg-red-600 rounded-3xl">Delete</button>
                    </td>
                    
                </tr>
            </template>
        </Table>
    </AuthenticatedLayout>
</template>