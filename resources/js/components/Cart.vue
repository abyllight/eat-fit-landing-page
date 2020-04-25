<template>
    <div v-show="show" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-md bg-white rounded shadow-xl relative">
            <div class="bg-white px-3 pt-8 pb-4 md:px-6">
                <div v-show="$store.state.cart.length === 0" class="w-full h-72 flex flex-col items-center justify-center ">
                    <img src="/img/icons/supermarket.svg" class="w-8 h-8 text-center mx-auto mb-2">
                    <p class="text-center text-xl font-light uppercase">
                        Корзина пуста
                    </p>
                </div>
                <div v-show="$store.state.cart.length > 0">
                    <h3 class="text-2xl leading-6 font-black text-gray-800 mb-4">
                        Корзина
                    </h3>
                    <div class="overflow-y-auto scrolling-auto md:scrolling-auto mb-3 sc" :class="[$store.state.cart.length >= 4 ? 'h-64': '']">
                        <div v-for="item in $store.state.cart" :key="item.id" class="mt-2">
                            <div class="flex items-center justify-between mb-2">
                                <div class="w-3/4">
                                    <p class="text-gray-800 font-semibold text-sm md:text-lg leading-tight">
                                        {{ item.title }}
                                    </p>
                                </div>
                                <div>
                                    <img src="/img/icons/bin.svg" class="w-4" @click.prevent="removeFromCart(item)">
                                </div>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <button @click.prevent="decrement(item)" class="px-2 transparent hover:bg-brand-green-hover text-brand-green font-semibold hover:text-white border-2 border-brand-green hover:border-transparent rounded">
                                        -
                                    </button>
                                    <span class="text-sm font-semibold">{{ item.q }}</span>
                                    <button @click.prevent="increment(item)" class="px-2 transparent hover:bg-brand-green-hover text-brand-green font-semibold hover:text-white border-2 border-brand-green hover:border-transparent rounded">
                                        +
                                    </button>
                                </div>
                                <div class="flex items-center">
                                    <p class="font-semibold mr-2" :class="[item.q > 1 ? 'text-gray-600 oldPrice' : 'text-brand-green']"> {{ item.q * item.price }}тг.</p>
                                    <p v-show="item.q > 1" class="font-semibold text-brand-green"> {{ item.total }}тг.</p>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="text-right mb-3">
                        <p class="text-base font-semibold text-gray-800">Итого: <span class="font-black text-xl text-brand-green">{{ total }}тг.</span></p>
                    </div>
                    <div>
                        <form @submit.prevent="formSubmit">
                            <h4 class="text-lg lg:text-xl text-center leading-6 font-black text-gray-800 mb-4">
                                Оформить заказ
                            </h4>
                            <div class="mb-3">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                       type="text" placeholder="Имя" v-model.trim="$v.name.$model" :class="{ 'border-red-500': $v.name.$error }" />
                                <p v-if="$v.name.$error" class="text-red-500 text-xs italic mt-1">Укажите имя</p>
                            </div>
                            <div class="mb-3">
                                <masked-input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                              type="tel" placeholder="Телефон" v-model="phone" mask="\+\7 (111) 111-1111" @input="rawVal = arguments[1]" :class="{ 'border-red-500': !isPhoneValid }"/>
                                <p v-if="!isPhoneValid" class="text-red-500 text-xs italic mt-1">Заполните телефон</p>
                            </div>
                            <div class="mb-4">
                                <input class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text"
                                       placeholder="Адрес" v-model.trim="$v.address.$model" :class="{ 'border-red-500': $v.address.$error }">
                                <p v-if="$v.address.$error" class="text-red-500 text-xs italic mt-1">Укажите адрес</p>
                                <label class="block text-gray-500 font-bold flex mt-1">
                                    <input class="mr-2 leading-tight w-25 h-25" type="checkbox" v-model="isChecked">
                                    <span class="text-xs -mt-1">
                                    Я даю согласие на обработку своих данных и их использование
                                </span>
                                </label>
                            </div>
                            <div class="flex items-center">
                                <button class="mx-auto bg-brand-green text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:shadow-outline"
                                        :disabled="!isChecked || this.name.length <= 1 || this.address.length <= 1 || !isValid"
                                        :class="[ !isChecked || this.name.length <= 1 || this.address.length <= 1|| !isValid ? 'cursor-not-allowed opacity-50' : 'hover:bg-brand-green-hover cursor-pointer opacity-100']"
                                >
                                    Отправить заказ
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <button @click="$emit('close')" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-400 focus:text-blue-500 focus:outline-none">
                <svg class="h-8 w-8 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
    </div>
</template>
<style scoped>
    .oldPrice{
        text-decoration: line-through;
    }
    @media (min-width: 1024px) {
        .sc::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
            border-radius: 4px;
        }

        .sc::-webkit-scrollbar
        {
            width: 4px;
            background-color: #F5F5F5;
        }

        .sc::-webkit-scrollbar-thumb
        {
            background-color: #4a5568;
        }
    }
</style>
<script>
    import MaskedInput from 'vue-masked-input'
    import { required, minLength } from 'vuelidate/lib/validators'
    export default {
        name: "Cart",
        props: ['show'],
        components:{
            MaskedInput,
        },
        data(){
            return{
                name: '',
                phone: '',
                address: '',
                isChecked: false,
                rawVal: '',
                products: []
            }
        },
        validations: {
            name: {
                required,
                minLength: minLength(2)
            },
            address: {
                required,
                minLength: minLength(2)
            }
        },
        methods: {
            removeFromCart(item){
                this.$store.commit('removeFromCart', item);
            },
            decrement(item){
                if (item.q !== 0 ){
                    this.$store.commit('decrement', item);
                }
            },
            increment(item){
                this.$store.commit('increment', item);
            },
            formSubmit(){
                var self = this;
                axios.post('/cart', {
                    name: this.name,
                    phone: this.phone,
                    address: this.address,
                    cart: this.$store.state.cart
                }).
                then(function (response) {
                    self.$emit('close')
                    self.$store.commit('clearCart');
                    if (response.data === true){
                        self.$emit('showSuccess')
                    }else{
                        self.$emit('showFail')
                    }

                }).
                catch(function(error){
                    console.log(error);
                });
            }
        },
        computed: {
            total(){
                let array = [0];

                this.$store.state.cart.map(function (val) {
                    return array.push(parseInt(val.total))
                });
                const reducer = (accumulator, currentValue) => accumulator + currentValue;
                return array.reduce(reducer)
            },
            isPhoneValid(){
                let reg = /\d+/g;
                let result = [];
                result = this.rawVal.match(reg);
                if (this.rawVal.length === 0 || (result && result[0].length === 10)){
                    return true
                }
                return false
            },
            isValid(){
                let reg = /\d+/g;
                let result = [];
                result = this.rawVal.match(reg);
                if (result && result[0].length === 10){
                    return true
                }
                return false
            }
        }
    }
</script>

<style scoped>

</style>
