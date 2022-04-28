<template>
    <div class="relative">
        <transition
            enter-active-class="ease-in duration-300"
            enter-class="opacity-0"
            leave-active-class="ease-out duration-100"
        >
            <div
                v-if="isVisible"
                class="h-screen w-full fixed inset-0 z-20 bg-gray-900 opacity-75 cursor-pointer"
                @click="closeModal">
            </div>
        </transition>
        <transition
            enter-active-class="ease-in duration-300"
            enter-class="opacity-0 transform translate-y-full md:translate-y-0 md:scale-100"
            leave-active-class="ease-out duration-100"
        >
            <div v-if="isVisible"
                class="fixed overflow-y-auto inset-0 top-16 2xl:top-24 md:bottom-auto mx-auto z-30 bg-white rounded-t-lg md:rounded-b-lg md:max-w-md lg:max-w-3xl py-6"
            >
                <h3 class="text-2xl leading-6 font-black ml-6 mb-4">
                    {{ !isPersonal ? `Рацион ${ data.title }` : 'Индивидуальное меню' }}
                </h3>

                <div class="flex flex-col lg:flex-row">
                    <div class="w-full lg:w-1/2 px-6">
                        <div v-if="!isPersonal">
                            <div class="flex items-center justify-start py-1 mb-4">
                                <div class="mr-4 bg-gray-200 px-5 py-2 rounded">
                                    <p class="text-xs">{{ data.protein ? data.protein.weight : '' }}г</p>
                                    <p class="font-medium text-sm text-lime-600 -mt-1">Белки</p>
                                </div>
                                <div class="mr-4 bg-gray-200 px-5 py-2 rounded">
                                    <p class="text-xs">{{ data.fat ? data.fat.weight : '' }}г</p>
                                    <p class="font-medium text-sm text-lime-600 -mt-1">Жиры</p>
                                </div>
                                <div class="bg-gray-200 px-5 py-2 rounded">
                                    <p class="text-xs">{{ data.carbohydrate ? data.carbohydrate.weight : '' }}г</p>
                                    <p class="font-medium text-sm text-lime-600 -mt-1">Углеводы</p>
                                </div>
                            </div>
                            <p class="text-base font-medium mb-3">Этот рацион предназначен для:</p>
                            <div>
                                <p v-for="aim in data.aims" :key="aim.id" class="text-base leading-tight mb-2">- {{ aim.description }}</p>
                                <p class="text-sm italic leading-tight text-red-500 mb-5">{{ data.extra }}</p>
                            </div>
                        </div>
                        <div v-else class="mb-4">
                            <p class="text-base">
                                Разрабатывается индивидуально по запросу клиента с учётом анамнеза
                                и предпочтений. В том числе: меню для будущих и кормящих мам, веганов,
                                вегетарианцев и пескетарианцев, аутоимунные палео-диеты, кето-меню, диет-столы и пр.
                            </p>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 px-6">
                        <div
                            v-if="!isPersonal"
                            class="mb-4 text-center font-medium text-base"
                        >
                            <div class="flex items-center justify-between">
                                <p>Цена за день:</p>
                                <div class="font-semibold text-lg">
                                    <span :class="[(day === '2' || day >= 24) ? 'text-gray-600 line-through' : 'text-brand-dark-green']">{{ data.iPrice }}тг</span>
                                    <span v-show="day === '2' || day >= 24" class="ml-2 text-pink-800">{{ discount }}тг</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <p>Итого:</p>
                                <div class="font-semibold text-lg">
                                    <span :class="[(day === '2' || day >= 24) ? 'text-gray-600 line-through' : 'text-brand-dark-green']">{{ day * data.iPrice }}тг</span>
                                    <span v-show="day === '2' || day >= 24" class="ml-2 text-pink-800">{{ total }}тг</span>
                                </div>
                            </div>

                            <div class="mt-2">
                                <div class="w-full flex justify-between items-center">
                                    <p class="font-medium text-gray-800 text-sm">Количество дней:</p>
                                    <span class="text-brand-dark-green font-semibold">{{ day }} {{ dayTxt }}</span>
                                </div>

                                <input type="range" v-model="day" min="1" max="36">
                            </div>
                        </div>

                        <div>
                            <form @submit.prevent="formSubmit" onsubmit="ym(56810422,'reachGoal','generatedlead')">
                                <h4 class="text-base font-semibold mb-4">
                                    Данные для консультации
                                </h4>
                                <div class="mb-3">
                                    <input
                                        class="focus:outline-none focus:ring focus:border-blue-300 block w-full shadow border border-gray-300 rounded-md text-base px-3 py-2.5"
                                        type="text"
                                        placeholder="Имя"
                                        v-model.trim="$v.name.$model"
                                        :class="{ 'border-red-500 focus:border-red-500': $v.name.$error }"/>
                                    <p
                                        v-if="$v.name.$error"
                                        class="text-red-500 text-xs italic mt-1"
                                    >
                                        Укажите имя
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <masked-input
                                        class="focus:outline-none focus:ring focus:border-blue-300 block w-full shadow border border-gray-300 rounded-md text-base px-3 py-2.5"
                                        type="tel"
                                        placeholder="+7 (700) 000-0000"
                                        v-model="phone"
                                        mask="\+\7 (111) 111-1111"
                                        @input="rawVal = arguments[1]"
                                        :class="{ 'border-red-500 focus:border-red-500': !isPhoneValid }"/>
                                    <p v-if="!isPhoneValid" class="text-red-500 text-xs italic mt-1">Заполните телефон</p>
                                </div>
                                <div class="mb-2.5 relative">
                                    <input
                                        v-model="promo"
                                        class="focus:outline-none focus:ring focus:border-blue-300 block w-full shadow border border-gray-300 rounded-md text-base px-3 py-2.5"
                                        type="text"
                                        placeholder="Промокод (если есть)"
                                    />
                                    <div class="absolute inset-y-0 right-3 flex items-center">
                                        <p
                                            v-if="promo !== '' && !loading"
                                            @click="checkPromo"
                                            class="text-xs font-semibold uppercase text-gray-800 cursor-pointer"
                                            :class="{'text-red-700':promoIsApplied}"
                                        >
                                            {{promoIsApplied ? 'Убрать' : 'Применить'}}
                                        </p>
                                        <div v-if="loading" class="loader ease-linear rounded-full border-4 border-t-4 border-white h-6 w-6"></div>
                                    </div>
                                </div>
                                <p class="text-sm font-medium text-lime-700 bg-gray-200" :class="{'text-red-600': !promoStatus, 'p-3': promoMsg}">{{promoMsg}}</p>
                                <label class="block text-gray-500 font-semibold flex mt-4">
                                    <input
                                        v-model="isChecked"
                                        class="mr-2 leading-tight w-5 h-5 cursor-pointer"
                                        type="checkbox"
                                    >
                                    <span class="text-tiny -mt-1">
                                            Я даю согласие на обработку своих данных и их использование
                                        </span>
                                </label>
                                <div class="flex items-center">
                                    <button
                                        class="mx-auto bg-brand-dark-green font-bold py-2.5 px-4 text-xs uppercase font-semibold text-white rounded shadow focus:outline-none focus:shadow-outline"
                                        :disabled="!isChecked || this.name.length <= 1 || !isValid"
                                        :class="[ !isChecked || this.name.length <= 1 || !isValid ? 'cursor-not-allowed opacity-50' : 'hover:bg-brand-green cursor-pointer opacity-100']"
                                    >
                                        Оставить заявку
                                    </button>
                                </div>
                            </form>
                        </div>
                        <button
                            type="button"
                            @click="closeModal"
                            class="cursor-pointer focus:outline-none outline-none h-10 w-10 absolute top-0 right-0 mr-4 mt-3"
                        >
                            <svg viewBox="0 0 24 24"
                                 class="fill-current text-gray-700 hover:text-gray-500">
                                <path d="M0 0h24v24H0V0z" fill="none"/>
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </transition>
        <div v-if="isLoading" class="h-screen w-full bg-black opacity-75 fixed inset-0 z-50 flex flex-col items-center justify-center">
            <div class="loader ease-linear rounded-full border-4 border-t-4 border-white h-16 w-16 mb-4"></div>
            <h2 class="text-center text-white text-xl font-semibold">Идет обработка заказа...</h2>
        </div>
    </div>
</template>
<style scoped>
    input[type=range] {
        -webkit-appearance: none;
        margin: 10px 0;
        width: 100%;
    }
    input[type=range]:focus {
        outline: none;
    }
    input[type=range]::-webkit-slider-runnable-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        background: #e2e8f0;
    }
    input[type=range]::-webkit-slider-thumb {
        border: 1px solid #ffffff;
        height: 32px;
        width: 32px;
        border-radius: 50%;
        background: #74ab31;
        cursor: pointer;
        -webkit-appearance: none;
        margin-top: -12px;
    }
    input[type=range]:focus::-webkit-slider-runnable-track {
        background: #e2e8f0;
    }
    input[type=range]::-moz-range-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        background: #e2e8f0;
    }
    input[type=range]::-moz-range-thumb {
        border: 1px solid #ffffff;
        height: 32px;
        width: 32px;
        border-radius: 50%;
        background: #ffffff;
        cursor: pointer;
    }
    input[type=range]::-ms-track {
        width: 100%;
        height: 8.4px;
        cursor: pointer;
        background: transparent;
        border-color: transparent;
        color: transparent;
    }
    input[type=range]::-ms-fill-lower {
        background: #2a6495;
        border: 0.2px solid #010101;
        border-radius: 2.6px;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }
    input[type=range]::-ms-fill-upper {
        background: #74ab31;
        border: 0.2px solid #010101;
        border-radius: 2.6px;
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }
    input[type=range]::-ms-thumb {
        box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
        border: 1px solid #000000;
        height: 36px;
        width: 16px;
        border-radius: 3px;
        background: #ffffff;
        cursor: pointer;
    }
    input[type=range]:focus::-ms-fill-lower {
        background: #74ab31;
    }
    input[type=range]:focus::-ms-fill-upper {
        background: #74ab31;
    }

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
import MaskedInput from 'vue-masked-input'
import { required, minLength } from 'vuelidate/lib/validators'
export default {
    name: 'orderModal',
    props: ['data', 'isVisible', 'isPersonal'],
    components:{
        MaskedInput
    },
    data: function () {
        return{
            day: 24,
            discount: 0,
            name: '',
            phone: '',
            promo: '',
            utm: [],
            isChecked: false,
            rawVal: '',
            isLoading: false,
            loading: false,
            promoIsApplied: false,
            promoMsg: '',
            promoStatus: false,
            promoType: 0,
            promoVal: null
        }
    },
    computed: {
        total(){
            if(this.day === '2'){
                this.discount = this.data.iPrice * 0.7
                return this.data.iPrice * 0.7 * this.day
            }else if (this.day > 2 && this.day < 24){
                this.discount = this.data.iPrice
                return this.day * this.data.iPrice
            }else if(this.day >= 24 && this.day < 36){
                this.discount = this.data.iPrice - 500
                return this.day * (this.data.iPrice - 500)
            }else{
                this.discount = this.data.iPrice - 1000
                return this.day * (this.data.iPrice - 1000)
            }
        },
        dayTxt(){
            let n = this.day%10;
            if(n === 1){
                if(this.day > 10 && this.day < 21){
                    return 'дней';
                }
                return 'день';
            }else if( n === 2 || n === 3 || n === 4){
                if(this.day > 10 && this.day < 21){
                    return 'дней';
                }
                return 'дня';
            }else{
                return 'дней';
            }
        },
        isPhoneValid(){
            let reg = /\d+/g;
            let result = [];
            result = this.rawVal.match(reg);
            return this.rawVal.length === 0 || (result && result[0].length === 10);
        },
        isValid(){
            let reg = /\d+/g;
            let result = [];
            result = this.rawVal.match(reg);
            return result && result[0].length === 10;
        }
    },
    validations: {
        name: {
            required,
            minLength: minLength(2)
        }
    },
    methods: {
        validName(value){
            this.name = value
            this.$v.name.$touch()
        },
        getParams(){
            let name_keys = ['utm_source','utm_campaign','utm_medium','utm_term','utm_content'];

            let url = decodeURI(document.location.search);

            if(url.indexOf('?') < 0) return [];

            url = url.split('?');
            url = url[1];

            let GET = {}, params = [], key = [];

            if(url.indexOf('#')!==-1){
                url = url.substr(0,url.indexOf('#'));
            }

            if(url.indexOf('&') > -1){ params = url.split('&');} else {params[0] = url; }

            for (let r = 0; r < params.length; r++){
                for (let z = 0; z < name_keys.length; z++){
                    if(params[r].indexOf(name_keys[z] + '=') > -1){
                        if(params[r].indexOf('=') > -1) {
                            key = params[r].split('=');
                            GET[key[0]]=key[1];
                        }
                    }
                }
            }

            return (GET);
        },
        getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i <ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return null;
        },
        formSubmit(){
            if (!this.isChecked || this.name.length <= 1 || !this.isValid) return

            this.$emit('close')
            this.isLoading = true
            let self = this;

            let params = this.getParams();
            let ga = this.getCookie('_ga');

            if (ga) {
                ga = ga.substring(6, ga.length - 1);
            }

            let data = {
                name: this.name,
                phone: this.phone,
                promo: this.promo,
                promoStatus: this.promoStatus,
                promoMsg: this.promoMsg,
                promoType: this.promoType,
                promoVal: this.promoVal,
                day: this.day,
                title: this.data.title,
                isPersonal: this.isPersonal,
                total: this.total,
                discount: this.discount,
                utm: params,
                ga: ga
            };

            axios.post('/', data).
            then(function (response) {
                self.isLoading = false
                self.closeModal()
                if (response.data === true){
                    window.location.href = '/thanks'
                }else{
                    self.$emit('showFail')
                }
            }).
            catch(function(error){
                console.log(error);
            });
        },
        closeModal(){
            this.day = 24
            this.isChecked = false
            this.$emit('close')
        },
        checkPromo() {
            if (this.promo === '') return

            this.loading = true

            if (this.promoIsApplied) {
                this.promoIsApplied = false
                this.promo = ''
                this.promoMsg = ''
                this.promoStatus = false
                this.promoType = 0
                this.promoVal = null
                this.loading = false
                return
            }

            axios.get('https://back.eatandfit.kz/api/promocode/' + this.promo)
                .then(response => {
                    this.loading = false

                    this.promoIsApplied = response.data.status

                    this.promoStatus = response.data.status
                    this.promoMsg = response.data.msg
                    this.promoType = response.data.type
                    this.promoVal = response.data.val
                })
                .catch(function (error) {
                    console.log(error)
                })
        }
    }
}
</script>
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
