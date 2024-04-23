<script setup>
import Table from '@/Components/Table.vue';
import ContentLayout from '@/Layouts/ContentLayout.vue';
defineProps({
    orders:Object
})
</script>
<template>
    <ContentLayout>
        <div class="-mt-10">        
            <h2 class="w-fit text-2xl font-semibold  pb-3 text-gray-900">My Orders</h2>
        </div>
        <Table class="border-t pt-5">
            <template #table-head>
                <tr>
                    <th class="py-2">S.N</th>
                    <th class="py-2">Product Name</th>
                    <th class="py-2">Price</th>
                    <th class="py-2">Payment Status</th>
                    <th class="py-2">Delivery Address</th>                 
                    <th class="py-2">Delivery Status</th>                 
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(order,index) in orders">
                    <td class="py-2">{{ index+1 }}</td>
                    <td class="py-2">{{ order.product.name }}</td>
                    <td class="py-2">{{ order.amount }}</td>
                    <td class="py-2 ">
                        <button class="px-4 py-1 bg-green-600 text-xs text-white  rounded-3xl">{{order.payment_status}}</button>
                    </td>
                    <td class="py-2">{{ order.destination.address }}</td>
                    <td v-if="order.delivery_status==0" class="py-2  ">
                        <button class="px-4 py-1 bg-orange-600 text-xs text-white  rounded-3xl">Pending..</button>
                    </td>
                    <td v-else class="py-2  ">
                        <button class="px-4 py-1 bg-gray-700 text-xs text-white  rounded-3xl">Delivered</button>
                    </td>                  
                </tr>
            </template>
        </Table>
    </ContentLayout>
</template>