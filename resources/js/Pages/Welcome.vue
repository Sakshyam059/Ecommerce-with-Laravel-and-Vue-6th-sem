<script setup>

import ContentLayout from "../Layouts/ContentLayout.vue"
import CategoryBar from "../Components/Sections/CategoryBar.vue"
import BillBoard from "../Components/Sections/BillBoard.vue"
import ProductSlider from "../Components/Sections/ProductSlider.vue"
const props=defineProps({
    cart:Object,
    products:Object,
    categories:Object,
    banners:Object,
    otherbanners:Object,
})
</script>
<template>
    <ContentLayout>
        <template #category>
            <div  class="fixed left-0 right-0 w-full border-b border-gray-800/15">
                <CategoryBar :categories="categories"/>
            </div>
        </template>
        <section v-if="banners" class="mb-6">
            <BillBoard  :banners="banners"/>
        </section>
        <section >
            <ProductSlider :products="products" heading="Trendings" />
        </section>
        <!-- <section class="grid grid-cols-2 gap-10 my-8">
                    <div class="relative flex items-center bg-gray-800 border border-gray-300 rounded" v-for="sale in othersales">
                        <aside className="w-full overflow-hidden  ">
                            <img :src="'/images/sale/'+sale.image" class="object-center w-full transition duration-500 ease-in opacity-75 h-52 hover:scale-125" />
                        </aside>

                    </div>
                    
                    
                </section>
        <section>
            <ProductSlider heading="Top Buys" :products="products"/>
        </section> -->
    </ContentLayout>
</template>