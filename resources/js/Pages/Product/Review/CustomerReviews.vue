<script>
import WriteReview from './WriteReview.vue';
import EditReview from './EditReview.vue';
import StarRating from 'vue-star-rating'
import { Link, router, usePage } from '@inertiajs/vue3';

export default {
    components:{
        WriteReview,
        EditReview,
        StarRating
    },
    props:{
        product_id:Number,
        reviews:Object,
        myreview:Object
    },
    data() {
        return {
            reviewForm: false,
            user:usePage().props.auth.user
        };
    },
    methods: {
        showReviewForm() {
            this.reviewForm= !this.reviewForm;
        },
        destroy(id){
            router.delete(route('review.delete',this.myreview.id),{preserveScroll:true})
        }
    },
};
</script>
<template>
    <div class="border mb-6 pt-5">
        <div class="flex justify-between items-center px-5 pb-5">
            <h2>
                <strong class="block text-2xl font-bold">Reviews</strong>
                <small>Based on 100+ reviews</small>
            </h2>
            <button v-if="!myreview" type="button" @click="showReviewForm()" class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm">
                Write Review
            </button>
        </div>
        <div v-if="user && reviewForm">
            <EditReview v-if="myreview" :product_id="product_id" :showReviewForm="showReviewForm" :myreview="myreview" />
            <WriteReview v-else :product_id="product_id" :showReviewForm="showReviewForm" :myreview="myreview" />
        </div>
       
        <div v-if="user && myreview" class="flex justify-between items-center gap-4 py-5  border-y mt-3 px-5">
            <div class="w-7/12  flex items-center gap-2">
                <img v-if="user.image" :src="'/images/profile/'+user.image" class="w-10 h-10 rounded-full object-cover  inline-flex items-center cursor-pointer">
                <div v-else class="w-10 h-10  inline-flex justify-center items-center">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="cursor-pointer stroke-gray-700" width="26" height="26" viewBox="0 0 24 24" fill="none"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
                </div>
                <p class="block text-sm text-orange-600  tracking-wide">
                    <span class="font-semibold">Sakshyam Dev</span>
                    <small class="block text-gray-700 font-medium">On 10 Jan, 2023</small>
                </p>
            </div>
            <div class="w-full overflow-hidden">
            <star-rating :rating="myreview.rating" :star-size="12" :show-rating="false" :padding="10"></star-rating>
            <article class="block text-sm text-stone-800">
               {{myreview.review}}
            </article>
            </div>
            <div class="w-1/2 flex gap-4 justify-end">
                <button @click="showReviewForm()" class="text-blue-700 font-medium text-sm">Edit</button>
                <button @click="destroy(myreview.id)" class="text-red-700 font-medium text-sm">Delete</button>
            </div>
        </div>
        <div v-for="review in reviews" class="flex justify-between items-center gap-4  border-y  odd:bg-gray-50 p-5">
            <div class="w-7/12  flex items-center gap-2">
                <img v-if="user.image" :src="'/images/profile/'+user.image" class="w-10 h-10 rounded-full object-cover  inline-flex items-center cursor-pointer">                          
                <div v-else class="w-10 h-10  inline-flex justify-center items-center">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="cursor-pointer stroke-gray-700" width="26" height="26" viewBox="0 0 24 24" fill="none"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5.52 19c.64-2.2 1.84-3 3.22-3h6.52c1.38 0 2.58.8 3.22 3"/><circle cx="12" cy="10" r="3"/><circle cx="12" cy="12" r="10"/></svg>
                </div>
                <p class="block text-sm text-orange-600  tracking-wide">
                    <span class="font-semibold">Sakshyam Dev</span>
                    <small class="block text-gray-700 font-medium">On 10 Jan, 2023</small>
                </p>
            </div>
            <div class="w-full  -mt-2 overflow-hidden">
                <star-rating :rating="review.rating" :star-size="12" :show-rating="false" :padding="10"></star-rating>
                <article class="block text-sm text-stone-800">
                   {{review.review}} 
                </article>
            </div>
            <div class="w-1/2 flex justify-end">
                <a href="" class="text-blue-600"><small>Report as inappropriate</small></a>
            </div>
        </div>
    </div>
</template>
