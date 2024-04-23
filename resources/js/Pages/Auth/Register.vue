<script setup>
import ContentLayout from '@/Layouts/ContentLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <ContentLayout>
        <Head title="Register" />
        <div class="w-full -mt-10 flex justify-between  border">
            <div class="w-full px-16 inline-flex items-center">
                <img :src="'./images/static/shopping.svg'" />
            </div>

        <form @submit.prevent="submit" class="w-3/4 bg-gray-100/40 border-l border-gray-200 py-10 px-14">
            <h1 class='text-center text-xl font-bold pb-2'>Welcome to <span class='text-gray-600'>Prommerce!</span></h1>
            <strong class='text-sm text-center block font-semibold  pb-2 text-stone-600'>Create Account</strong>
              
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 text-sm block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 text-sm block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Phone" />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 text-sm block w-full"
                    v-model="form.phone"
                    required
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>
            
            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 text-sm block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 text-sm block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class=" mt-4">
                        <Link
                            :href="route('login')"
                            class="block mb-4 text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Already registered?
                        </Link>

                        <button type="submit" class="py-2 bg-gray-800 text-white w-full text-center rounded border border-gray-700" >
                            Register
                        </button>
                    </div>
        </form>
        </div>
    </ContentLayout>
</template>
