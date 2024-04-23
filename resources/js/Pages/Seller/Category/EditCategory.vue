<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {useForm} from "@inertiajs/vue3"
const updateForm=useForm({
    name:props.category.name
})
</script>
<template>
    <AuthenticatedLayout>
        <form action=""></form>
    </AuthenticatedLayout>
</template>