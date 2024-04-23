<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Table.vue';
import {  Link, useForm, router } from '@inertiajs/vue3';

const props=defineProps({
    categories:Array,
    category:{
        type: Array,
        default:  []
    }
})
const form=useForm({
    name:''
})
const updateForm=useForm({
    name:props.category.name
})
const submit=()=>{
    form.post(route('category.add'),{ onSuccess: () => {
        form.reset();
        router.visit(route('categories'))
    }});
}
const update=()=>{
    updateForm.post(route('category.update',{'id':props.category.id}),{ onSuccess: () => {
        updateForm.reset();
        router.visit(route('categories'))
    }});
}
const destroy=(id)=>{
    router.delete(route('category.delete',id),{ onSuccess: () => {
        router.visit(route('categories'))
    }});    
}
</script>
<template>
    <AuthenticatedLayout>
        <div class="relative pt-2">         
            <h2 class="w-fit text-2xl font-semibold  pb-3 text-gray-900">Categories</h2>       
        </div>
        <form @submit.prevent="submit" method="post" class="flex items-center gap-3 mb-4">
                <input type="text" placeholder="category name" name="name" v-model="form.name" class="rounded text-sm py-2 w-72">
               <button type="submit" class="flex items-center bg-gray-800 text-white text-sm px-4 py-2 rounded ">
                <span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" strokeinecap="round" strokeinejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></span>
                <span class="pl-2">Add category</span>
               </button>
        </form>    

            <Table v-if="categories.length>0" class="border-t pt-5">
            <template #table-head>
                <tr>
                    <th>S.N</th>
                    <th>category Name</th>          
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </template>
            <template #table-body>
                <tr v-for="(data,index) in categories" :key="data.id">
                    <td class="py-2">{{ index+1 }}</td>
                    <td v-if="category.length==0" class="py-2">{{ data.name }}</td>
                   
                    <td v-else class="py-2 w-28   ">
                        <form method="post" @submit.prevent="update">
                            <input v-if="category.id==data.id" type="text" v-model="updateForm.name" name="name" />
                        </form>
                    </td>
                    <td class="py-2 w-28   ">
                        <Link v-if="category.length!=0 && category.id==data.id" :href="route('categories')"  class="text-xs px-4 py-2 bg-red-600  text-white  rounded-3xl">Cancel</Link>
                        <Link v-else :href="route('category.edit',data.id)"  class="text-xs px-4 py-2  bg-gray-700  text-white  rounded-3xl">Edit</Link>
                    </td>
                    <td class="py-2 w-28   ">
                        <button @click="destroy(data.id)"  class="text-xs px-4 py-2 bg-red-600  text-white  rounded-3xl">Delete</button>
                    </td>                  
                </tr>
            </template>
        </Table>
    </AuthenticatedLayout>
</template>