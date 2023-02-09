<template>
    <div class="py-24">
        <div class="max-w-2xl mx-auto px-2 relative">
            <h1 class="text-xl lg:text-2xl text-center font-semibold mb-1">EatFitGo</h1>
            <p class="text-center mb-8">Полезные блюда с доставкой по Астане и Алмате</p>
            <div class="flex flex-wrap justify-start mx-auto">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="w-1/3 relative p-2 md:p-3 lg:p-4"
                >
                    <div class="mb-3 relative">
                        <img
                            :src="'/storage/' + product.image"
                            class="rounded-lg mx-auto shadow-md object-cover object-center cursor-pointer transform transition duration-100 hover:scale-105"
                            @click="showModal(product)">
                        <div v-if="isSunday || cantBuy" class="absolute top-0 rounded-lg opacity-50 w-full h-full bg-gray-200 z-10">
                        </div>
                    </div>

                    <p
                        @click="showModal(product)"
                        class="leading-tight text-center md:text-left cursor-pointer font-medium text-sm md:text-base line-clamp-2 h-9 md:h-11 lg:h-12 mb-2">
                        {{ product.title }}
                    </p>

                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div
                            @click="showModal(product)"
                            class="leading-tight text-sm text-center md:text-left md:text-base rounded px-4 py-1"
                            :class="[isInCart(product.id) && !isSunday && !cantBuy  ? 'bg-transparent' : isSunday || cantBuy ? 'bg-gray-100 cursor-not-allowed' : 'bg-yellow-100 hover:bg-yellow-200 cursor-pointer']">
                            {{ product.price }}₸
                        </div>

                        <div
                            v-show="isInCart(product.id) && !isSunday && !cantBuy"
                            class="flex items-center justify-between w-20 md:w-24 mt-2 md:mt-0 mx-auto md:mx-0">
                            <div
                                @click="decrement(product.id)"
                                class="cursor-pointer rounded h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center">
                                <img src="/img/icons/remove.svg">
                            </div>

                            <span class="font-semibold text-sm md:text-lg">
                                {{ $store.getters.getItemCount(product.id) }}
                            </span>

                            <div
                                @click="increment(product.id)"
                                class="cursor-pointer rounded h-6 w-6 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center">
                                <img src="/img/icons/add.svg">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div v-if="isSunday" class="max-w-md mx-auto bg-gray-800 text-white text-sm py-4 px-4 shadow fixed bottom-6 lg:bottom-8 z-50 rounded inset-x-3">
                К сожалению, доставка на воскресенье не осуществляется. Но это временно ;)
            </div>

            <div v-if="cantBuy && !isSunday" class="max-w-md mx-auto bg-gray-800 text-white text-sm py-4 px-4 shadow fixed bottom-6 lg:bottom-8 z-50 rounded inset-x-3">
                Прием заказов осуществляется только c 10:00 до 18:00
            </div>
        </div>

        <product-modal :show = "showProductModal" :data = "products.length > 0 ? chosenProduct : []"  @close="showProductModal = false"></product-modal>
    </div>
</template>
<script>
    import ProductModal from "./ProductModal";
    import {mapState} from "vuex";
    export default {
        name: "ProductsList",
        components: {
            ProductModal
        },
        data(){
            return{
                showProductModal: false,
                chosenProduct: [],
                products: [],
                active: ''
            }
        },
        mounted() {
            this.getProducts();
        },
        computed: {
            ...mapState(['cart']),
            count() {
                return this.$store.getters.getItemCount(this.data.id)
            },
            isSunday() {
                return new Date().getDay() === 6
            },
            cantBuy() {
                return new Date().getHours() >= 20 || new Date().getHours() < 10
            }
        },
        methods: {
            isInCart(id){
                return this.$store.getters.hasItem(id)
            },
            showModal(product){
                if (this.isSunday) return
                this.showProductModal = true
                this.chosenProduct = product
            },
            increment(id){
                this.$store.dispatch('increment', id);
            },
            decrement(id){
                this.$store.dispatch('decrement', id);
            },
            getProducts(){
                axios.get('/products')
                    .then((response) => {
                        this.products = response.data
                    });
            }
        }
    }
</script>

