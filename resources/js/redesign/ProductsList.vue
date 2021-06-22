<template>
    <div class="py-24">
        <div class="max-w-3xl mx-auto px-2">
            <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8">EatFitGo</h1>
            <div class="flex flex-wrap justify-start mx-auto">
                <div
                    v-for="product in products"
                    :key="product.id"
                    class="w-1/3 relative p-2 md:p-3 lg:p-4"
                >
                    <div class="mb-2">
                        <img
                            :src="'/storage/' + product.image"
                            class="rounded-lg mx-auto shadow object-cover object-center cursor-pointer transform transition duration-100 hover:scale-105"
                            @click="showModal(product)">
                    </div>
                    <p class="leading-tight text-xs md:text-base font-semibold line-clamp-2 mb-2">{{ product.title }}</p>

                    <div class="flex justify-between">
                        <p class="leading-tight text-xs md:text-base">{{ product.price }}₸</p>
                        <div
                            v-if="!isInCart(product.id)"
                            @click="showModal(product)"
                            class="rounded-full h-7 w-7 -mt-2 md:h-auto md:w-auto md:text-tiny font-semibold uppercase md:px-4 md:py-2 cursor-pointer bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center">
                            <p class="hidden md:block">Выбрать</p>
                            <img src="/img/icons/add.svg" width="20" class="md:hidden">
                        </div>
                    </div>
                    <div
                        v-show="isInCart(product.id)"
                        class="flex items-center justify-between w-20 md:w-24 mt-2">
                        <div
                            @click="decrement(product.id)"
                            class="cursor-pointer rounded h-5 w-5 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center">
                            <img src="/img/icons/remove.svg">
                        </div>

                        <span class="font-semibold text-sm md:text-lg">
                                {{ $store.getters.getItemCount(product.id) }}
                            </span>

                        <div
                            @click="increment(product.id)"
                            class="cursor-pointer rounded h-5 w-5 md:h-7 md:w-7 bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center">
                            <img src="/img/icons/add.svg">
                        </div>
                    </div>
                </div>
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
                products: []
            }
        },
        mounted() {
            this.getProducts();
        },
        computed: {
            ...mapState(['cart']),
            count() {
                return this.$store.getters.getItemCount(this.data.id)
            }
        },
        methods: {
            isInCart(id){
                return this.$store.getters.hasItem(id)
            },
            showModal(product){
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

