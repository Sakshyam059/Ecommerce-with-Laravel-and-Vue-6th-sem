<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Overview from './Dashboard/Partials/Overview.vue';

defineProps({
    product:Number,
    totalorders:Number,
    deliveries:Number,
    revenue:Number,
})
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <Overview :product="product" :orders="totalorders" :deliveries="deliveries" :revenue="revenue" />
    </AuthenticatedLayout>
</template>
