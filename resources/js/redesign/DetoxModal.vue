<template>
    <div v-show="show" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-sm bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 pt-8 pb-4 md:px-6">
                <h3 class="text-xl leading-6 font-black mb-4">
                    {{ data.title }}
                </h3>

                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center justify-between w-40">
                            <div class="cursor-pointer rounded-full h-7 w-7 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center"
                                 @click="decrement">
                                <img src="/img/icons/remove.svg" width="20">
                            </div>

                            <span class="text-lg font-semibold">{{ count }} {{ txt }}</span>

                            <div class="cursor-pointer rounded-full h-7 w-7 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center"
                                 @click="increment">
                                <img src="/img/icons/add.svg" width="20">
                            </div>
                        </div>
                        <div class="font-semibold">
                            <p class="-mb-2" :class="[count > 2 ? 'text-gray-600 line-through text-sm' : 'text-brand-dark-green text-lg']"> {{ count * data.price }}₸</p>
                            <p v-show="count > 2" class=" text-brand-dark-green text-xl"> {{ total }}₸</p>
                        </div>

                    </div>
                </div>
                <div class="px-1 mt-5">
                    <form @submit.prevent="formSubmit">

                        <h4 class="text-center leading-6 font-semibold mb-4">
                            Оформить заказ
                        </h4>
                        <div class="mb-3">
                            <input class="shadow appearance-none border rounded w-full text-sm py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   type="text" placeholder="Имя" v-model.trim="$v.name.$model" :class="{ 'border-red-500': $v.name.$error }" />
                            <p v-if="$v.name.$error" class="text-red-500 text-xs italic mt-1">Укажите имя</p>
                        </div>
                        <div class="mb-3">
                            <masked-input class="shadow appearance-none border rounded w-full text-sm py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                          type="tel" placeholder="Телефон" v-model="phone" mask="\+\7 (111) 111-1111" @input="rawVal = arguments[1]" :class="{ 'border-red-500': !isPhoneValid }"/>
                            <p v-if="!isPhoneValid" class="text-red-500 text-xs italic mt-1">Заполните телефон</p>
                        </div>
                        <div class="mb-4">
                            <input class="shadow appearance-none border rounded w-full mb-2 py-2 px-3 text-sm text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text"
                                   placeholder="Адрес" v-model.trim="$v.address.$model" :class="{ 'border-red-500': $v.address.$error }">
                            <p v-if="$v.address.$error" class="text-red-500 text-xs italic mt-1">Укажите адрес</p>
                            <label class="block text-gray-500 font-bold flex mt-1">
                                <p class="text-tiny -mt-1">
                                    Нажимая на кнопку, я подтверждаю своё
                                    согласие на обработку персональных данных
                                    в соответствии с <a href="/files/oferta.docx" class="text-brand-green">Политикой конфиденциальности</a>
                                </p>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <button class="mx-auto bg-brand-green hover:bg-brand-green-hover cursor-pointer text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:shadow-outline">
                                Отправить заказ
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <button @click="close" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-700 focus:text-blue-600 focus:outline-none">
                <svg class="h-8 w-8 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
    import MaskedInput from 'vue-masked-input'
    import { required, minLength } from 'vuelidate/lib/validators'
    export default {
        name: "DetoxModal",
        props: ['show', 'data'],
        components:{
            MaskedInput,
        },
        data(){
            return{
                count: 1,
                totalPrice: 0,
                name: '',
                phone: '',
                address: '',
                isChecked: false,
                rawVal: '',
                sets: [
                    {
                        id: 0,
                        title: '1 Набор'
                    },
                    {
                        id: 1,
                        title: '2 Набора'
                    },
                    {
                        id: 2,
                        title: '3 Набора'
                    }
                ]
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
        methods:{
            close(){
                this.count = 1
                this.$emit('close')
            },
            increment(){
                this.count++
            },
            decrement(){
                if (this.count > 1) this.count--
            },
            formSubmit(){
                if (this.name.length <= 1 || this.address.length <= 1 || !this.isValid) return

                const self = this;

                axios.post('/', {
                    name: this.name,
                    phone: this.phone,
                    promo: '',
                    day: this.count,
                    address: this.address,
                    title: this.data.title,
                    isPersonal: false
                }).
                then(function (response) {
                    self.$emit('close')
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
            txt(){
                let n = this.count % 10;
                if (n === 1 && this.count !== 11){
                    return 'день'
                }else{
                    if ((n === 2 || n === 3 || n === 4) && (this.count < 12 || this.count > 14)){
                        return 'дня'
                    }
                    return 'дней'
                }
            },
            total(){
                if (this.count > 2){
                    this.totalPrice = this.count * (this.data.price - 1000)
                    return this.count * (this.data.price - 1000)
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

