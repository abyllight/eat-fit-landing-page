<template>
    <div v-show="show" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-sm bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 py-6 sm:p-6">
                <h3 class="text-lg leading-6 font-semibold mb-1">
                    {{ data.title }}
                </h3>
                <div class="text-sm text-gray-700 mb-4 flex">
                    <p class="mr-3">{{ data.weight }} г</p>
                    <p>{{ data.kcal }} ккал</p>
                </div>

                <p class="mb-8">
                    {{ data.composition }}
                </p>

                <div class="flex items-center justify-center">
                    <button
                        v-if="!isInCart"
                        class="w-40 bg-yellow-300 mr-5 hover:bg-yellow-400 text-tiny uppercase font-semibold p-3 rounded shadow focus:outline-none focus:shadow-outline inline-flex items-center justify-center"
                        @click="addToCart(data)"
                    >
                        <svg class="fill-current w-4 h-4 mr-2" viewBox="0 -31 512.00033 512" xmlns="http://www.w3.org/2000/svg"><path d="m166 300.003906h271.003906c6.710938 0 12.597656-4.4375 14.414063-10.882812l60.003906-210.003906c1.289063-4.527344.40625-9.390626-2.433594-13.152344-2.84375-3.75-7.265625-5.964844-11.984375-5.964844h-365.632812l-10.722656-48.25c-1.523438-6.871094-7.617188-11.75-14.648438-11.75h-91c-8.289062 0-15 6.710938-15 15 0 8.292969 6.710938 15 15 15h78.960938l54.167968 243.75c-15.9375 6.929688-27.128906 22.792969-27.128906 41.253906 0 24.8125 20.1875 45 45 45h271.003906c8.292969 0 15-6.707031 15-15 0-8.289062-6.707031-15-15-15h-271.003906c-8.261719 0-15-6.722656-15-15s6.738281-15 15-15zm0 0"/><path d="m151 405.003906c0 24.816406 20.1875 45 45.003906 45 24.8125 0 45-20.183594 45-45 0-24.8125-20.1875-45-45-45-24.816406 0-45.003906 20.1875-45.003906 45zm0 0"/><path d="m362.003906 405.003906c0 24.816406 20.1875 45 45 45 24.816406 0 45-20.183594 45-45 0-24.8125-20.183594-45-45-45-24.8125 0-45 20.1875-45 45zm0 0"/></svg>
                        <span>В корзину</span>
                    </button>

                    <div
                        v-else
                        class="flex items-center justify-between w-24 mr-5">
                        <div class="cursor-pointer rounded-lg h-8 w-8 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center"
                             @click="decrement">
                            <img src="/img/icons/remove.svg" width="24">
                        </div>

                        <span class="text-xl font-semibold">{{ count }}</span>

                        <div class="cursor-pointer rounded-lg h-8 w-8 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center"
                             @click="increment">
                            <img src="/img/icons/add.svg" width="24">
                        </div>
                    </div>
                    <div>
                        <p class="text-xl"> {{ total > 0 ? total : data.price }}₸ </p>
                    </div>
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
    import {mapState} from "vuex";
    export default {
        name: "ProductModal",
        props: ['show', 'data'],
        computed: {
            ...mapState(['cart']),
            isInCart() {
                return this.$store.getters.hasItem(this.data.id)
            },
            total() {
                return this.$store.getters.getItemTotal(this.data.id)
            },
            count() {
                return this.$store.getters.getItemCount(this.data.id)
            }
        },
        methods:{
            close(){
                this.$emit('close')
            },
            addToCart(){
                this.$store.dispatch('addToCart', {
                    id: this.data.id,
                    image: this.data.image,
                    price: this.data.price,
                    q: 1,
                    total: this.data.price
                });
            },
            increment(){
                this.$store.dispatch('increment', this.data.id);
            },
            decrement(){
                this.$store.dispatch('decrement', this.data.id);
            }
        }
    }
</script>

