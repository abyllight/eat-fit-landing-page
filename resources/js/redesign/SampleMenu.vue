<template>
        <div class="max-w-6xl mx-auto px-5">
            <h3 class="text-xl lg:text-2xl text-center font-semibold mb-8 lg:mb-16 px-5">Пример рациона на 1500 ккал</h3>
            <carousel :perPageCustom="[[320, 1]]"
                      :mouseDrag="true"
                      :paginationActiveColor="'#74ab31'"
                      :paginationColor="'#222222'"
            >
                <slide v-for="sample in samples" :key="sample.id" class="">
                    <div class="flex flex-col justify-around md:flex-row md:items-center max-w-5xl mx-auto">
                        <img
                            :src="sample.img"
                            :alt="sample.type"
                            class="w-auto object-cover md:w-1/2 object-center shadow-md rounded mb-3 cursor-pointer">
                        <div class="md:ml-10 md:w-1/2">
                            <div class="text-brand-dark-green inline-block text-xs uppercase font-medium mb-3">{{ sample.type }}</div>

                            <div v-for="content in sample.contents" class="mb-4">
                                <div class="mb-2 flex items-center cursor-pointer">
                                    <p class="text-lg font-medium leading-tight mr-3" @click="showIngredients(sample.id, content.id)">{{ content.title }}</p>
                                    <div v-show="sample.contents.length > 1">
                                        <img :src="content.isVisible === true ? '/img/icons/down-chevron.svg' : '/img/icons/right-chevron.svg'" class="w-4 h-3" alt="Whatsapp">
                                    </div>
                                </div>

                                <div v-show="sample.contents.length === 1 || content.isVisible">
                                    <p class="font-light leading-tight mb-5 text-sm">{{ content.ingredients }}</p>
                                    <div class="flex">
                                        <div class="mr-12">
                                            <span class="text-brand-dark-green text-xl md:text-2xl">{{ content.b }} г</span>
                                            <p class="text-sm">Белки</p>
                                        </div>
                                        <div class="mr-12">
                                            <span class="text-brand-dark-green text-xl md:text-2xl">{{ content.j }} г</span>
                                            <p class="text-sm">Жиры</p>
                                        </div>
                                        <div>
                                            <span class="text-brand-dark-green text-xl md:text-2xl">{{ content.u }} г</span>
                                            <p class="text-sm">Углеводы</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </slide>
            </carousel>
        </div>
</template>

<style>
</style>

<script>
import { Carousel, Slide } from 'vue-carousel'
export default {
    name: 'sample',
    components: {
        Carousel,
        Slide
    },
    data(){
        return{
            samples: [
                {
                    id:0,
                    type:'Завтрак I',
                    img:'img/sample/z1.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Овсяные блины',
                            ingredients:'Хлопья овсяные, яйцо, молоко, лист салата, огурцы, сыр Креметта',
                            b:10.1,
                            j:21.5,
                            u:27.1,
                            isVisible: true
                        }
                    ]
                },
                {
                    id:1,
                    type:'Завтрак II',
                    img:'img/sample/z2.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Омлет Пуляр',
                            ingredients:'Яйцо, сыр Джугас, стручковая фасоль, шампиньон, морковь, петрушка, укроп, тыква',
                            b:12.2,
                            j:12.9,
                            u:8.7,
                            isVisible: true
                        }
                    ]
                },
                {
                    id:2,
                    type:'Обед',
                    img:'img/sample/obed.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Тыквенный суп с семечками',
                            ingredients:'Тыква, картофель, лук, вода, сливки, тыквенные семечки, микрозелень, соль, перец',
                            b:3.3,
                            j:4.9,
                            u:14.3,
                            isVisible: true
                        },
                        {
                            id:1,
                            title:'Стейк из говядины с картофелем по-деревенски',
                            ingredients:'Говядина, картофель, зелень, чеснок, лук',
                            b:19.6,
                            j:10.9,
                            u:29.2,
                            isVisible: false
                        },
                    ]
                },
                {
                    id:3,
                    type:'Полдник',
                    img:'img/sample/poldnik.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Запеканка творожная',
                            ingredients:'Мука кукурузная, творог, яйцо, изюм',
                            b:12.5,
                            j:6.7,
                            u:26.5,
                            isVisible: true
                        }
                    ]
                },
                {
                    id:4,
                    type:'Ужин',
                    img:'img/sample/ujin.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Курочка Баффало с цветным рисом',
                            ingredients:'Куриное филе, базилик, баклажан, кабачки, лук, горох зеленый, кукуруза',
                            b:29.9,
                            j:11.3,
                            u:40.4,
                            isVisible: true
                        }
                    ]
                }
            ]
        }
    },
    methods: {
        showIngredients(s_id, c_id){
            this.samples[s_id].contents[c_id].isVisible = !this.samples[s_id].contents[c_id].isVisible

            let contents = this.samples[s_id].contents;
            for (let i = 0;i < contents.length; i++){
                if (contents[i].id !== c_id){
                    contents[i].isVisible = false
                }
            }
        }
    }
}
</script>
