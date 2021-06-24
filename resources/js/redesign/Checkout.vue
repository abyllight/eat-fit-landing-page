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
        <div
            v-else
            class="flex flex-col md:flex-row"
        >
            <div class="w-full lg:w-2/3 mb-8">
                <a
                    href="/cart"
                    class="cursor-pointer bg-yellow-300 rounded-full py-2.5 px-5 inline-flex font-medium flex items-center mb-4">
                    <img src="/img/icons/back.svg" alt="back">
                    <span>Корзина</span>
                </a>
                <h1 class="text-xl lg:text-2xl font-semibold mb-6 md:mb-10">Оформление заказа</h1>
                <div class="grid grid-cols-6 gap-6 mb-5">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name" class="block text-sm font-medium">Имя</label>
                        <input
                            id="name"
                            type="text"
                            placeholder="Амир"
                            v-model.trim="$v.name.$model"
                            :class="{ 'border-red-500': $v.name.$error }"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md" />
                        <p v-if="$v.name.$error" class="text-red-500 text-xs mt-1">Укажите имя</p>
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                        <label for="phone" class="block text-sm font-medium">Телефон</label>
                        <masked-input
                            id="phone"
                            type="tel"
                            placeholder="+7 (999) 999-99-99"
                            :class="{ 'border-red-500': !isPhoneValid }"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md"
                            v-model="phone"
                            mask="\+\7 (111) 111-11-11"
                            @input="rawVal = arguments[1]">
                        </masked-input>
                        <p v-if="!isPhoneValid" class="text-red-500 text-xs italic mt-1">Заполните телефон</p>
                    </div>

                    <div class="col-span-6 sm:col-span-5">
                        <label for="address" class="block text-sm font-medium">Адрес</label>
                        <input
                            id="address"
                            type="text"
                            v-model.trim="$v.address.$model"
                            :class="{ 'border-red-500': $v.address.$error }"
                            placeholder="Например: Кенесары 4"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md" />
                        <p v-if="$v.address.$error" class="text-red-500 text-xs mt-1">Укажите адрес</p>
                    </div>
                </div>
                <div class="mb-5">
                    <label for="time" class="block text-sm font-medium">Выберите время на завтра</label>
                    <div id="time" class="mt-3 flex flex-wrap">
                        <div
                            v-for="interval in intervals"
                            :key="interval.id"
                            @click.stop="time=interval.id"
                            class="text-sm mr-3 mb-2 hover:bg-yellow-300 cursor-pointer focus:outline-none rounded-full py-2 px-3 inline"
                            :class="interval.id === time ? active : non_active">
                            {{ interval.time }}
                        </div>
                    </div>
                </div>
                <div class="mb-8">
                    <label for="payment" class="block text-sm font-medium">Выберите способ оплаты</label>
                    <div id="payment" class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input
                                id="card"
                                v-model="payment"
                                value="card"
                                type="radio"
                                class="focus:ring-yellow-300 h-4 w-4 text-yellow-300 border-gray-300" />
                            <label for="card" class="ml-3 block text-sm text-gray-700">
                                Оплата картой на сайте
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input
                                id="kaspi_pay"
                                v-model="payment"
                                value="kaspi_pay"
                                type="radio"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                            <label for="kaspi_pay" class="ml-3 block text-sm text-gray-700">
                                Удаленная оплата Kaspi Pay
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input
                                id="cashless"
                                v-model="payment"
                                value="cashless"
                                type="radio"
                                class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" />
                            <label for="cashless" class="ml-3 block text-sm text-gray-700">
                                Безналичный расчет по договору
                            </label>
                        </div>
                    </div>
                </div>
                <button
                    @click="checkout"
                    class="w-full md:w-auto bg-yellow-300 hover:bg-yellow-400 mr-4 text-xs uppercase font-semibold px-6 py-3 rounded shadow focus:outline-none focus:shadow-outline inline-flex items-center justify-center"
                >
                    <span>Оплатить</span>
                </button>
            </div>
            <div class="md:-ml-16 lg:ml-0 lg:w-1/3">
                <div class="rounded bg-gray-100 p-6 w-full mb-3">
                    <h4 class="font-medium text-lg mb-5">Ваш заказ</h4>
                    <div class="w-full flex items-center justify-between mb-1">
                        <p>Сумма заказа:</p>
                        <p>{{ total }}₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between pb-2 mb-2 border-gray-300 border-b-2">
                        <p>Доставка:</p>
                        <p>600₸</p>
                    </div>
                    <div class="w-full text-lg font-semibold flex items-center justify-between">
                        <p>Итого:</p>
                        <p>{{ total + 600 }}₸</p>
                    </div>
                </div>
                <div
                    v-for="item in cart"
                    class="border-b-2 py-3 flex items-center">
                    <img :src="'/storage/' + item.image" class="rounded w-16">
                    <div class="pl-3 w-full">
                        <p class="text-base font-medium leading-tight">{{ item.title }}</p>
                        <p class="font-semibold text-red-400"> x{{ item.q }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from "vuex";
    import MaskedInput from 'vue-masked-input'
    import { required } from 'vuelidate/lib/validators'
    export default {
        name: "Checkout",
        components:{
            MaskedInput
        },
        data(){
            return{
                intervals: [
                    {
                        id: 0,
                        time: '07.00 - 08.00'
                    },
                    {
                        id: 1,
                        time: '08.00 - 09.00'
                    },
                    {
                        id: 2,
                        time: '09.00 - 10.00'
                    }
                ],
                time: -1,
                active: 'bg-yellow-300 shadow',
                non_active: 'bg-gray-200 hover:bg-gray-300',
                name: '',
                phone: '',
                rawVal: '',
                address: '',
                payment: 'card'
            }
        },
        computed: {
            ...mapState(['cart']),
            total() {
                return this.$store.getters.getTotal
            },
            isPhoneValid(){
                let reg = /\d+/g;
                let result = [];
                result = this.rawVal.match(reg);
                return this.rawVal.length === 0 || (result && result[0].length === 10);
            },
        },
        validations: {
            name: {
                required
            },
            address: {
                required
            }
        },
        methods: {
            checkout() {
                this.$v.$touch()
                if (this.isPhoneValid) return

                console.log(this.name, this.phone, this.address, this.time, this.payment)
            }
        }
    }
</script>
