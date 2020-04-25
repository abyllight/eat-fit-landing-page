<template>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-3">
            <h3 class="text-center font-bold text-3xl lg:text-4xl mb-10">Eat&Chill</h3>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full px-4 md:w-1/3 lg:w-1/4 relative" v-for="product in products" :key="product.id">
                    <img :src="product.imageFront" class="rounded shadow-lg object-cover object-center">
                    <div class="bg-gray-700 opacity-50 rounded px-3 py-2 w-64 absolute z-10 bb">
                        <p class="font-semibold text-gray-900 leading-tight text-lg mb-2">{{ product.title }}</p>
                        <!--<p>от {{ product.price }}тг.</p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .bb{
        bottom: 0;
        left: 50%;
        transform: translate(-50%, 0);
    }
</style>
<script>
    export default {
        name: "ProductsList",
        data(){
            return{
                products: [
                    {
                        id: 0,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a1.jpg',
                        imageBack: '/img/products/b1.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3500
                    },
                    {
                        id: 1,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a2.jpg',
                        imageBack: '/img/products/b2.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3500
                    },
                    {
                        id: 2,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a3.jpg',
                        imageBack: '/img/products/b3.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3500
                    },
                    {
                        id: 3,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a4.jpg',
                        imageBack: '/img/products/b4.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3500
                    },
                    /*{
                        id: 4,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a5.jpg',
                        imageBack: '/img/products/b5.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3500
                    },
                    {
                        id: 5,
                        title: 'Курица терияки с "цветным" рисом',
                        imageFront: '/img/products/a6.jpg',
                        imageBack: '/img/products/b6.jpg',
                        weight: 1000,
                        composition: 'Рис, кукуруза, горошек, масло сливочное, молоко, куриное филе, перец болгарский, морковь, соус «Терияки», кунжут черный, соль, перец',
                        price: 3500
                    }*/
                ]
            }
        }
    }
</script>

