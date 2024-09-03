<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import { Link, router } from '@inertiajs/vue3';
const props=defineProps({
    banners:Object
})
const destroy=(id)=>{
    router.delete(route('banner.destroy',id), {preserveScroll: true})    
}
</script>
<template>
<AuthenticatedLayout>
    <section>
        <div class="flex items-center justify-between pt-2">        
            <h2 class="pb-3 text-2xl font-semibold text-gray-900 w-fit">Banners</h2>
            <div>
                <Link :href="route('banner.create')" class="px-6 py-2 text-white bg-blue-600 rounded">Add Banner</Link>
            </div>
        </div>
        <Table v-if="banners.length>0" class="pt-5 border-t">
            <template #table-head>
                <tr>
                    <th class="py-2">S.N</th>
                    <th class="py-2">Image</th>
                    <th class="py-2">Category</th>
                    <th class="py-2">Action</th>
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(banner,index) in banners" :key="banner.id" >
                    <td class="py-2">{{ index+1 }}</td>
                    <td class="py-2">
                        <img :src="'/images/banner/' + banner.image" class="object-cover h-16" alt="">
                    </td>
                    <td class="py-2">{{ banner.category.name }}</td>
                  
                    <td class="py-2 space-x-4 text-white">
                        <Link :href="route('banner.edit',{id:banner.id})" class="px-4 py-2 text-xs bg-green-600 rounded-3xl">Edit</Link>
                        <button @click="destroy(banner.id)" class="px-4 py-2 text-xs bg-red-600 rounded-3xl">Delete</button>
                    </td>
                </tr>
            </template>
        </Table>
        <div v-else class="grid text-3xl font-medium text-gray-400 min-h-80 place-items-center">
            No any Banners listed
        </div>
</section>
</AuthenticatedLayout>
</template>