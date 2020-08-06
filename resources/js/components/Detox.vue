<template>
    <div id="#detox">
        <div class="max-w-6xl mx-auto px-5 mt-5">
            <div class="md:w-2/3 text-center mx-auto mt-32">
                <p class="font-hairline text-2xl"><span class="font-semibold text-brand-green">
                      Детокс</span> – это способ очищения организма от токсинов, на основе смузи.
                Основной принцип – потребление овощей и фруктов в жидком виде, но без исключения клетчатки,
                содержащейся в них.
                </p>
            </div>

            <div class="py-8 flex flex-col md:flex-row md:justify-around">
                <div class="w-72 mx-auto py-8" v-for="detox in detoxList" :key="detox.id">
                    <img :src="detox.imgUrl" class="rounded shadow-xl object-cover object-center mb-3">
                    <p class="font-semibold text-gray-900 leading-tight text-lg mb-4">{{ detox.title }}</p>

                    <div class="flex items-center">
                        <button @click="showModal(detox)" class="px-4 py-2 mr-2 text-white text-sm uppercase font-semibold bg-brand-green shadow hover:bg-brand-green-hover rounded focus:outline-none">
                            заказать
                        </button>
                        <button @click="showDetailsModal(detox)" class="px-4 py-2 text-sm text-gray-800 uppercase font-semibold hover:bg-gray-500 rounded focus:outline-none">
                            состав
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <detox-modal :show = "showDetoxModal" :data = "detoxList.length > 0 ? chosenProduct : ''"  @close="showDetoxModal = false" @showSuccess="showSuccess = true"
                     @showFail="showFail = true"></detox-modal>
        <detox-details-modal :show = "showDetoxDetailsModal" :data = "detoxList.length > 0 ? chosenProduct : ''"  @close="showDetoxDetailsModal = false"></detox-details-modal>
        <success-modal :showSuccess="showSuccess" @close="closeModal"></success-modal>
        <fail-modal :showFail="showFail" @close="closeModal"></fail-modal>
    </div>
</template>

<style>
</style>

<script>
    import DetoxModal from "./DetoxModal";
    import DetoxDetailsModal from "./DetoxDetailsModal";
    import SuccessModal from "./SuccessModal";
    import FailModal from "./FailModal";
    export default {
        name: 'Detox',
        components: {
            DetoxDetailsModal,
            DetoxModal,
            SuccessModal,
            FailModal
        },
        data(){
            return{
                showSuccess: false,
                showFail: false,
                showDetoxModal: false,
                showDetoxDetailsModal: false,
                chosenProduct: [],
                detoxList: [
                    {
                        id: 0,
                        title: 'Сет 1',
                        imgUrl: '/img/detox/1a.jpg',
                        price: 6000,
                        items: [
                            {
                                id: 0,
                                title: 'Лимонная вода',
                                composition: 'вода, лимон, мёд'
                            },
                            {
                                id: 1,
                                title: 'Фруктовый микс',
                                composition: 'вода, банан, яблоко, апельсин, мята'
                            },
                            {
                                id: 2,
                                title: 'Витаминный микс',
                                composition: 'вода, огурец, томат черри, сельдерей, шпинат'
                            },
                            {
                                id: 3,
                                title: 'Имбирь-сельдерей',
                                composition: 'вода, свекла, сельдерей, морковь, яблоко, имбирь, семена амаранта'
                            },
                            {
                                id: 4,
                                title: 'Спирулина-микс',
                                composition: 'спирулина, сок апельсиновый, морковь, капуста цветная, брокколи'
                            },
                            {
                                id: 5,
                                title: 'Ягодный-микс',
                                composition: 'черная смородина, семена чиа, мята, молоко рисовое, малина, клубника, банан'
                            }
                        ]
                    },
                    {
                        id: 1,
                        title: 'Сет 2',
                        imgUrl: '/img/detox/2a.jpg',
                        price: 6000,
                        items: [
                            {
                                id: 0,
                                title: 'Огуречная вода',
                                composition: 'сироп из тапинамбура, огурец, мята, мед, лайм, вода'
                            },
                            {
                                id: 1,
                                title: 'Груша-киви',
                                composition: 'петрушка, киви, груша, вода'
                            },
                            {
                                id: 2,
                                title: 'Томат-сельдерей',
                                composition: 'укроп, сельдерей, томат, перец светофор, вода'
                            },
                            {
                                id: 3,
                                title: 'Цитрусовый',
                                composition: 'апельсин, грейпфрут'
                            },
                            {
                                id: 4,
                                title: 'Банан-финики',
                                composition: 'финик, кэроб, банан, вода'
                            },
                            {
                                id: 5,
                                title: 'Овсяной смузи',
                                composition: 'молоко овсяное, малина, груша, банан'
                            }
                        ]
                    },
                    {
                        id: 2,
                        title: 'Сет 3',
                        imgUrl: '/img/detox/3a.jpg',
                        price: 6000,
                        items: [
                            {
                                id: 0,
                                title: 'Смородина-лайм',
                                composition: 'сироп тапинамбура, мята, малина, лайм, красная смородина, киви, вода'
                            },
                            {
                                id: 1,
                                title: 'Морковный микс',
                                composition: 'томат черри, сельдерей, паприка копченная, морковь, имбирь, вода'
                            },
                            {
                                id: 2,
                                title: 'Киви-ананас',
                                composition: 'яблоко, киви, вода, ананас'
                            },
                            {
                                id: 3,
                                title: 'Авокадо-микс',
                                composition: 'сельдерей, мед, клубника, вода, банан, авокадо'
                            },
                            {
                                id: 4,
                                title: 'Лесной микс',
                                composition: 'яблоко, петрушка, морковь, молоко миндальное, брусника'
                            },
                            {
                                id: 5,
                                title: 'Банан-орех',
                                composition: 'черника, молоко миндальное, груша, банан'
                            }
                        ]
                    }
                ]
            }
        },
        methods: {
            showModal(detox){
                this.showDetoxModal = true
                this.chosenProduct = detox
            },
            showDetailsModal(detox){
                this.showDetoxDetailsModal = true
                this.chosenProduct = detox
            },
            closeModal(){
                this.showSuccess = false
                this.showFail = false
            }
        }
    }
</script>
