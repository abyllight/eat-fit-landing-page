<template>
    <div class="py-24 px-4 max-w-5xl mx-auto">

        <div
            v-if="cart.length === 0"
            class="text-center">
            <h3 class="text-xl mb-4">Корзина пуста</h3>
            <a class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 rounded-xl px-3 py-2 text-sm"
               href="/page">
                Перейти в меню
            </a>
        </div>
        <div class="flex flex-col md:flex-row justify-around items-start">
            <div class="md:w-1/2">
                <h1 v-show="cart.length > 0" class="text-xl lg:text-2xl font-semibold mb-4 md:mb-8">Корзина</h1>
                <div
                    v-for="item in cart"
                    class="border-b-2 py-3 flex items-center">
                    <img :src="'/storage/' + item.image" class="rounded w-24">
                    <div class="px-3 w-full">
                        <p class=" md:text-base font-medium leading-tight">{{ item.title }}</p>
                        <p class="text-sm mb-3"> {{ item.weight }}г </p>

                        <div class="flex justify-between items-center">
                            <div
                                class="flex items-center justify-between w-20 md:w-24">
                                <div class="cursor-pointer rounded h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center"
                                     @click="decrement(item.id)">
                                    <img src="/img/icons/remove.svg" width="20">
                                </div>

                                <span class="font-semibold md:text-lg">{{ item.q }}</span>

                                <div class="cursor-pointer rounded h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center"
                                     @click="increment(item.id)">
                                    <img src="/img/icons/add.svg" width="20">
                                </div>
                            </div>
                            <div class="font-medium md:text-lg">
                                {{ item.total }}₸
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 mt-8">

                <div class="rounded bg-gray-100 p-6">
                    <div class="mb-3">
                        <div class="mb-2">
                            <label for="first_name" class="block text-sm font-medium">Имя</label>
                            <input
                                type="text"
                                name="first_name"
                                id="first_name"
                                class="p-2 mt-1 border border-red-400 focus:border-blue-200 block w-full shadow-sm sm:text-sm rounded" />
                        </div>

                    </div>
                    <div>
                        <h4 class="font-medium text-lg mb-5">Ваш заказ</h4>
                        <div class="w-full flex items-center justify-between mb-1">
                            <p>Сумма заказа:</p>
                            <p>{{ total }}₸</p>
                        </div>
                        <div class="w-full flex items-center justify-between pb-2 mb-2 border-black border-b-2">
                            <p>Доставка:</p>
                            <p>600₸</p>
                        </div>
                        <div class="w-full text-lg font-semibold flex items-center justify-between mb-8">
                            <p>Итого:</p>
                            <p>{{ total + 600 }}₸</p>
                        </div>

                        <button
                            href="/checkout"
                            class="w-full bg-yellow-300 hover:bg-yellow-400 text-xs uppercase font-semibold py-3 rounded shadow focus:outline-none focus:shadow-outline inline-flex items-center justify-center"
                        >
                            <span>Оформить заказ</span>
                        </button>
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
            total() {
                return this.$store.getters.getTotal
            }
        },
        methods: {
            increment(id){
                this.$store.dispatch('increment', id);
            },
            decrement(id){
                this.$store.dispatch('decrement', id);
            },
        }
    }
</script>
