<template>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-3">
            <h3 class="text-center font-bold text-3xl lg:text-4xl mb-8">Eat&Chill</h3>
            <div class="flex flex-no-wrap md:flex-wrap overflow-x-auto scrollClass -mx-3">
                <div class="mb-10 px-4 w-full md:w-1/3 lg:w-1/4 relative" v-for="product in products" :key="product.id">
                    <div class="wrap w-64">
                        <div class="front" :class="[product.isActive ? 'rotateF' : '']">
                            <img :src="product.imageFront" class="rounded shadow-xl object-cover object-center">
                        </div>
                        <div class="back" :class="[product.isActive ? 'rotateB' : '']">
                            <img :src="product.imageBack" class="rounded shadow-xl object-cover object-center">
                        </div>
                    </div>

                    <div class="rounded px-3 py-2 w-full md:w-56 lg:w-64">
                        <p class="font-semibold text-gray-900 leading-tight text-lg mb-5">{{ product.title }}</p>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-700 leading-4">от <span class="text-xl font-black text-gray-800">{{ product.pricePerItem }}₸</span> <br> за порцию</p>
                            <button @click="showModal(product.id)" class="px-3 py-2 mr-1 md:mr-2 text-white text-xs uppercase font-semibold bg-brand-green shadow hover:bg-brand-green-hover rounded focus:outline-none">
                                выбрать
                            </button>
                        </div>
                    </div>
                    <div @click.prevent="product.isActive=!product.isActive" class="absolute z-20 top-0 right-0 px-3 py-2 rounded mt-3 mr-8 bg-gray-800 opacity-75 hover:bg-gray-700 cursor-pointer">
                        <img src="/img/icons/return.svg" class="w-4 h-4">
                    </div>
                </div>
            </div>
        </div>
        <product-modal :show = "showProductModal" :data = "products[chosenProduct]"  @close="showProductModal = false"></product-modal>
    </div>
</template>
<style scoped>
    .wrap{
        position: relative;
        perspective: 1000px;
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
                products: [
                    {
                        id: 0,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a1.jpg',
                        imageBack: '/img/products/b1.jpg',
                        weight: 900,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, филиное куре, перец, болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3000,
                        pricePerItem: 1100,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 1,
                        title: 'Стейк по-милански',
                        imageFront: '/img/products/a7.jpg',
                        imageBack: '/img/products/b7_2.jpg',
                        weight: 1000,
                        composition: 'Оссобуко, розмарин, смесь перцев, мука, морковь, лук репчатый, чеснок, сельдерей, демигласс, красное сухое вино, ворчестер, тимьян, базилик, кус-кус, мексиканская смесь, соль морская',
                        price: 4000,
                        pricePerItem: 1600,
                        q: 1,
                        total: 4000,
                        isActive: false
                    },
                    {
                        id: 2,
                        title: 'Фарфале с красной рыбой в сливочном соусе',
                        imageFront: '/img/products/a3.jpg',
                        imageBack: '/img/products/b3.jpg',
                        weight: 900,
                        composition: 'Фарфале, кета, сливки, кабачок, сыр «Джугас», петроп и укрушка, соль, перец',
                        price: 3000,
                        pricePerItem: 1100,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 3,
                        title: 'Спагетти неро под соусом Болонеьезе',
                        imageFront: '/img/products/a4.jpg',
                        imageBack: '/img/products/b4.jpg',
                        weight: 800,
                        composition: 'Спагетти неро, фарш говяжий, лук, морковь, стебель сельдерея, чеснок, томаты пилати, сыр пармезан, базилик,  орегано, соль, перец ',
                        price: 3000,
                        pricePerItem: 1100,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 4,
                        title: 'Папарделле с Чикен Альфредо',
                        imageFront: '/img/products/a5.jpg',
                        imageBack: '/img/products/b5.jpg',
                        weight: 900,
                        composition: 'Филиное куре, гарам-масала, микс 5 перцев, оливковое масло, грибы вешенки, сыр Креметте, сыр Джугас, сливки, масло сливочное, орех мускатный, соль, перец',
                        price: 3000,
                        pricePerItem: 1100,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 5,
                        title: 'Том ям с морским коктейлем',
                        imageFront: '/img/products/a6.jpg',
                        imageBack: '/img/products/b6.jpg',
                        weight: 600,
                        composition: 'Масло подсолнечное, бульон куриный, молоко кокосовое, каффир лайма, лемонграсс, том-ям паста, шиитаке, шампиньоны, вешенки, помидоры черри, корень имбиря, креветки тигровые, морской коктейль, морская соль, щепотка любви',
                        price: 3000,
                        pricePerItem: 1100,
                        q: 1,
                        total: 3000,
                        isActive: false
                    },
                    {
                        id: 6,
                        title: 'Буйабес по-марсельски',
                        imageFront: '/img/products/a9.jpg',
                        imageBack: '/img/products/b9.jpg',
                        weight: 800,
                        composition: 'Креветка тигровая, кальмар, мидия в раковине, дорадо, форель, кета, лук порей, лук репчатый, лук марс, фенхель, картофель, стебель сельдерея, томаты пилати, белое сухое вино, чеснок, тимьян, соль морская, соус табаско',
                        price: 4000,
                        pricePerItem: 1600,
                        q: 1,
                        total: 4000,
                        isActive: false
                    },
                    {
                        id: 7,
                        title: 'Фо бо',
                        imageFront: '/img/products/a8.jpg',
                        imageBack: '/img/products/b8.jpg',
                        weight: 700,
                        composition: 'Говядина, лапша рисовая, кумин, фенхель, гвоздика, кориандр, бадьян (анис), смесь перцев, ростки соевые, лук зеленый, кинза, базилик, мята, перец чили',
                        price: 3000,
                        pricePerItem: 1100,
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
            },
            rotateCard(id){
                console.log(this.products[id].isActive)
                this.products[id].isActive = !this.products[id].isActive
            }
        }
    }
</script>

