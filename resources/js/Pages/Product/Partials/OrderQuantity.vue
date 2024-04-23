<template>
    <form>
        <strong class="text-sm text-gray-800/80 mr-4">Order Quantitiy</strong>
        <div class=" w-fit inline-flex border mt-2 mb-6 border-black/50">
            <button type="button"
                class="bg-gray-100 px-3 border-r border-black"
                @click="decreaseCount"
            >
                -
            </button>
            <input
                type="text"                
                class="block w-16 h-8 text-center border-0"
                v-bind:value="count"
            />
            <button type="button" class="bg-gray-100 px-3 border-l border-black" @click="increaseCount">+</button>
        </div>
        <div class="flex justify-between items-center gap-6">

            <button
                class="w-full  bg-orange-500 border border-orange-800 text-white text-sm py-3  my-2 rounded"
            >
                Add to Cart
            </button>
            <button
                type="submit"
                class="w-full  text-gray-800 border border-gray-800 text-sm py-3  rounded"
            >
                Order Now
            </button>
        </div>
    </form>
</template>
<script>
export default {
    data() {
        return {
            count: 0,
            increase: "Increase Count",
            decrease: "Decrease Count",
        };
    },
    methods: {
        increaseCount() {
            this.count++;
        },
        decreaseCount() {
            if (this.count <= 0) {
                this.count = 0;

                
            } else {
                this.count--;
            }
        },
    },
};
</script>
