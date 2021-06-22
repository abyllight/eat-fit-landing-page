<template>
    <div class="py-24">
        <div class="max-w-2xl mx-auto px-4">
            <h1 v-show="cart.length > 0" class="text-xl lg:text-2xl font-semibold mb-8">Корзина</h1>

            <div
                v-if="cart.length === 0"
                class="text-center">
                <h3 class="text-xl mb-4">Корзина пуста</h3>
                <a class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 rounded-xl px-3 py-2 text-sm"
                href="/page">
                    Перейти в меню
                </a>
            </div>
            <div
                v-else
                class=""
            >
                <div
                    v-for="item in cart"
                    class="border-b-2 py-3 flex items-center"
                    >
                    <img :src="'/storage/' + item.image" class="rounded w-16 md:w-20">
                    <div class="px-3 w-full">
                        <p class="text-sm md:text-base font-semibold leading-tight">{{ item.title }}</p>
                        <p class="text-sm mb-3"> {{ item.weight }}г </p>

                        <div class="flex justify-between items-center">
                            <div
                                class="flex items-center justify-between w-20 md:w-24">
                                <div class="cursor-pointer rounded-lg h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center"
                                     @click="decrement">
                                    <img src="/img/icons/remove.svg" width="20">
                                </div>

                                <span class="font-semibold md:text-lg">{{ item.q }}</span>

                                <div class="cursor-pointer rounded-lg h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center"
                                     @click="increment">
                                    <img src="/img/icons/add.svg" width="20">
                                </div>
                            </div>
                            <div class="font-semibold md:text-lg">
                                4000₸
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";
    export default {
        name: "Checkout",
        data(){
            return{

            }
        },
        computed: {
            ...mapState(['cart']),
        },
        methods: {
            increment(){
                this.$store.commit('increment', this.data);
                this.count++
            },
            decrement(){
                if (this.count > 1) {
                    this.$store.commit('decrement', this.data);
                    this.count--
                }else {
                    console.log('remove')
                    this.$store.commit('removeFromCart', this.data);
                    console.log(this.data)
                }
            }
        }
    }
</script>
