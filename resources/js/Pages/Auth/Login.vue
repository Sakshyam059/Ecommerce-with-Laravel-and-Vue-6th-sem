<script setup>
import ContentLayout from '@/Layouts/ContentLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
        <Head title="Log in" />
<ContentLayout>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="w-full -mt-10 flex justify-between  border">
            <div class="w-full px-16 inline-flex items-center">
                <img :src="'./images/static/shopping.svg'" />
            </div>
            <form @submit.prevent="submit" class="w-3/4 bg-gray-100/40 border-l border-gray-200 py-10 px-14">
            <h1 class="text-center text-xl font-bold pb-2">
                        Welcome to
                        <span class="text-gray-800">Prommerce!</span>
                    </h1>
                    <strong class="text-center block text-sm font-semibold  pb-6 text-stone-600">
                        Login to your Account
                    </strong>
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class=" mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="block mb-4 text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <button class="py-2 mb-4 bg-gray-800 text-white w-full text-center rounded border border-gray-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </button>
                <Link
                            :href="route('register')"
                            className="block  text-sm text-center text-gray-600 hover:text-gray-900 rounded-md focus:outline-none "
                        >
                            <span>No account yet?</span>&nbsp;
                            <span>Create an account</span>
                        </Link>
            </div>
        </form>
        </div>
        </ContentLayout>
</template>
