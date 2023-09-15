<template>
    <div class="relative">
        <transition
            enter-active-class="ease-in duration-300"
            enter-class="opacity-0"
            leave-active-class="ease-out duration-100"
        >
            <div
                v-if="isVisible"
                class="h-screen w-full fixed inset-0 z-40 bg-gray-900 bg-opacity-80 cursor-pointer"
                @click="closeModal">
            </div>
        </transition>
        <transition
            enter-active-class="ease-in duration-300"
            enter-class="opacity-0 transform translate-y-full md:translate-y-0 md:scale-100"
            leave-active-class="ease-out duration-100"
        >
            <div v-if="isVisible"
                class="fixed overflow-y-auto inset-0 top-12 lg:top-6 lg:h-auto md:bottom-auto mx-auto z-50 bg-white rounded-t-lg md:rounded-b-lg md:max-w-md py-6"
            >
                <h3 class="text-2xl leading-6 font-black ml-6 mb-4">
                    Daily
                </h3>

                <div class="flex flex-col lg:flex-row">
                    <div class="w-full px-6">
                        <div>
                            <form @submit.prevent="formSubmit">
                                <div class="mb-3">
                                    <select
                                        v-model="city_id"
                                        :aria-details="city_id"
                                        class="focus:outline-none focus:ring focus:border-blue-300 block w-full shadow border border-gray-300 rounded-md text-base px-3 py-2.5"
                                    >
                                        <option
                                            v-for="c in cities"
                                            :key="c.id"
                                            :value="c.id"
                                        >
                                            {{c.name}}
                                        </option>
                                    </select>
                                    <span id="cityValue" class="hidden">{{city_id}}</span>
                                </div>
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
                                <label class="block text-gray-500 font-semibold mt-4">
                                    <p class="text-tiny -mt-1">
                                        Нажимая на кнопку, я подтверждаю своё
                                        согласие на обработку персональных данных
                                        в соответствии с <a href="/files/oferta.docx" class="text-brand-green">Политикой конфиденциальности</a>
                                    </p>
                                </label>
                                <div class="flex items-center mt-6">
                                    <button
                                        class="mx-auto bg-brand-dark-green hover:bg-brand-green cursor-pointer py-2.5 px-4 text-xs uppercase font-semibold text-white rounded shadow focus:outline-none focus:shadow-outline"
                                        :disabled="this.name.length <= 1 || !isValid"
                                        :class="[ this.name.length <= 1 || !isValid ? 'cursor-not-allowed opacity-50' : 'hover:bg-brand-green cursor-pointer opacity-100']"

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
<script>
import MaskedInput from 'vue-masked-input'
import { required, minLength } from 'vuelidate/lib/validators'
export default {
    name: 'dailyModal',
    props: ['data', 'isVisible', 'isPersonal'],
    components:{
        MaskedInput
    },
    data: function () {
        return{
            discount: 0,
            name: '',
            phone: '',
            promo: '',
            touched: false,
            cities: [
                {
                    id: 1,
                    name: 'Астана'
                },
                {
                    id: 2,
                    name: 'Алматы'
                }
            ],
            city_id: 1,
            utm: [],
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
        isPhoneValid() {
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
        formSubmit() {

            if (this.name.length <= 1 || !this.isValid) return

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
                city_id: this.city_id,
                phone: this.phone,
                promo: this.promo,
                promoStatus: this.promoStatus,
                promoMsg: this.promoMsg,
                promoType: this.promoType,
                promoVal: this.promoVal,
                isDaily: true,
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
                }).finally(() => {
                self.isLoading = false
            })
        },
        closeModal(){
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
