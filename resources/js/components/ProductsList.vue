<template>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-3">
            <h3 class="text-center font-bold text-3xl lg:text-4xl mb-8">Eat&Chill</h3>
            <div class="flex flex-no-wrap md:flex-wrap overflow-x-auto scrollClass -mx-3">
                <div v-if="productList.length>0" class="px-3 py-8 w-full md:w-1/3 lg:w-1/4" v-for="product in productList" :key="product.id">
                    <div class="wrap w-64 mx-auto">
                        <div class="front" :class="[product.is_active ? 'rotateF' : '']">
                            <img :src="'/storage/'+product.image_back_url" class="rounded shadow-xl object-cover object-center">
                        </div>
                        <div class="back" :class="[product.is_active ? 'rotateB' : '']">
                            <img :src="'/storage/'+product.image_front_url" class="rounded shadow-xl object-cover object-center">
                        </div>
                        <div @click.prevent="product.is_active=!product.is_active" class="absolute z-20 top-0 right-0 px-3 py-2 rounded mt-3 mr-8 bg-gray-800 opacity-75 hover:bg-gray-700 cursor-pointer">
                            <img src="/img/icons/return.svg" class="w-4 h-4">
                        </div>
                    </div>

                    <div class="px-3 py-2 h-32 w-full md:w-56 lg:w-64 flex flex-col justify-between">
                        <p class="font-semibold text-gray-900 leading-tight text-lg mb-5">{{ product.title }}</p>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-700 leading-4">от <span class="text-xl font-black text-gray-800">{{ product.price_per_item }}₸</span> <br> за порцию</p>
                            <button @click="showModal(product.id)" class="px-3 py-2 mr-1 md:mr-2 text-white text-xs uppercase font-semibold bg-brand-green shadow hover:bg-brand-green-hover rounded focus:outline-none">
                                выбрать
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <product-modal :show = "showProductModal" :data = "productList.length > 0 ? productList[chosenProduct] : ''"  @close="showProductModal = false"></product-modal>
    </div>
</template>
<style scoped>
    .wrap{
        position: relative;
        perspective: 1500px;
    }
    .front {
        transition: 1s;
        backface-visibility: hidden;
    }
    .back{
        position: absolute;
        top: 0;
        transition: 1s;
        backface-visibility: hidden;
        transform: rotateY(180deg);
    }
    .rotateF{
        transform: rotateY(180deg);
    }
    .rotateB{
        transform: rotateY(360deg);
    }
     .scrollClass{
         -webkit-overflow-scrolling: touch; /* [3] */
         -ms-overflow-style: -ms-autohiding-scrollbar;
     }
    .scrollClass::-webkit-scrollbar{
        display: none;
    }
</style>
<script>
    import ProductModal from "./ProductModal";
    export default {
        name: "ProductsList",
        components: {
            ProductModal
        },
        data(){
            return{
                showProductModal: false,
                chosenProduct: 0,
                productList: []
            }
        },
        beforeMount() {
            this.getProducts();
        },
        methods: {
            showModal(id){
                this.showProductModal = true
                this.chosenProduct = id - 1
                console.log(this.productList[0])
            },
            rotateCard(id){
                this.productList[id].is_active = !this.productList[id].is_active
            },
            getProducts(){

                axios.get('/products')
                    .then((response) => {
                        this.productList = response.data
                    });
            }
        }
    }
</script>

