<template>
    <div class="py-24 px-4 max-w-5xl mx-auto relative text-gray-700">
        <div
            v-if="cart.length === 0"
            class="text-center">
            <h3 class="text-2xl mb-4">Корзина пуста</h3>
            <a
                href="/go"
                class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 focus:outline-none rounded-full py-2.5 px-5 inline-flex flex items-center">
                <img src="/img/icons/back.svg" alt="back">
                <span>Меню</span>
            </a>
        </div>
        <div v-else class="flex flex-col md:flex-row md:justify-around md:items-start">
            <div class="md:w-1/2">
                <a
                    href="/go"
                    class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 rounded-full py-2.5 px-5 inline-flex font-medium flex items-center mb-4">
                    <img src="/img/icons/back.svg" alt="back">
                    <span>Меню</span>
                </a>
                <h1 class="text-xl lg:text-2xl font-semibold mb-4 md:mb-8">Корзина</h1>
                <div
                    v-for="item in cart"
                    class="border-b-2 py-3 flex items-center">
                    <img :src="'https://admin.eatandchill.kz' + item.image" class="rounded w-24">
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

                                <span class="font-semibold">{{ item.q }}</span>

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
                <div
                    class="border-b-2 py-3 flex items-center">
                    <img :src="'/storage/' + cutlery.image" class="rounded w-24">
                    <div class="pl-3 w-full">
                        <div class="flex justify-between items-start">
                            <p class="text-base font-medium leading-tight">{{ cutlery.title }}</p>
                        </div>

                        <p class="text-sm mb-3"> {{ cutlery.price }}тг </p>

                        <div class="flex justify-between items-center">
                            <div
                                class="flex items-center justify-between w-20 md:w-24">
                                <div class="cursor-pointer rounded h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center"
                                     @click="decCutlery">
                                    <img src="/img/icons/remove.svg" width="20">
                                </div>

                                <span class="font-semibold">{{ cutlery.q }}</span>

                                <div class="cursor-pointer rounded h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center"
                                     @click="incCutlery">
                                    <img src="/img/icons/add.svg" width="20">
                                </div>
                            </div>
                            <div class="font-medium md:text-lg">
                                {{ cutlery.total }}₸
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 mt-8">
<!--                <div class="mb-5 rounded-md">
                    <label for="price" class="block text-sm font-medium">Промокод</label>
                    <div class="mt-1 relative rounded-md shadow text-sm">
                        <input
                            id="price"
                            v-model="promo"
                            type="text"
                            class="focus:outline-none focus:ring focus:border-blue-300 block w-full px-5 py-3 border border-gray-300 rounded-md"
                            placeholder="Введите промокод" />
                        <div class="absolute inset-y-0 right-3 flex items-center">
                            <p @click="checkPromo" v-if="!loading" class="text-xs font-semibold uppercase text-green-400 hover:text-green-500 cursor-pointer">Применить</p>
                            <div v-if="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-white h-6 w-6"></div>
                        </div>
                    </div>
                    <p v-if="error" class="text-sm text-red-500 mt-1">{{error_msg}}</p>
                </div>-->
                <div class="rounded-md bg-gray-100 py-4 px-6 text-base">
                    <h4 class="font-semibold text-lg mb-4">Ваш заказ</h4>
                    <div class="w-full flex items-center justify-between mb-1.5">
                        <p>Сумма заказа:</p>
                        <p>{{ total }}₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between mb-1.5 border-gray-300">
                        <p>Приборы:</p>
                        <p>{{cutlery.total}}₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between mb-1.5 border-gray-300">
                        <p>Промокод:</p>
                        <p>0₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between mb-1.5 border-gray-300">
                        <p>Доставка:</p>
                        <p>{{ delivery }}₸</p>
                    </div>
                    <div class="w-full font-semibold flex items-center justify-between">
                        <p>Итого:</p>
                        <p>{{ total + delivery + cutlery.total }}₸</p>
                    </div>
                </div>
                <div class="mt-5">
                    <a
                        :href="cantBuyAstana || cantBuyAlmaty || isSunday ? '#' : link"
                        :disabled="cantBuyAstana || cantBuyAlmaty || isSunday"
                        :class="[ cantBuyAstana || cantBuyAlmaty || isSunday ? disabled : activeButton ]"
                        class="w-full text-xs uppercase font-semibold py-3 rounded shadow focus:outline-none focus:shadow-outline inline-flex items-center justify-center"
                    >
                        <span>Оформить заказ на завтра</span>
                    </a>
                    <p v-if="cantBuyAstana" class="mt-2 text-sm italic font-medium text-red-500">
                        Команда EAT&FIT на Новогодних каникулах до 8го января. Оформить заявки можно 7го января и 8го утром мы доставим ваш заказ 🎄
                    </p>

                    <p v-if="cantBuyAlmaty" class="mt-2 text-sm italic font-medium text-red-500">
                        Команда EAT&FIT на Новогодних каникулах до 8го января. Оформить заявки можно 7го января и 8го утром мы доставим ваш заказ 🎄
                    </p>
                </div>
            </div>
        </div>
        <div v-if="isSunday" class="max-w-md mx-auto bg-gray-800 text-white text-sm py-4 px-4 shadow fixed bottom-6 lg:bottom-8 z-50 rounded inset-x-3">
            Команда EAT&FIT на Новогодних каникулах до 8го января. Оформить заявки можно 7го января и 8го утром мы доставим ваш заказ 🎄
        </div>
    </div>
</template>
<style scoped>
.loader {
    border-top-color: #34D399;
    -webkit-animation: spinner 1.5s linear infinite;
    animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spinner {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
<script>
import {mapGetters, mapState} from "vuex";
    export default {
        name: "Cart",
        data(){
            return{
                disabled: 'cursor-not-allowed opacity-50 bg-gray-300',
                activeButton: 'cursor-pointer opacity-100 bg-yellow-300 hover:bg-yellow-400',
                link: '/checkout',
                sunday: true,
                delivery: 600,
                promo: null,
                applied: false,
                error: false,
                error_msg: null,
                loading: false,
            }
        },
        computed: {
            ...mapState(['cart', 'cutlery']),
            ...mapGetters({city: 'getCity'}),
            total() {
                return this.$store.getters.getTotal
            },
            cantBuyAstana() {
                return new Date().getDate() >= 26 || new Date().getDate() < 7
            },
            cantBuyAlmaty() {
                return new Date().getDate() >= 26 || new Date().getDate() < 7
            },
            isSunday() {
                return new Date().getDay() === 6
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
            },
            checkPromo(){
                this.loading = true
                let self = this
                axios.get('https://back.eatandfit.kz/api/promocode/' + this.promo)
                    .then(function (response){
                        self.loading = false
                        if (!response.data.status) {
                            self.error = true
                            self.error_msg = response.data.msg
                        }
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
            incCutlery(){
                this.$store.dispatch('incCutlery');
            },
            decCutlery(){
                this.$store.dispatch('decCutlery');
            }
        }
    }
</script>
