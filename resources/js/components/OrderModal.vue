<template>
    <div v-show="isVisible" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-md bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 py-6 sm:p-6">
                <h3 v-show="!isPersonal" class="text-center text-2xl md:text-3xl leading-6 font-black text-gray-800 mb-4">
                    Рацион "{{ data.title }}"
                </h3>

                <div v-show="!isPersonal" class="mt-1 mb-4 text-center">
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-lg lg:text-2xl text-gray-800">Цена за день:
                            <span :class="[(day === '1' || day > 9) ? 'text-gray-600 oldPrice' : 'text-brand-green']">{{ data.iPrice }}тг</span>
                        </p>
                        <span v-show="day === '1' || day > 9" class="ml-2 text-pink-800 text-xl lg:text-3xl font-semibold">{{ discount }}тг</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-lg lg:text-2xl text-gray-800">Итого:
                            <span :class="[(day === '1' || day > 9) ? 'text-gray-600 oldPrice' : 'text-brand-green']">{{ day * data.iPrice }}тг</span>
                        </p>
                        <span v-show="day === '1' || day > 9" class="ml-2 text-pink-800 text-xl lg:text-3xl font-semibold">{{ total }}тг</span>
                    </div>

                    <div class="mt-2">
                        <div class="w-full flex justify-between items-center">
                            <p class="font-semibold text-base text-gray-800">Количество дней:</p>
                            <span class="text-lg lg:text-2xl text-brand-green font-semibold">{{ day }} {{ dayTxt }}</span>
                        </div>

                        <input type="range" v-model="day" min="1" max="32">
                    </div>
                </div>

                <div>
                    <form @submit.prevent="formSubmit" onsubmit="ym(56810422,'reachGoal','generatedlead')">
                        <h4 v-show="!isPersonal" class="text-xl text-center leading-6 font-black text-gray-800 mb-4">
                            Оформить заказ
                        </h4>
                        <h4 v-show="isPersonal" class="w-72 mx-auto text-center text-2xl leading-6 font-black text-gray-800 mb-6">
                            Заказать разработку индивидуального меню
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
                            <input class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Промокод (если есть)" v-model="promo">
                            <label class="block text-gray-500 font-bold flex mt-1">
                                <input class="mr-2 leading-tight w-25 h-25" type="checkbox" v-model="isChecked">
                                <span class="text-xs -mt-1">
                                    Я даю согласие на обработку своих данных и их использование
                                </span>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <button class="mx-auto bg-brand-green text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:shadow-outline"
                                :disabled="!isChecked || this.name.length <= 1 || !isValid"
                                :class="[ !isChecked || this.name.length <= 1 || !isValid ? 'cursor-not-allowed opacity-50' : 'hover:bg-brand-green-hover cursor-pointer opacity-100']"
                            >
                                Отправить заказ
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <button @click="closeModal" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-400 focus:text-blue-500 focus:outline-none">
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
        formSubmit(){
            var self = this;
            axios.post('/', {
                name: this.name,
                phone: this.phone,
                promo: this.promo,
                day: this.day,
                title: this.data.title,
                isPersonal: this.isPersonal
            }).
            then(function (response) {
                self.$emit('close')
                console
                .log(response)
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
            if(this.day === '1'){
                this.discount = this.data.iPrice * 0.7
                return this.data.iPrice * 0.7
            }else if (this.day > 1 && this.day < 10){
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
