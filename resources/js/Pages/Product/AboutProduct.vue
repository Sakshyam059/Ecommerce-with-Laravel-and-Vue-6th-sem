<script setup>
import { Link } from "@inertiajs/vue3";
import ContentLayout from "@/Layouts/ContentLayout.vue";
import StarRating from "vue-star-rating";
// import ProductSpecification from "./Partials/ProductSpecification.vue";
import CustomerReviews from "./Review/CustomerReviews.vue";
import { computed, ref, toRefs } from "vue";
import { useCartStore } from "@/Pages/Cart/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const props = defineProps({
    product: Object,
    myreview: Object,
    reviews: Object,
});

const stock = () => {
    if (props.product.stock > 0) {
        return true;
    } else {
        return false;
    }
};
let availability = ref(stock());

const { product } = toRefs(props);

const addToCart = (product) => {
    let price = cartStore.priceLimit() + product.total_price;
    if (price > 0 && price <= 1000) {
        cart.value.push({
            product_id: product.id,
            total_price: product.total_price,
        });
    }
};
const isAlreadyInCart = computed(() => {
    let res = cart.value.find((c) => c.product_id === product.value.id);
    if (res) return true;
    return false;
});
</script>
<template>
    <ContentLayout>
        <div class="grid grid-cols-2 gap-10 mb-4">
            <img :src="'/images/product/' + product.image" class="object-cover w-2/3 mx-auto" />
            <div class="">
                <h1 class="pt-8 text-3xl font-extrabold">
                    {{ product.name }}
                </h1>
                <h4 class="py-2 text-sm text-gray-900">
                    <span class="font-medium">Category &gt; </span>
                    <Link
                        :href="
                            route('category.product', {
                                name: product.category.name,
                            })
                        "
                        class="text-blue-600"
                        >{{ product.category.name }}</Link
                    >
                </h4>
                <div class="py-1">
                    <star-rating
                        :rating="product.rating"
                        :read-only="true"
                        :show-rating="false"
                        :padding="10"
                    ></star-rating>

                    <h4
                        v-if="availability"
                        class="mt-6 mb-3 text-sm font-semibold text-green-600"
                    >
                        In stock*
                    </h4>
                    <h4
                        v-else
                        class="mt-6 mb-3 text-sm font-semibold text-red-600"
                    >
                        Out of stock*
                    </h4>

                    <strong class="flex items-center gap-2 font-bold">
                        <span class="text-2xl"
                        >Rs {{ product.total_price }}</span
                        >
                        <span class="text-red-600 line-through">Rs  {{ product.base_price }}</span>
                    </strong>
                    <!--<Ratings />-->
                    <p class="py-4 text-sm text-stone-400">
                       {{product.description}}
                    </p>
                    <!-- <OrderQuantity /> -->
                </div>
                <div class="flex items-center justify-between gap-6">
                    <button
                        :disabled="isAlreadyInCart"
                        class="w-full py-3 my-2 text-sm text-white border rounded"
                        :class="
                            isAlreadyInCart
                                ? 'bg-gray-800 '
                                : 'bg-orange-500 border-orange-800'
                        "
                        @click="addToCart(product)"
                    >
                        {{ isAlreadyInCart ? "Added to Cart" : "Add to Cart" }}
                    </button>
                </div>
            </div>

            <!-- <button
                type="submit"
                class="w-full py-3 text-sm text-gray-800 border border-gray-800 rounded"
            >
                Order Now
            </button> -->
        </div>
        <!-- <ProductSpecification /> -->
        <CustomerReviews
            :product_id="product.id"
            :myreview="myreview"
            :reviews="reviews"
        />
    </ContentLayout>
</template>
