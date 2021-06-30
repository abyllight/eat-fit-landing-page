<template>
    <a href="/cart">
        <div v-show="totalCount > 0" class="lg:hidden px-4 fixed bottom-8 z-30 inset-x-0 mx-auto">
            <div class="p-4 w-full bg-yellow-300 rounded shadow cursor-pointer flex justify-between items-center font-medium">
                <div class="mr-4 flex items-center">
                    <img src="/img/icons/cart_black.svg" alt="cart" width="18" class="mr-2">
                    <p>Корзина: {{ totalCount }}шт</p>
                </div>

                <p class="">{{ total }}₸</p>
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
            },
            total() {
                return this.$store.getters.getTotal
            }
        }
    }
</script>
