<template>
    <div class="py-24">
        <div class="max-w-2xl mx-auto px-2 relative">
            <h1 class="text-xl lg:text-2xl text-center font-semibold mb-1">EatFitGo</h1>
            <p class="text-center">Полезные блюда с доставкой по Астане и Алмате</p>
            <p class="text-xs text-center mb-5">*Минимальная сумма заказа для наших партнеров 10 000 тенге</p>

            <img src="/img/eatfitgohero2.jpg" class="rounded h-40 md:h-64 lg:h-80 w-full object-cover object-center mb-10" alt="image"/>

            <div class="max-w-sm mx-auto flex justify-center mb-8">
                <button v-for="type in types"
                        :key="type.id"
                        @click.stop="setCity(type.id)"
                        class="px-5 py-3 rounded focus:outline-none text-xs uppercase font-semibold"
                        :class="[type.id === city ? active : non_active, type.id === 1 ? 'mr-2 md:mr-3' : '']"
                >
                    {{ type.title }}
                </button>
            </div>
            <div class="flex flex-wrap justify-start mx-auto">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="w-1/3 relative p-2 md:p-3 lg:p-4"
                >
                    <div class="mb-3 relative">
                        <img
                            :src="'https://admin.eatandchill.kz' + product.image"
                            class="rounded-lg mx-auto shadow-md object-cover object-center cursor-pointer h-40 w-full transform transition duration-100 hover:scale-105"
                            @click="showModal(product)">
                        <div v-if="isSunday || cantBuyAstana || cantBuyAlmaty" class="absolute top-0 rounded-lg opacity-50 w-full h-full bg-gray-200 z-10">
                        </div>
                    </div>

                    <p
                        @click="showModal(product)"
                        class="leading-tight text-center md:text-left cursor-pointer font-medium text-sm md:text-base h-9 md:h-11 lg:h-14 mb-2">
                        {{ product.name }}
                    </p>

                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div
                            @click="showModal(product)"
                            class="leading-tight text-sm text-center md:text-left md:text-base rounded px-4 py-1"
                            :class="[isInCart(product.id) && !isSunday && (!cantBuyAstana || !cantBuyAlmaty)  ? 'bg-transparent' : isSunday || cantBuyAstana || cantBuyAlmaty ? 'bg-gray-100 cursor-not-allowed' : 'bg-yellow-100 hover:bg-yellow-200 cursor-pointer']">
                            {{ product.price }}₸
                        </div>

                        <div
                            v-show="isInCart(product.id) && !isSunday && (!cantBuyAstana || !cantBuyAlmaty)"
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
            <div v-if="isSunday" class="max-w-md mx-auto bg-yellow-500 text-white text-sm py-4 px-4 shadow fixed bottom-6 lg:bottom-8 z-50 rounded inset-x-3">
                К сожалению, доставка на воскресенье не осуществляется. Но это временно ;)
            </div>

            <div v-if="cantBuyAstana && !isSunday" class="max-w-md mx-auto bg-yellow-500 text-white text-sm py-4 px-4 shadow fixed bottom-6 lg:bottom-32 z-50 rounded inset-x-3">
                Прием заказов по Астане осуществляется только c 10:00 до 18:00
            </div>

            <div v-if="cantBuyAlmaty && !isSunday" class="max-w-md mx-auto bg-yellow-500 text-white text-sm py-4 px-4 shadow fixed bottom-6 lg:bottom-32 z-50 rounded inset-x-3">
                Прием заказов по Алмате осуществляется только c 10:00 до 21:00
            </div>
        </div>

        <product-modal :show = "showProductModal" :data = "products.length > 0 ? chosenProduct : []"  @close="showProductModal = false"></product-modal>
    </div>
</template>
<script>
    import ProductModal from "./ProductModal";
    import {mapGetters, mapState} from "vuex";
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
                active: 'bg-brand-yellow shadow-lg',
                non_active: 'bg-gray-300 hover:bg-gray-200',
                types: [
                    {
                        id: 1,
                        title: 'Астана'
                    },
                    {
                        id: 2,
                        title: 'Алматы'
                    }
                ],
            }
        },
        mounted() {
            this.getProducts();
        },
        computed: {
            ...mapState(['cart']),
            ...mapGetters({city: 'getCity'}),
            count() {
                return this.$store.getters.getItemCount(this.data.id)
            },
            isSunday() {
                return new Date().getDay() === 6
            },
            cantBuyAstana() {
                return this.city === 1 && (new Date().getHours() >= 18 || new Date().getHours() < 10)
            },
            cantBuyAlmaty() {
                return this.city === 2 && (new Date().getHours() >= 21 || new Date().getHours() < 10)
            },
            cantBuy() {
                return this.isSunday()
            }
        },
        methods: {
            setCity(val) {
                this.$store.dispatch('setCity', val)
            },
            isInCart(id){
                return this.$store.getters.hasItem(id)
            },
            showModal(product){
                if (this.isSunday || this.cantBuyAstana || this.cantBuyAlmaty) return
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
                axios.get('https://admin.eatandchill.kz/api/products-all', {
                    params: {
                        brandId: 2
                    }
                })
                    .then((response) => {
                        this.products = response.data.data
                    });
            }
        }
    }
</script>

