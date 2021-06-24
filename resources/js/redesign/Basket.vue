<template>
    <a href="/cart">
        <div v-show="totalCount > 0"
             class="lg:hidden fixed bottom-7 right-5 w-14 h-14 bg-yellow-300 rounded-full shadow-lg cursor-pointer z-30 flex justify-center items-center">
            <img src="/img/icons/cart_black.svg" alt="cart">
            <div class="rounded-full bg-black text-white w-5 h-5 absolute -top-1.5 right-0 border border-white flex justify-center items-center text-xs font-semibold">
                {{ totalCount }}
            </div>
        </div>
    </a>
</template>
<script>
    export default {
        name: 'Basket',
        data(){
            return {
                hasItem: false,
            }
        },
        computed: {
            totalCount() {
                return this.$store.state.totalCount
            }
        }
    }
</script>
