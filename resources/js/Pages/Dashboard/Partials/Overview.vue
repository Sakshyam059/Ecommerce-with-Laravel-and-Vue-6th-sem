<script setup>
defineProps({
    product:Number,
    orders:Number,
    deliveries:Number,
    revenue:Number,
})
</script>
<template>
    <h2 class="text-xl font-semibold tracking-wide my-2">Overview</h2>
   <div class='grid grid-cols-4 gap-6 my-4 '>
        <div class='bg-gray-100 py-3 px-6 rounded border border-gray-200'>
            <h1>Total Products</h1>
            <strong>{{product}}</strong>
        </div>
        <div class='bg-gray-100 py-3 px-6 rounded border border-gray-200'>
            <h1>Total Orders</h1>
            <strong>{{orders}}</strong>
        </div>
        <div class='bg-gray-100 py-3 px-6 rounded border border-gray-200'>
            <h1>Pending Deliveries</h1>
            <strong>{{deliveries}}</strong>
        </div>
       
        <div class='bg-gray-100 py-3 px-6 rounded border border-gray-200'>
            <h1>Total Revenue</h1>
            <strong>{{ revenue }}</strong>
        </div>
    </div>
</template>