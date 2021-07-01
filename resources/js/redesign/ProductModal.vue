<template>
    <div v-show="show" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-sm bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 py-6 sm:p-6">
                <h3 class="text-xl leading-6 font-semibold mb-2">
                    {{ data.title }}
                </h3>
                <VueSlickCarousel ref="slick" v-bind="settings">
                    <div>
                        <img :src="'/storage/' + data.image" class="w-56 rounded mx-auto object-cover object-center">
                    </div>
                    <div>
                        <div class="text-sm text-gray-800 mb-4 flex justify-between">
                            <div v-if="data.weight">
                                <p class="-mb-1">{{ data.weight }}</p>
                                <p class="font-semibold">Вес</p>
                            </div>
                            <div v-if="data.kcal">
                                <p class="-mb-1">{{ data.kcal }}</p>
                                <p class="font-semibold">Ккал</p>
                            </div>
                            <div v-if="data.protein">
                                <p class="-mb-1">{{ data.protein }}</p>
                                <p class="font-semibold">Белки</p>
                            </div>
                            <div v-if="data.fat">
                                <p class="-mb-1">{{ data.fat }}</p>
                                <p class="font-semibold">Жиры</p>
                            </div>
                            <div v-if="data.carbohydrate">
                                <p class="-mb-1">{{ data.carbohydrate }}</p>
                                <p class="font-semibold">Углеводы</p>
                            </div>
                        </div>

                        <p class="mb-4">
                            {{ data.composition }}
                        </p>
                    </div>

                </VueSlickCarousel>
                <div class="flex items-center justify-center mt-12">
                    <button
                        v-if="!isInCart"
                        class="w-40 bg-yellow-300 mr-5 hover:bg-yellow-400 text-xs uppercase font-semibold p-3 rounded shadow focus:outline-none focus:shadow-outline flex items-center justify-center"
                        @click="addToCart(data)"
                    >
                        <img src="/img/icons/add.svg" width="18" class="mr-2">
                        <span>Добавить</span>
                    </button>

                    <div
                        v-else
                        class="flex items-center justify-between w-24 mr-5">
                        <div class="cursor-pointer rounded-lg h-8 w-8 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center"
                             @click="decrement">
                            <img src="/img/icons/remove.svg" width="24">
                        </div>

                        <span class="text-xl font-semibold">{{ count }}</span>

                        <div class="cursor-pointer rounded-lg h-8 w-8 bg-yellow-300 hover:bg-yellow-400 focus:outline-none flex justify-center items-center"
                             @click="increment">
                            <img src="/img/icons/add.svg" width="24">
                        </div>
                    </div>
                    <div>
                        <p class="text-xl"> {{ total > 0 ? total : data.price }}₸ </p>
                    </div>
                </div>
                <div
                    v-if="isInCart"
                    class="hidden lg:block mt-10 flex justify-center items-center">
                    <button
                        class="bg-yellow-300 hover:bg-yellow-400 rounded text-xs uppercase font-semibold py-3 px-5 focus:outline-none focus:shadow-outline inline-flex items-center justify-center"
                        @click="close"
                    >
                        Добавить в корзину
                    </button>
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
    import VueSlickCarousel from 'vue-slick-carousel'
    import 'vue-slick-carousel/dist/vue-slick-carousel.css'
    import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'
    export default {
        name: "ProductModal",
        props: ['show', 'data'],
        components: {
            VueSlickCarousel
        },
        data() {
          return {
              settings: {
                  "dots": true,
                  "initialSlide": 0,
                  "edgeFriction": 0.35,
                  "infinite": false,
                  "focusOnSelect": true,
                  "slidesToShow": 1,
                  "speed": 500
              },
              products: [
                  {
                      id: 0,
                      amo_id: '',
                  }
              ]
          }
        },
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
                    title: this.data.title,
                    image: this.data.image,
                    weight: this.data.weight,
                    price: this.data.price,
                    wholesale: this.data.wholesale,
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

