<template>
    <div class="py-8">
        <div class="max-w-6xl mx-auto px-3">
            <h3 class="text-center font-bold text-3xl lg:text-4xl mb-8">Отзывы</h3>
            <carousel :perPageCustom="[[320, 1], [768, 3], [1024, 4]]" :centerMode="true"
                      :mouseDrag="true"
                      :paginationActiveColor="'#74ab31'"
            >
                <slide v-for="post in posts" :key="post.id" data-url="post.url" @slideclick="openLink(post.url)">
                    <img :src="post.imageUrl" class="w-64 mx-auto shadow-lg rounded mb-3 cursor-pointer">
                </slide>
            </carousel>
        </div>
    </div>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel'
    export default {
        name: "Instagram",
        components: {
            Carousel,
            Slide
        },
        data(){
            return{
                posts: [
                    {
                        id: 0,
                        url: 'https://www.instagram.com/p/B4emIhBAisP/?igshid=hy2pwjd0gup2',
                        imageUrl: 'img/instagram/r1.PNG.jpg'
                    },
                    {
                        id: 1,
                        url: 'https://www.instagram.com/p/B4OlOZLJnAV/?igshid=b6y6te4xo68q',
                        imageUrl: 'img/instagram/r2.PNG.jpg'
                    },
                    {
                        id: 2,
                        url: 'https://www.instagram.com/p/B1bVWzzJ-FR/?igshid=56tt7e04hsfa',
                        imageUrl: 'img/instagram/r3.PNG.jpg'
                    },
                    {
                        id: 3,
                        url: 'https://www.instagram.com/p/B0OLwOFnFLa/?igshid=1fv52b5vk6d6g',
                        imageUrl: 'img/instagram/r4.PNG.jpg'
                    },
                    {
                        id: 4,
                        url: 'https://www.instagram.com/p/BpecZFTgY79/?igshid=1dxifgttdg5e6',
                        imageUrl: 'img/instagram/r5.PNG.jpg'
                    },
                    {
                        id: 5,
                        url: 'https://www.instagram.com/p/BlpgrKznUke/?igshid=y6u7at9lbmg8',
                        imageUrl: 'img/instagram/r6.PNG.jpg'
                    },
                    {
                        id: 6,
                        url: 'https://www.instagram.com/p/BdVCHCCnmBu/?igshid=1fal0xkqhdqq9',
                        imageUrl: 'img/instagram/r7.PNG.jpg'
                    },
                    {
                        id: 7,
                        url: 'https://www.instagram.com/p/BbCXId3DmWk/?igshid=eotwfrxepw24',
                        imageUrl: 'img/instagram/r8.PNG.jpg'
                    },
                    {
                        id: 8,
                        url: 'https://www.instagram.com/p/BarIEKkFppP/?igshid=12q0zykr0dapx',
                        imageUrl: 'img/instagram/r9.PNG.jpg'
                    },
                ]
            }
        },
        methods: {
            openLink(dataset){
              window.open(dataset)
            }
        }
    }
</script>

<style scoped>

</style>
