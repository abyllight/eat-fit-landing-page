<template>
    <div v-show="isVisible" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-sm bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 py-6 sm:p-6">
                <h3 v-show="!isPersonal" class="text-xl leading-6 font-black mb-4">
                    Рацион "{{ data.title }}"
                </h3>

                <div v-show="!isPersonal" class="mb-4 text-center">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Цена за день:</p>
                        <div>
                            <span class="text-lg font-semibold" :class="[(day === '2' || day > 9) ? 'text-gray-600 oldPrice' : 'text-brand-dark-green']">{{ data.iPrice }}тг</span>
                            <span v-show="day === '2' || day > 9" class="ml-2 text-pink-800 text-lg font-semibold">{{ discount }}тг</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <p class="font-semibold">Итого:</p>
                        <div>
                            <span class="text-lg font-semibold" :class="[(day === '2' || day > 9) ? 'text-gray-600 oldPrice' : 'text-brand-dark-green']">{{ day * data.iPrice }}тг</span>
                            <span v-show="day === '2' || day > 9" class="ml-2 text-pink-800 text-lg font-semibold">{{ total }}тг</span>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="w-full flex justify-between items-center">
                            <p class="font-semibold text-gray-800 text-sm">Количество дней:</p>
                            <span class="text-brand-dark-green font-semibold">{{ day }} {{ dayTxt }}</span>
                        </div>

                        <input type="range" v-model="day" min="1" max="32">
                    </div>
                </div>

                <div>
                    <form @submit.prevent="formSubmit" onsubmit="ym(56810422,'reachGoal','generatedlead')">
                        <h4 class="font-semibold mb-4">
                            Данные для консультации
                        </h4>
                        <div class="mb-3">
                            <input class="shadow appearance-none border rounded w-full text-sm py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                                   type="text" placeholder="Имя" v-model.trim="$v.name.$model" :class="{ 'border-red-500': $v.name.$error }" />
                            <p v-if="$v.name.$error" class="text-red-500 text-xs italic mt-1">Укажите имя</p>
                        </div>
                        <div class="mb-3">
                            <masked-input class="shadow appearance-none border rounded w-full text-sm py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:shadow-outline"
                                   type="tel" placeholder="Телефон" v-model="phone" mask="\+\7 (111) 111-1111" @input="rawVal = arguments[1]" :class="{ 'border-red-500': !isPhoneValid }"/>
                            <p v-if="!isPhoneValid" class="text-red-500 text-xs italic mt-1">Заполните телефон</p>
                        </div>
                        <div class="mb-4">
<!--                            <input
                                class="shadow appearance-none border rounded w-full text-sm mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text" placeholder="Промокод (если есть)" v-model="promo">-->
                            <label class="block text-gray-500 font-semibold flex mt-1">
                                <input class="mr-2 leading-tight w-25 h-25" type="checkbox" v-model="isChecked">
                                <span class="text-tiny -mt-1">
                                    Я даю согласие на обработку своих данных и их использование
                                </span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <button class="mx-auto bg-brand-dark-green font-bold py-2 px-5 text-xs uppercase font-semibold text-white rounded shadow focus:outline-none focus:shadow-outline"
                                :disabled="!isChecked || this.name.length <= 1 || !isValid"
                                :class="[ !isChecked || this.name.length <= 1 || !isValid ? 'cursor-not-allowed opacity-50' : 'hover:bg-brand-green cursor-pointer opacity-100']"
                            >
                                Оставить заявку
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <button @click="closeModal" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-700 focus:text-blue-600 focus:outline-none">
                <svg class="h-8 w-8 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
    </div>
</template>
<style>
    .oldPrice{
        text-decoration: line-through;
    }
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
            day: 21,
            discount: 0,
            name: '',
            phone: '',
            promo: '',
            utm: [],
            isChecked: false,
            rawVal: ''
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
                day: this.day,
                title: this.data.title,
                isPersonal: this.isPersonal,
                utm: params,
                ga: ga
            };

            axios.post('/', data).
            then(function (response) {

                if (response.data === true){
                    self.$emit('showSuccess')
                }else{
                    self.$emit('showFail')
                }
            }).
            catch(function(error){
                console.log(error);
            });
        },
        closeModal(){
            this.day = 21
            this.$emit('close')
        }
    },
    computed: {
        total(){
            if(this.day === '2'){
                this.discount = this.data.iPrice * 0.7
                return this.data.iPrice * 0.7 * this.day
            }else if (this.day > 2 && this.day < 10){
                this.discount = this.data.iPrice
                return this.day * this.data.iPrice
            }else if(this.day >= 10 && this.day < 21){
                this.discount = this.data.iPrice - 500
                return this.day * (this.data.iPrice - 500)
            }else if(this.day > 20 && this.day <= 30){
                this.discount = this.data.iPrice - 1000
                return this.day * (this.data.iPrice - 1000)
            }else{
                if(this.data.title === 'XS'){
                    this.discount = this.data.iPrice - 1000
                    return this.day * (this.data.iPrice - 1000)
                }
                this.discount = this.data.iPrice - 1500
                return this.day * (this.data.iPrice - 1500)
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
    }
}
</script>
