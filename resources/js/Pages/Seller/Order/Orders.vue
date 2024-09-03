<script setup>
import Table from '@/Components/Table.vue';
import {  useForm,router } from '@inertiajs/vue3';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineProps({
    orders:Object
})
const form = useForm({});
const submit = (id) => {
    form.post(route('update-order.admin',{'order':id}),{ onSuccess: () => {
        form.reset();
        router.visit(route('orders.admin'))
    }});
};
</script>
<template>
    <AuthenticatedLayout>
        <div class="pt-2">        
            <h2 class="pb-3 text-2xl font-semibold text-gray-900 w-fit">Customer Orders</h2>
        </div>
        <Table class="pt-5 border-t">
            <template #table-head>
                <tr>
                    <th class="py-2">S.N</th>
                    <th class="py-2">Customer Id</th>
                    <th class="py-2">Product Name</th>
                    <th class="py-2">Price</th>
                    <th class="py-2">Payment Status</th>
                    <th class="py-2">Delivery Address</th>                 
                    <th class="py-2">Delivery Status</th>                 
                    <th class="py-2">Action</th>                 
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(order,index) in orders">
                    <td class="py-2">{{ index+1 }}</td>
                    <td class="py-2">{{ order.user_id }}</td>
                    <td class="py-2">{{ order.product.name }}</td>
                    <td class="py-2">{{ order.amount }}</td>
                    <td class="py-2 ">
                        <button class="px-4 py-1 text-xs text-white bg-green-600 rounded-3xl">{{order.payment_status}}</button>
                    </td>
                    <td class="py-2">{{ order.destination.address }}</td>
                    <td v-if="order.delivery_status==0" class="py-2 ">
                        <button class="px-4 py-1 text-xs text-white bg-orange-600 rounded-3xl">Pending..</button>
                    </td>
                    <td v-else class="py-2 ">
                        <button class="px-4 py-1 text-xs text-white bg-gray-700 rounded-3xl">Delivered</button>
                    </td>                  
                    <td>
                        <form @submit.prevent="submit(order.id)" method="post">
                            <button type="submit" class="px-4 py-1 text-xs text-white bg-gray-700 rounded-3xl">Mark as Delivered</button>
                        </form>
                    </td>
                </tr>
            </template>
        </Table>
    </AuthenticatedLayout>
</template>