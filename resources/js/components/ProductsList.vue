<template>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-3">
            <h3 class="text-center font-bold text-3xl lg:text-4xl mb-8">Eat&Chill</h3>
            <div class="flex flex-wrap -mx-3">
                <div class="mt-4 w-full px-4 md:w-1/3 lg:w-1/4 relative" v-for="product in products" :key="product.id">
                    <img :src="product.imageFront" class="rounded shadow-xl object-cover object-center">
                    <div class="rounded px-3 py-2 w-full md:w-56 lg:w-64">
                        <p class="font-semibold text-gray-900 leading-tight text-lg mb-5">{{ product.title }}</p>
                        <div class="flex items-center justify-between">
                            <p class="font-normal text-lg text-gray-800">от {{ product.price }}тг.</p>
                            <button @click="showModal(product.id)" class="px-3 py-2 mr-1 md:mr-2 text-white text-xs uppercase font-semibold bg-brand-green shadow hover:bg-brand-green-hover rounded focus:outline-none">
                                выбрать
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <product-modal :show = "showProductModal" :data = "products[chosenProduct]"  @close="showProductModal = false"></product-modal>
    </div>
</template>
<style scoped>

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
                products: [
                    {
                        id: 0,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a1.jpg',
                        imageBack: '/img/products/b1.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3000,
                        q: 1,
                        total: 3000,
                        isActive: true
                    },
                    {
                        id: 1,
                        title: 'Стейк по-милански с кус-кусом',
                        imageFront: '/img/products/a2.jpg',
                        imageBack: '/img/products/b2.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3000,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 2,
                        title: 'Фарфалле с красной рыбой',
                        imageFront: '/img/products/a3.jpg',
                        imageBack: '/img/products/b3.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3000,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 3,
                        title: 'Спагетти неро под соусом Болонеьезе',
                        imageFront: '/img/products/a4.jpg',
                        imageBack: '/img/products/b4.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3000,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 4,
                        title: 'Папарделле с Чикен Альфредо',
                        imageFront: '/img/products/a5.jpg',
                        imageBack: '/img/products/b5.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3000,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 5,
                        title: 'Том ям с морским коктейлем и ассорти гриб',
                        imageFront: '/img/products/a6.jpg',
                        imageBack: '/img/products/b6.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3000,
                        q: 1,
                        total: 3000,
                        isActive: false
                    }
                ]
            }
        },
        methods: {
            showModal(id){
                this.showProductModal = true
                this.chosenProduct = id
            }
        }
    }
</script>

