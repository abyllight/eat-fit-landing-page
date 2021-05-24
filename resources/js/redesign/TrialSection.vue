<template>
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-center">
            <div class="text-white mb-12 md:w-1/2">
                <div class="max-w-md md:mx-auto">
                    <h2 class="font-semibold text-xl md:text-2xl leading-tight mb-4">Лучше один раз <span class="text-brand-yellow">попробовать</span>
                        <br>чем <span class="text-brand-yellow">100 раз услышать</span>
                    </h2>
                    <p class="md:text-lg">
                        Оставьте заявку на заказ пробных рационов здорового питания <br class="hidden md:block lg:hidden"> <span class="text-brand-green">со скидкой 30%</span>
                    </p>
                </div>
            </div>
            <div class="md:w-1/2 md:px-4">
                <div class="max-w-sm bg-brand-blue-light w-full p-5 rounded-xl">
                    <h2 class="text-center text-lg md:text-2xl font-medium mb-3">
                        Хочу попробовать
                    </h2>
                    <hr class="mb-4">
                    <div class="flex items-center mb-5">
                        <img src="/img/icons/smartphone.png" width="16" class="mr-3" alt="Телефон">
                        <p class="text-sm">Заполните форму — и мы вам перезвоним в ближайшее время</p>
                    </div>

                    <form @submit.prevent="formSubmit">
                        <div>
                            <input
                                v-model="name"
                                type="text"
                                class="w-full rounded-2xl bg-white px-5 py-3 mb-5 text-sm focus:outline-none focus:shadow-outline"
                                placeholder="Ваше имя"
                                required
                            />
                            <masked-input
                                v-model="phone"
                                mask="\+\7 (111) 111-1111"
                                @input="rawVal = arguments[1]"
                                type="tel"
                                class="w-full rounded-2xl bg-white px-5 py-3 border text-sm focus:outline-none focus:shadow-outline"
                                :class="{ 'border-red-500': !isPhoneValid || !isValid }"
                                placeholder="Ваш телефон"
                            />
                            <p v-if="!isPhoneValid || !isValid" class="text-red-500 text-xs italic mt-2">Заполните телефон</p>
                            <button
                                type="submit"
                                class="border-brand-yellow rounded-2xl cursor-pointer shadow-lg
                                            text-center text-xs font-semibold uppercase py-3 tracking-wider
                                            focus:outline-none w-full my-5
                                            bg-gradient-to-b from-gr-yellow-start to-gr-yellow-end hover:from-brand-yellow-hover">
                                Оставить заявку
                            </button>

                            <p class="text-tiny">
                                Нажимая на кнопку, я подтверждаю своё
                                согласие на обработку персональных данных
                                в соответствии с <a href="" class="text-brand-green">Политикой конфиденциальности</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <success-modal :showSuccess="showSuccess" @close="closeModal"></success-modal>
        <fail-modal :showFail="showFail" @close="closeModal"></fail-modal>
    </div>
</template>
<script>
    import MaskedInput from 'vue-masked-input'
    import SuccessModal from "./SuccessModal";
    import FailModal from "./FailModal";
    export default {
        name: "Trial",
        components:{
            MaskedInput,
            SuccessModal,
            FailModal
        },
        data(){
            return{
                name: '',
                phone: '',
                rawVal: '',
                isValid: true,
                showSuccess: false,
                showFail: false,
                isClicked: false
            }
        },
        methods: {
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
            closeModal(){
                this.showSuccess = false
                this.showFail = false
                this.name = ''
                this.phone = ''
                this.isValid = true
                this.rawVal = ''
                this.isClicked = false
            },
            formSubmit(){
                if (this.rawVal.length === 0 || !this.isPhoneValid){
                    this.isValid = false
                    return;
                }

                if (this.isClicked) return;

                let self = this;

                let params = this.getParams();
                let ga = this.getCookie('_ga');

                if (ga) {
                    ga = ga.substring(6, ga.length - 1);
                }

                let data = {
                    name: this.name,
                    phone: this.phone,
                    utm: params,
                    ga: ga
                };

                axios.post('/', data).
                then(function (response) {
                    console.log(response)
                    if (response.data === true){
                        self.showSuccess = true
                    }else{
                        self.showFail = true
                    }
                }).
                catch(function(error){
                    console.log(error);
                });

                this.isClicked = true
            }
        },
        computed: {
            isPhoneValid(){
                this.isValid = true
                let reg = /\d+/g;
                let result = [];
                result = this.rawVal.match(reg);
                return this.rawVal.length === 0 || result && result[0].length === 10;
            },
        }
    }
</script>
