<template>
    <div id="#sample" class="bg-gray-200 py-8">
        <div class="max-w-6xl mx-auto px-3">
            <h3 class="text-center font-bold text-3xl mb-12 leading-tight">Пример рациона на день</h3>
            <carousel :perPageCustom="[[320, 1]]"
                      :mouseDrag="true"
                      :paginationActiveColor="'#74ab31'"
                      :paginationColor="'#222222'"
            >
                <slide v-for="sample in samples" :key="sample.id" class="">
                    <div class="flex flex-col md:flex-row md:items-center max-w-3xl mx-auto">
                        <img :src="sample.img" class="w-64 shadow-md rounded mb-3 cursor-pointer">
                        <div class="md:ml-10">
                            <div class="text-pink-800 inline-block text-xs uppercase font-medium">{{ sample.type }}</div>

                            <div v-for="content in sample.contents" class="mb-4">
                                <div class="mb-5 flex items-center cursor-pointer">
                                    <p class="text-xl font-medium leading-tight mr-3" @click="showIngredients(sample.id, content.id)">{{ content.title }}</p>
                                    <div v-show="sample.contents.length > 1">
                                        <img :src="content.isVisible === true ? '/img/icons/down-chevron.svg' : '/img/icons/right-chevron.svg'" class="w-4 h-3" alt="Whatsapp">
                                    </div>
                                </div>

                                <div v-show="sample.contents.length === 1 || content.isVisible">
                                    <p class="text-gray-700 font-light leading-tight mb-5">{{ content.ingredients }}</p>
                                    <div class="flex">
                                        <div class="mr-12">
                                            <span class="text-brand-green text-xl md:text-2xl">{{ content.b }} г.</span>
                                            <p class="text-sm -mt-1">Белки</p>
                                        </div>
                                        <div class="mr-12">
                                            <span class="text-brand-green text-xl md:text-2xl">{{ content.j }} г.</span>
                                            <p class="text-sm -mt-1">Жиры</p>
                                        </div>
                                        <div>
                                            <span class="text-brand-green text-xl md:text-2xl">{{ content.u }} г.</span>
                                            <p class="text-sm -mt-1">Углеводы</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </slide>
            </carousel>
        </div>
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
                    img:'img/sample/i6.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Гранола',
                            ingredients:'Грецкие орехи, миндаль, кешью, хлопья овсяные, хлопья кукурузные, хлопья гречневые, изюм, шоколад, свежая клубника, йогурт',
                            kcal:338.6,
                            b:9.6,
                            j:9.0,
                            u:54.9,
                            isVisible: true
                        }
                    ]
                },
                {
                    id:1,
                    type:'Завтрак II',
                    img:'img/sample/i5.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Омлет Пуляр с сыром Джугас',
                            ingredients:'Яйцо, сыр Джугас, стручковая фасоль, шампиньон, морковь, петрушка, укроп, тыква',
                            kcal:142.6,
                            b:10.8,
                            j:9.2,
                            u:4.2,
                            isVisible: true
                        }
                    ]
                },
                {
                    id:2,
                    type:'Обед',
                    img:'img/sample/i3.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Цезарь с курицей',
                            ingredients:'Куриное филе, яйцо перепелиное, хлеб тостовый, помидоры черри, анчоусы, сыр джугас, сыр пармезан, салат айсберг, лист салата, лола россо, каперсы, сметана, сливки',
                            kcal:283.2,
                            b:12.1,
                            j:5.9,
                            u:45.4,
                            isVisible: true
                        },
                        {
                            id:1,
                            title:'Тыквенный суп с семечками',
                            ingredients:'Тыква, картофель, лук, вода, сливки, тыквенные семечки, микрозелень, соль, перец',
                            kcal:134.3,
                            b:3.8,
                            j:5.5,
                            u:17.4,
                            isVisible: false
                        },
                        {
                            id:2,
                            title:'Стейк из говядины с картофелем по-деревенски',
                            ingredients:'Говяжий карбонат, соус барбекю, картофель, приправа для картофеля, соль, микрозелень',
                            kcal:560.0,
                            b:33.8,
                            j:14.6,
                            u:73.4,
                            isVisible: false
                        },
                    ]
                },
                {
                    id:3,
                    type:'Полдник',
                    img:'img/sample/i2.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Панкейки из гречневой муки',
                            ingredients:'Молоко, яйцо, мука гречневая, какао, джем ягодный',
                            kcal:283.2,
                            b:12.1,
                            j:5.9,
                            u:45.4,
                            isVisible: true
                        }
                    ]
                },
                {
                    id:4,
                    type:'Ужин',
                    img:'img/sample/i10.jpg',
                    contents:[
                        {
                            id:0,
                            title:'Курочка Баффало с птитимом и овощами-гриль',
                            ingredients:'Птитим, куриное филе, приправа к грилю, цуккини, баклажан, болгарский перец, томат, лук, базилик сушеный, орегано, масло оливковое, перец, соль',
                            kcal:326.6,
                            b:33.0,
                            j:9.5,
                            u:27.3,
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
