<script setup>
import Navbar from "../Components/Essentials/Navbar.vue";
import SideMenu from "../Components/Essentials/SideMenu.vue";

</script>
<template>
    <header class="fixed top-0 right-0 left-0 w-full z-10  bg-white  border-b border-gray-300/60    ">
           <Navbar />
    </header>
    <main class="relative top-20 mt-1 px-16">
        <SideMenu/>
        <article class=" absolute left-56 right-12 pl-6 py-3 ">
            <slot></slot>
        </article>
    </main>
</template>
