<template>
    <a href="/checkout">
        <div v-show="totalCount > 0"
             class="lg:hidden fixed bottom-7 right-5 w-14 h-14 bg-yellow-300 rounded-full shadow-lg cursor-pointer z-30 flex justify-center items-center">
            <p class="text-lg font-semibold">{{ totalCount }}</p>
        </div>
    </a>
</template>
<script>
    export default {
        name: 'Cart',
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
