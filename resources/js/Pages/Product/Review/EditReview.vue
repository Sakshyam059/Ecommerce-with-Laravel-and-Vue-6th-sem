<script setup>
import { useForm } from '@inertiajs/vue3';

import { computed } from 'vue';
import { ref } from 'vue';

import StarRating from 'vue-star-rating'

const props = defineProps({
    product_id:Number,
    myreview:Object,
    showReviewForm:Function,
})

const rating =ref(props.myreview.rating)

const calculatedRating= computed(() => {
    let star =rating.value;
    return star;
})
const reviewform=useForm({
    product_id:props.product_id,
    rating:calculatedRating,
    review:props.myreview.review,
})
const submit=()=>{
    reviewform.post(route('review.add'));
    props.showReviewForm();
}
</script>
<template>
    <form @submit.prevent="submit" class="mb-6  px-6">
            <div class="my-4">
                <h3 class="font-medium mb-2">Ratings</h3>  
                <star-rating v-model:rating="rating"  :show-rating="false" :padding="10"></star-rating>
            </div>
            <div class="mt-4">
                <h3 class="font-medium my-2">Review Description</h3>
                <textarea
                    class="w-full p-6 my-2 rounded"
                    placeholder="Write a review"
                    rows="4"
                    name="review"
                    v-model="reviewform.review"
                ></textarea>
            </div>
            <div class="flex justify-end mb-4">
                <button type="submit"  class="bg-blue-600 px-4 py-2 text-white rounded mr-2">
                    Post
                </button>
                <button @click="showReviewForm()" class=" bg-gray-50 border border-gray-200 px-4 py-2  rounded">
                    Cancel
                </button>
            </div>
        </form>
</template>