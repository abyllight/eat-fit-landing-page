<template>
    <div class="py-24 px-4 max-w-5xl mx-auto">
        <div
            v-if="cart.length === 0"
            class="text-center">
            <h3 class="text-2xl mb-4">Корзина пуста</h3>
            <a
                href="/page"
                class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 focus:outline-none rounded-full py-2.5 px-5 inline-flex flex items-center">
                <img src="/img/icons/back.svg" alt="back">
                <span>Меню</span>
            </a>
        </div>
        <div v-else class="flex flex-col md:flex-row md:justify-around md:items-start">
            <div class="md:w-1/2">
                <a
                    href="/page"
                    class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 rounded-full py-2.5 px-5 inline-flex font-medium flex items-center mb-4">
                    <img src="/img/icons/back.svg" alt="back">
                    <span>Меню</span>
                </a>
                <h1 class="text-xl lg:text-2xl font-semibold mb-4 md:mb-8">Корзина</h1>
                <div
                    v-for="item in cart"
                    class="border-b-2 py-3 flex items-center">
                    <img :src="'/storage/' + item.image" class="rounded w-24">
                    <div class="pl-3 w-full">
                        <div class="flex justify-between items-start">
                            <p class="text-base font-medium leading-tight">{{ item.title }}</p>
                            <button type="button" class="-mt-2 text-red-500 hover:text-red-600 focus:outline-none" @click="remove(item)">
                                <svg class="h-6 w-6 fill-current">
                                    <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                                </svg>
                            </button>
                        </div>

                        <p class="text-sm mb-3"> {{ item.price }}тг </p>

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
                    <h4 class="font-medium text-lg mb-5">Ваш заказ</h4>
                    <div class="w-full flex items-center justify-between mb-1">
                        <p>Сумма заказа:</p>
                        <p>{{ total }}₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between pb-2 mb-2 border-gray-300 border-b-2">
                        <p>Доставка:</p>
                        <p>600₸</p>
                    </div>
                    <div class="w-full text-lg font-semibold flex items-center justify-between mb-8">
                        <p>Итого:</p>
                        <p>{{ total + 600 }}₸</p>
                    </div>

                    <div>
                        <a
                            :href="!isEleven ? link : '#'"
                            :disabled="isEleven"
                            :class="[ isEleven ? disabled : activeButton ]"
                            class="w-full text-xs uppercase font-semibold py-3 rounded shadow focus:outline-none focus:shadow-outline inline-flex items-center justify-center"
                        >
                            <span>Оформить заказ на завтра</span>
                        </a>
                        <p v-if="isEleven" class="mt-2 text-sm italic font-medium text-red-500">
                            Прием заказов осуществляется только до 22:00
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";
    export default {
        name: "Cart",
        data(){
            return{
                disabled: 'cursor-not-allowed opacity-50 bg-gray-300',
                activeButton: 'cursor-pointer opacity-100 bg-yellow-300 hover:bg-yellow-400',
                link: '/checkout'
            }
        },
        computed: {
            ...mapState(['cart']),
            total() {
                return this.$store.getters.getTotal
            },
            isEleven() {
                return new Date().getHours() >= 22
            }
        },
        methods: {
            increment(id){
                this.$store.dispatch('increment', id);
            },
            decrement(id){
                this.$store.dispatch('decrement', id);
            },
            remove(item){
                this.$store.dispatch('removeFromCart', item);
            }
        }
    }
</script>
