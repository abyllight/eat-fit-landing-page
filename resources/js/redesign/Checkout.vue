<template>
    <div class="py-24 px-4 max-w-5xl mx-auto relative">
        <div
            v-if="cart.length === 0"
            class="text-center">
            <h3 class="text-xl mb-4">Корзина пуста</h3>
            <a
                href="/page"
                class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 focus:outline-none rounded-full py-2.5 px-5 inline-flex flex items-center">
                <img src="/img/icons/back.svg" alt="back">
                <span>Меню</span>
            </a>
        </div>
        <div
            v-else
            class="flex flex-col md:flex-row"
        >
            <div class="w-full lg:w-2/3 mb-8">
                <a
                    href="/cart"
                    class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 rounded-full py-2.5 px-5 inline-flex font-medium flex items-center mb-4">
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
                            :disabled="isEleven"
                            v-model.trim="$v.name.$model"
                            :class="{ 'border-red-500': $v.name.$error }"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md" />
                        <p v-if="$v.name.$error" class="text-red-500 text-xs mt-1">Укажите имя</p>
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                        <label for="phone" class="block text-sm font-medium">Телефон</label>
                        <input
                            id="phone"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md"
                            type="tel"
                            placeholder="+7 (999) 999-99-99"
                            :disabled="isEleven"
                            v-model.trim="$v.phone.$model"
                            :class="{ 'border-red-500': $v.phone.$error }"
                            v-mask="'+7 (###) ###-##-##'"
                        />
                        <p v-if="$v.phone.$error" class="text-red-500 text-xs mt-1">Заполните телефон</p>
                    </div>

                    <div class="col-span-6 sm:col-span-5">
                        <label for="address" class="block text-sm font-medium">Адрес</label>
                        <input
                            id="address"
                            type="text"
                            v-model.trim="$v.address.$model"
                            :class="{ 'border-red-500': $v.address.$error }"
                            placeholder="Например: Кенесары 4"
                            :disabled="isEleven"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md" />
                        <p v-if="$v.address.$error" class="text-red-500 text-xs mt-1">Укажите адрес</p>
                    </div>
                </div>
                <div
                    class="mb-5 inline-block rounded"
                    :class="{ 'border border-red-500': time < 0 }"
                >
                    <label for="time" class="block text-sm font-medium">Выберите время на завтра</label>
                    <div id="time" class="mt-3 flex flex-wrap">
                        <button
                            v-for="interval in intervals"
                            :key="interval.id"
                            :disabled="isEleven"
                            @click.stop="time=interval.id"
                            class="text-sm mr-3 mb-2 cursor-pointer focus:outline-none rounded-full py-2 px-3 inline"
                            :class="[interval.id === time ? active : non_active, isEleven ? disabled : activeButtonTime]">
                            {{ interval.time }}
                        </button>
                    </div>
                    <p v-if="time < 0" class="text-red-500 text-xs mt-1">Выберите время</p>
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
                        <div v-if="!isSix" class="space-y-4">
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
                </div>
                <div class="flex flex-col md:flex-row">
                    <button
                        @click="checkout"
                        class="w-full md:w-auto mr-4 text-xs uppercase font-semibold px-8 py-3 rounded shadow focus:outline-none focus:shadow-outline text-center"
                        :disabled="isEleven"
                        :class="[ isEleven ? disabled : activeButton ]"
                    >
                        Оплатить
                    </button>
                    <p v-if="isEleven" class="mt-2 text-sm italic font-medium">
                        Прием заказов осуществляется только до 22:00
                    </p>
                </div>
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
        <success-modal :showSuccess="showSuccess" @close="showSuccess=false"></success-modal>
        <fail-modal :showFail="showFail" @close="showFail=false"></fail-modal>
        <div v-if="isLoading" class="h-screen w-full bg-black opacity-75 fixed top-0 left-0 z-50 flex flex-col items-center justify-center">
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-white h-16 w-16 mb-4"></div>
            <h2 class="text-center text-white text-xl font-semibold">Идет обработка заказа...</h2>
        </div>
    </div>
</template>

<style scoped>
    .loader {
        border-top-color: #FCD34D;
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
    import {mapState} from "vuex";
    import {TheMask} from 'vue-the-mask'
    import { required, minLength } from 'vuelidate/lib/validators'
    import SuccessModal from "./SuccessModal";
    import FailModal from "./FailModal";

    export default {
        name: "Checkout",
        components:{
            TheMask,
            SuccessModal,
            FailModal
        },
        data(){
            return {
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
                time: 100,
                active: 'bg-yellow-300 shadow',
                non_active: 'bg-gray-200 hover:bg-gray-300',
                name: 'Abylay TEST',
                phone: '+7 (111) 111-11-20',
                address: 'Kenesary 4',
                payment: 'card',
                disabled: 'cursor-not-allowed opacity-50 bg-gray-300',
                activeButton: 'cursor-pointer opacity-100 bg-yellow-300 hover:bg-yellow-400',
                activeButtonTime: 'cursor-pointer opacity-100 hover:bg-yellow-400',
                showSuccess: false,
                showFail: false,
                isLoading: false,
            }
        },
        computed: {
            ...mapState(['cart']),
            total() {
                return this.$store.getters.getTotal
            },
            wholesale() {
                return this.$store.getters.getWholesale
            },
            isSix() {
                return new Date().getHours() >= 18
            },
            isEleven() {
                return new Date().getHours() >= 22
            }
        },
        validations: {
            name: {
                required
            },
            address: {
                required
            },
            phone: {
                required,
                minLength: minLength(18)
            }
        },
        methods: {
            checkout() {
                this.$v.$touch()

                if (this.$v.$invalid || this.time === 100) {
                    if (this.time === 100) this.time = -1
                    return
                }

                if (this.payment === 'card') {
                    const widget = new cp.CloudPayments();
                    let self = this
                    widget.pay('auth', // или 'charge'
                        { //options
                            publicId: 'pk_114ea6d38b2d3467a650ea5c71d76', //id из личного кабинета
                            description: 'Оплата товаров в eatandfit.kz', //назначение
                            amount: 5, //сумма
                            currency: 'KZT', //валюта
                            skin: "modern", //дизайн виджета (необязательно)
                            data: {
                                cart: this.cart
                            }
                        },
                        {
                            onSuccess: function (options) { // success
                                self.amoRequest()
                            },
                            onFail: function (reason, options) { // fail
                                //действие при неуспешной оплате
                                console.log(reason,options,'fail')
                            },
                            onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
                                //например вызов вашей аналитики Facebook Pixel
                            }
                        }
                    )
                }else {
                    this.amoRequest()
                }
            },
            amoRequest() {
                this.isLoading = true;
                let self = this;
                axios.post('/checkout', {
                    name: this.name,
                    phone: this.phone,
                    address: this.address,
                    time: this.intervals[this.time].time,
                    payment: this.payment,
                    cart: this.cart,
                    total: this.total,
                    wholesale: this.wholesale
                }).
                then(function (response) {
                    self.showSuccess = true
                    self.$store.dispatch('clearCart');
                    self.loading = false
                    console.log(response)
                    self.isLoading = false
                }).
                catch(function(error){
                    self.showFail = true
                    console.log(error, 'erro from eatfitgo');
                    self.isLoading = false
                });
            },
        }
    }
</script>
