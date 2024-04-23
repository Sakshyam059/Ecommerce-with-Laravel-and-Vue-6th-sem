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
            <h2 class="w-fit text-2xl font-semibold  pb-3 text-gray-900">Products</h2>
            <Link :href="route('add.product')" class="absolute bottom-2 right-0 flex items-center bg-gray-800 text-white text-xs px-4 py-3 rounded ">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" strokeinecap="round" strokeinejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></span>
            <span class="pl-2">Add Product</span>
        </Link>    
        </div>
     
        <Table  class="border-t pt-5">
            <template #table-head>
                <tr>
                    <th>S.N</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Stocks</th>
                    <th>Sale</th>              
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(product,index) in products" class="text-sm">
                    <td class="py-2">{{ index+1 }}</td>
                    <td class="py-2">{{ product.name }}</td>
                    <td class="py-2">{{ product.base_price }}</td>
                    <td class="py-2">{{ product.category.name }}</td>
                    <td class="py-2">{{ product.stock }}</td>
                    <td class="py-2 w-28  ">
                        <Link v-if="product.sale" :href="route('sales.form',{id:product.id})" class="text-xs px-4 py-2 bg-amber-400 text-white  rounded-3xl">On Sale</Link>
                        <Link v-else :href="route('sales.form',{id:product.id})" class="text-xs px-4 py-2 bg-blue-600  text-white  rounded-3xl">Add to Sale</Link>
                    </td>
                    <td class="py-2 w-28   ">
                        <Link :href="route('edit.product',product.id)" class="text-xs px-4 py-2  bg-gray-700  text-white  rounded-3xl">Update</Link>
                    </td>
                    <td class="py-2 w-28   ">
                            <button @click="destroy(product.id)"  class="text-xs px-4 py-2 bg-red-600  text-white  rounded-3xl">Delete</button>
                    </td>
                    
                </tr>
            </template>
        </Table>
    </AuthenticatedLayout>
</template>