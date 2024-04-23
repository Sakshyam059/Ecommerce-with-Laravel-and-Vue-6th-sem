<script setup>
import Navbar from "../Components/Essentials/Navbar.vue";
import Footer from "../Components/Essentials/Footer.vue";
</script>
<template>
    <header class="fixed top-0 right-0 left-0 w-full  bg-white z-50  border-b  ">
        <Navbar />
        <slot name="category" class="relative bg-yellow-400" />
    </header>
    <main class="px-12 mt-36 min-h-96">
        <slot />
    </main>
    <Footer/>
</template>
