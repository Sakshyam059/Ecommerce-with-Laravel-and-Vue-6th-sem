<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    image: '',
    phone: 'aaa',
});


const fileInput=ref(null);
const profile_img=ref('/images/profile/'+user.image);


const getImage = (event) => {
    form.image = event.target.files[0];
    profile_img.value=URL.createObjectURL(form.image);
};
</script>

<template>
    <section>
       
        <form @submit.prevent="form.post(route('profile.update'))" method="post" class=" space-y-6 ">
            <div class="flex justify-between gap-16">
                <div class="w-2/3 bg-gray-50/20 border border-gray-400/40 mb-6  rounded-md">
                    <div v-if="profile_img" class="w-full">
                        <label class="w-full flex flex-col items-center p-3 bg-white text-blue rounded-lg tracking-wide uppercase  cursor-pointer hover:bg-blue hover:text-blue-600">
                            <img v-if="form.image||user.image"  :src="profile_img&&profile_img" class="h-56 bg-emerald-300"/>
                               
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="w-full h-full p-14" viewBox="0 0 24 24" fill="none" stroke="#838383" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
                        
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                    <div v-else class="flex w-full items-center  bg-grey-lighter">
                        <label class="w-full flex flex-col items-center px-4  py-14 bg-white text-blue rounded-lg tracking-wide uppercase  cursor-pointer hover:bg-blue hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <span class="mt-6 text-sm leading-normal">Choose a picture</span>
                            <input type='file' ref="fileInput" class="hidden" name="image" @change="getImage"/>
                        </label>
                    </div>
                </div>
                <div class="w-full">
                    <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
                
                
                <div class="my-4">
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>
            <div class="flex items-center gap-4 mt-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
            </div>
            </div>

        </form>
    </section>
</template>
