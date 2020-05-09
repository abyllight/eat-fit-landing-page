<template>
    <div v-show="show" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-md bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 pt-8 pb-4 md:px-6">
                <h3 class="text-2xl leading-6 font-bold text-gray-800 mb-2">
                    {{ data.title }}
                </h3>
                <div class="flex items-center mb-4">
                    <p class="italic text-gray-700 font-semibold mr-4">1 набор</p>
                    <p class="italic text-gray-700 font-semibold mr-4">{{ data.weight }}г.</p>
                    <p class="italic text-gray-700 font-semibold">на 2 порции</p>
                </div>
                <!--<p class="text-brand-green mb-3 text-lg font-semibold">{{ data.weight }} грамм</p>-->
                <p class="text-gray-800 mb-5">
                    {{ data.composition }}
                </p>

                <div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div @click="decrement" class="w-8 h-8 flex items-center justify-center text-lg cursor-pointer mr-1 transparent hover:bg-brand-green-hover text-brand-green font-semibold hover:text-white border-2 border-brand-green hover:border-transparent rounded">
                                -
                            </div>
                            <span class="text-base font-semibold mr-1">{{ count }} {{ txt }}</span>
                            <div @click="increment" class="w-8 h-8 flex items-center justify-center text-lg cursor-pointer transparent hover:bg-brand-green-hover text-brand-green font-semibold hover:text-white border-2 border-brand-green hover:border-transparent rounded">
                                +
                            </div>
                        </div>
                        <div>
                            <p class="font-semibold -mb-2" :class="[count > 1 ? 'text-gray-600 oldPrice text-sm' : 'text-brand-green']"> {{ count * data.price }}₸</p>

                        </div>

                    </div>
                    <div class="mb-5 flex items-center justify-between">
                        <p class="text-base font-semibold">{{ data.weight * count }}г. на {{ 2 * count}} порции</p>
                        <p v-show="count > 1" class="font-bold text-brand-green text-xl"> {{ total }}₸</p>
                    </div>
                </div>

                <button class="w-full bg-brand-green hover:bg-brand-green-hover text-white text-sm uppercase font-bold py-2 px-4 rounded shadow focus:outline-none focus:shadow-outline inline-flex items-center justify-center"
                        @click="addToCart(data)"
                >

                    <svg class="fill-current w-4 h-4 mr-2" viewBox="0 -31 512.00033 512" xmlns="http://www.w3.org/2000/svg"><path d="m166 300.003906h271.003906c6.710938 0 12.597656-4.4375 14.414063-10.882812l60.003906-210.003906c1.289063-4.527344.40625-9.390626-2.433594-13.152344-2.84375-3.75-7.265625-5.964844-11.984375-5.964844h-365.632812l-10.722656-48.25c-1.523438-6.871094-7.617188-11.75-14.648438-11.75h-91c-8.289062 0-15 6.710938-15 15 0 8.292969 6.710938 15 15 15h78.960938l54.167968 243.75c-15.9375 6.929688-27.128906 22.792969-27.128906 41.253906 0 24.8125 20.1875 45 45 45h271.003906c8.292969 0 15-6.707031 15-15 0-8.289062-6.707031-15-15-15h-271.003906c-8.261719 0-15-6.722656-15-15s6.738281-15 15-15zm0 0"/><path d="m151 405.003906c0 24.816406 20.1875 45 45.003906 45 24.8125 0 45-20.183594 45-45 0-24.8125-20.1875-45-45-45-24.816406 0-45.003906 20.1875-45.003906 45zm0 0"/><path d="m362.003906 405.003906c0 24.816406 20.1875 45 45 45 24.816406 0 45-20.183594 45-45 0-24.8125-20.183594-45-45-45-24.8125 0-45 20.1875-45 45zm0 0"/></svg>
                    <span>Добавить в корзину</span>
                </button>
            </div>
            <button @click="close" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-400 focus:text-blue-500 focus:outline-none">
                <svg class="h-8 w-8 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductModal",
        props: ['show', 'data'],
        data(){
            return{
                count: 1,
                totalPrice: 0,
                activeSet: 0,
                active: 'bg-brand-green hover:bg-brand-green-hover shadow-lg',
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
        methods:{
            addToCart(item){
                item.q = this.count
                item.total = this.totalPrice
                this.$store.commit('addToCart', item);
                this.activeSet = 0
                this.close()
            },
            close(){
                this.count = 1
                this.$emit('close')
            },
            increment(){
                this.count++
            },
            decrement(){
                if (this.count > 1) this.count--
            }
        },
        computed: {
            txt(){
                let n = this.count % 10;
                if (n === 1 && this.count !== 11){
                    return 'набор'
                }else{
                    if ((n === 2 || n === 3 || n === 4) && (this.count < 12 || this.count > 14)){
                        return 'набора'
                    }
                    return 'наборов'
                }
            },
            total(){
                if (this.count === 1){
                    this.totalPrice = this.data.price
                    return this.data.price
                }else if(this.count === 2){
                    this.totalPrice = this.count * (this.data.price - 400)
                    return this.count * (this.data.price - 400)
                }else{
                    this.totalPrice = this.count * (this.data.price - 800)
                    return this.count * (this.data.price - 800)
                }
            }
        }
    }
</script>

