<script setup>

import ContentLayout from "../Layouts/ContentLayout.vue"
import CategoryBar from "../Components/Sections/CategoryBar.vue"
import BillBoard from "../Components/Sections/BillBoard.vue"
import ProductSlider from "../Components/Sections/ProductSlider.vue"
const props=defineProps({
    cart:Object,
    products:Object,
    categories:Object,
    sales:Object,
    othersales:Object,
})
</script>
<template>
    <ContentLayout>
        <template #category>
            <div  class="w-full fixed left-0 right-0  border-b border-gray-800/15">
                <CategoryBar :categories="categories"/>
            </div>
        </template>
        <section v-if="sales" class="mb-6">
            <BillBoard :products="products" :sales="sales"/>
        </section>
        <section >
            <ProductSlider :products="products" heading="Trending Sales" />
        </section>
        <section class="my-8  grid grid-cols-2  gap-10">
                    <div class="relative bg-gray-800 flex items-center border border-gray-300 rounded" v-for="sale in othersales">
                        <aside className="w-full overflow-hidden  ">
                            <img :src="'/images/sale/'+sale.image" class="opacity-75 object-center w-full h-52 hover:scale-125 transition ease-in duration-500" />
                        </aside>
                        <div class="absolute  text-white left-8 font-bold">
                            <small class="text-xl">Save upto {{sale.product.discount}}% off</small>
                            <h3 class="text-4xl font-extrabold py-3">{{ sale.product.name }}</h3>
                            <button class="px-8 py-2 my-1 bg-gray-800 text-white rounded-md">Shop now</button>
                        </div>
                    </div>
                    
                    
                </section>
        <section>
            <ProductSlider heading="Top Buys" :products="products"/>
        </section>
    </ContentLayout>
</template>../Components/Sections/CategoryBar.vue