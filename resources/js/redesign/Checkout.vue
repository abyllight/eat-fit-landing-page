<template>
    <div class="py-24 px-4 max-w-5xl mx-auto relative">
        <div
            v-if="cart.length === 0"
            class="text-center">
            <h3 class="text-xl mb-4">Корзина пуста</h3>
            <a
                href="/go"
                class="cursor-pointer bg-yellow-300 hover:bg-yellow-400 focus:outline-none rounded-full py-2.5 px-5 inline-flex flex items-center">
                <img src="/img/icons/back.svg" alt="back">
                <span>Меню</span>
            </a>
        </div>
        <div

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
                            placeholder="Имя"
                            :disabled="isEleven || isSunday"
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
                            :disabled="isEleven || isSunday"
                            v-model.trim="$v.phone.$model"
                            :class="{ 'border-red-500': $v.phone.$error }"
                            v-mask="'+7 (###) ###-##-##'"
                        />
                        <p v-if="$v.phone.$error" class="text-red-500 text-xs mt-1">Заполните телефон</p>
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                        <label for="address" class="block text-sm font-medium">Город</label>
                        <select
                            id="address"
                            :disabled="isSunday"
                            @change="setCity"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md"
                        >
                            <option
                                :selected="city === c.id"
                                v-for="c in cities"
                                :key="c.id"
                                :value="c.id"
                            >
                                {{c.name}}
                            </option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="address" class="block text-sm font-medium">Адрес</label>
                        <input
                            id="address"
                            type="text"
                            v-model.trim="$v.address.$model"
                            :class="{ 'border-red-500': $v.address.$error }"
                            placeholder="Например: Сыганак-10, кв17, п2, э4"
                            :disabled="isEleven || isSunday"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md" />
                        <p v-if="$v.address.$error" class="text-red-500 text-xs mt-1">Укажите адрес</p>
                    </div>

<!--                    <div class="col-span-6 sm:col-span-5">
                        <label for="promocode" class="block text-sm font-medium">Промокод</label>
                        <input
                            id="promocode"
                            type="text"
                            v-model="promocode"
                            placeholder="Опционально"
                            :disabled="isEleven || isSunday"
                            class="mt-1 p-2.5 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm border-gray-300 rounded-md" />
                    </div>-->
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
                            :disabled="isEleven || isSunday"
                            @click.stop="time=interval.id"
                            class="text-xs md:text-sm mr-2 mb-2 cursor-pointer focus:outline-none rounded-full py-2 px-3 inline"
                            :class="[interval.id === time ? active : non_active, isEleven || isSunday ? disabled : activeButtonTime]">
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
                <div class="flex flex-col md:flex-row">
                    <button
                        @click="checkout"
                        class="w-full md:w-auto mr-4 text-xs uppercase font-semibold px-8 py-3 h-10 rounded shadow focus:outline-none focus:shadow-outline text-center"
                        :disabled="isEleven || isSunday || cantBuyByPrice"
                        :class="[ isEleven || isSunday || cantBuyByPrice ? disabled : activeButton ]"
                    >
                        Заказать
                    </button>
                    <div>
                        <p v-if="cantBuyAstana" class="mt-2 text-sm italic font-medium text-red-500">
                            Прием заказов по Астане осуществляется только c 10:00 до 18:00
                        </p>

                        <p v-if="cantBuyAlmaty" class="mt-2 text-sm italic font-medium text-red-500">
                            Прием заказов по Алмате осуществляется только c 10:00 до 21:00
                        </p>

                        <p v-if="cantBuyByPrice && city === 1" class="mt-2 text-sm italic font-medium text-red-500">
                            Минимальная сумма заказа для наших партнеров 10 000 тенге
                        </p>
                    </div>
                </div>
            </div>
            <div class="md:-ml-16 lg:ml-0 lg:w-1/3">
                <div class="rounded bg-gray-100 p-6 w-full mb-3">
                    <h4 class="font-medium text-lg mb-5">Ваш заказ</h4>
                    <div class="w-full flex items-center justify-between mb-1">
                        <p>Сумма заказа:</p>
                        <p>{{ totalPrice }}₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between mb-1.5 border-gray-300">
                        <p>Приборы:</p>
                        <p>{{cutlery.total}}₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between mb-1.5 border-gray-300">
                        <p>Промокод:</p>
                        <p>0₸</p>
                    </div>
                    <div class="w-full flex items-center justify-between pb-2 mb-2 border-gray-300 border-b-2">
                        <p>Доставка:</p>
                        <p>{{delivery}}₸</p>
                    </div>
                    <div class="w-full text-lg font-semibold flex items-center justify-between">
                        <p>Итого:</p>
                        <p>{{ totalPrice + delivery + cutlery.total }}₸</p>
                    </div>
                </div>
                <div
                    v-for="item in cart"
                    class="border-b-2 py-3 flex items-center">
                    <img :src="'https://admin.eatandchill.kz' + item.image" class="rounded w-16">
                    <div class="pl-3 w-full">
                        <p class="text-base font-medium leading-tight">{{ item.title }}</p>
                        <p class="font-semibold text-red-400"> x{{ item.q }} </p>
                    </div>
                </div>
                <div
                    class="border-b-2 py-3 flex items-center">
                    <img :src="'https://admin.eatandchill.kz' + cutlery.image" class="rounded w-16">
                    <div class="pl-3 w-full">
                        <p class="text-base font-medium leading-tight">{{ cutlery.title }}</p>
                        <p class="font-semibold text-red-400"> x{{ cutlery.q }} </p>
                    </div>
                </div>
            </div>
            <div v-if="isSunday" class="max-w-md mx-auto bg-gray-800 text-white text-sm py-4 px-4 shadow fixed bottom-6 lg:bottom-8 z-50 rounded inset-x-3">
                К сожалению, доставка на воскресенье не осуществляется. Но это временно ;)
            </div>
        </div>
        <success-modal :showSuccess="showSuccess" @close="closeSuccessModal"></success-modal>
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
import {mapGetters, mapState} from "vuex";
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
                intervalsAstana: [
                    {
                        id: 0,
                        time: '06.30-07.30'
                    },
                    {
                        id: 1,
                        time: '07.30-08.30'
                    },
                    {
                        id: 2,
                        time: '08.30-09.30'
                    }
                ],
                intervalsAlmaty: [
                    {
                        id: 0,
                        time: '06.30-07.30'
                    },
                    {
                        id: 1,
                        time: '07.30-08.30'
                    },
                    {
                        id: 2,
                        time: '08.30-09.30'
                    },
                    {
                        id: 3,
                        time: '09.30-10.00'
                    }
                ],
                time: 100,
                delivery_fee: 600,
                active: 'bg-yellow-300 shadow',
                non_active: 'bg-gray-200 hover:bg-gray-300',
                name: '',
                phone: '',
                address: '',
                promocode: '',
                payment: 'kaspi_pay',
                disabled: 'cursor-not-allowed opacity-50 bg-gray-300',
                activeButton: 'cursor-pointer opacity-100 bg-yellow-300 hover:bg-yellow-400',
                activeButtonTime: 'cursor-pointer opacity-100 hover:bg-yellow-400',
                showSuccess: false,
                showFail: false,
                isLoading: false,
                cities: [
                    {
                        id: 1,
                        name: 'Астана'
                    },
                    {
                        id: 2,
                        name: 'Алматы'
                    }
                ]
            }
        },
        computed: {
            ...mapState(['cart', 'user', 'cutlery']),
            ...mapGetters({city: 'getCity'}),
            total() {
                return this.$store.getters.getTotal
            },
            wholesale() {
                return this.$store.getters.getWholesale
            },
            isEleven() {
                return this.cantBuyAlmaty || this.cantBuyAstana
            },
            isSunday() {
                return new Date().getDay() === 6
            },
            cantBuyByPrice() {
                return this.wholesale < 10000 && this.payment === 'cashless'
            },
            delivery() {
                return this.payment === 'cashless' ? 0 : this.delivery_fee
            },
            totalPrice() {
                return this.payment === 'cashless' ? this.wholesale : this.total
            },
            cantBuyAstana() {
                return this.city === 1 && (new Date().getHours() >= 18 || new Date().getHours() < 10)
            },
            cantBuyAlmaty() {
                return this.city === 2 && (new Date().getHours() >= 21 || new Date().getHours() < 10)
            },
            intervals() {
                return this.city === 1 ? this.intervalsAstana : this.intervalsAlmaty
            }
        },
        mounted() {
            const user = this.user;
            if(user) {
                this.name = user.name
                this.phone = user.phone
                this.address = user.address
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
            setCity(val) {
                this.$store.dispatch('setCity', parseInt(val.target.value))
            },
            checkout() {
                this.$v.$touch()

                if (this.$v.$invalid || this.time === 100) {
                    if (this.time === 100) this.time = -1
                    return
                }

                this.$store.dispatch('saveUser', {
                    name: this.name,
                    phone: this.phone,
                    address: this.address
                });

                if (this.payment === 'card') {
                    const widget = new cp.CloudPayments();
                    let self = this
                    widget.pay('auth', // или 'charge'
                        { //options
                            publicId: 'pk_114ea6d38b2d3467a650ea5c71d76', //id из личного кабинета
                            description: 'Оплата товаров в eatandfit.kz', //назначение
                            amount: this.total + this.delivery + this.cutlery.total, //сумма
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
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let items = this.cart.map(x => {
                    return {
                        productId: x.id,
                        quantity: x.q
                    }
                })
                axios.post('https://admin.eatandchill.kz/api/orders', {
                    name: this.name,
                    city_id: this.city,
                    phone: this.uglifyPhone(this.phone),
                    address: this.address,
                    time: this.intervals[this.time].time,
                    paymentType: this.payment === 'kaspi_pay' ? '1' : '2',
                    items: items,
                    total: this.total,
                    wholesale: this.wholesale,
                    deliveryCost: this.delivery,
                    cutlery: this.cutlery.q,
                    brand_id: 2,
                    _token: token
                }).
                then(function (response) {
                    self.showSuccess = true
                    self.$store.dispatch('clearCart');
                    self.$store.dispatch('clearCutlery');
                    self.isLoading = false
                }).
                catch(function(error){
                    self.showFail = true
                    console.log(error, 'error from eatfitgo');
                    self.isLoading = false
                });
            },
            uglifyPhone(phone) {
                if (phone) {
                    return phone.replace(/\D/g, '')
                }

                return ''
            },
            closeSuccessModal() {
                this.showSuccess = false
                window.location.href = '/go'
            }
        }
    }
</script>
