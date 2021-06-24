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
                    <div class="mb-3 relative">
                        <img
                            :src="'/storage/' + product.image"
                            class="rounded-lg mx-auto shadow-md object-cover object-center cursor-pointer transform transition duration-100 hover:scale-105"
                            @click="showModal(product)">

                        <div
                            v-if="!isInCart(product.id)"
                            @click="showModal(product)"
                            class="rounded-full h-7 w-7 md:h-10 md:w-10 absolute -right-3 -bottom-3 cursor-pointer bg-yellow-300 hover:bg-yellow-400 flex justify-center items-center">
                            <img src="/img/icons/add.svg" class="w-6 md:w-10">
                        </div>
                    </div>

                    <p
                        @click="showModal(product)"
                        class="leading-tight text-center md:text-left cursor-pointer font-medium text-sm md:text-lg line-clamp-2 h-9 md:h-11 lg:h-12 mb-2">
                        {{ product.title }}
                    </p>

                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <p class="leading-tight text-sm text-center md:text-left md:text-lg">{{ product.price }}₸</p>
                        <div
                            v-show="isInCart(product.id)"
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

