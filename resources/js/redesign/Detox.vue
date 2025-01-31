<template>
    <div id="#detox">
        <div class="max-w-6xl mx-auto px-3 mt-5">
            <div class="md:w-2/3 mx-auto mt-24">
                <h1 class="text-xl lg:text-3xl text-center font-semibold mb-4 px-4">
                    Детокс
                </h1>

                <p class="text-lg">
                    Это способ очищения организма от токсинов, на основе смузи.
                    Основной принцип – потребление овощей и фруктов в жидком виде, но без исключения клетчатки,
                    содержащейся в них. Такой способ позволяет не перегружать пищеварительный тракт механической
                    обработкой растительной пищи, и не стимулировать жевательными движениями выработку
                    пищеварительных соков. Все это создает щадящие условия для пищеварительной системы,
                    и не вызывает чрезмерного аппетита, как бывает при поедании салатов и зелени во время
                    растительной диеты. При этом в организм поступает большое количество клетчатки, пектина,
                    фруктозы, витаминов и микроэлементов. Таким образом, всего за одну-две недели вы можете
                    восстановить силы, укрепить иммунитет, вернуть молодость коже и волосам.
                </p>
            </div>

            <div class="py-8 flex flex-col md:flex-row md:justify-around">
                <div class="w-72 mx-auto py-8" v-for="detox in detoxList" :key="detox.id">
                    <img :src="detox.imgUrl" class="rounded shadow-xl object-cover object-center mb-3" alt="Детокс">
                    <p class="font-semibold leading-tight mb-4">{{ detox.title }}</p>

                    <div class="flex items-center text-xs">
                        <button @click="showModal(detox)" class="px-5 py-2 mr-2 font-semibold uppercase bg-brand-yellow shadow-lg hover:bg-brand-yellow-hover rounded focus:outline-none">
                            заказать
                        </button>
                        <button @click="showDetailsModal(detox)" class="px-5 py-2 font-semibold uppercase bg-gray-300 hover:bg-gray-400 rounded focus:outline-none">
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
                        title: 'Понедельник / четверг',
                        imgUrl: '/img/detox/pncht.jpg',
                        price: 7500,
                        items: [
                            {
                                id: 0,
                                title: 'Лимонная вода',
                                composition: 'вода, лимон, мёд, сироп топинамбура'
                            },
                            {
                                id: 1,
                                title: 'Фруктовый микс',
                                composition: 'банан, апельсин, яблоко, апельсиновый фреш'
                            },
                            {
                                id: 2,
                                title: 'Витаминный микс',
                                composition: 'сельдерей, шпинат, огурец, яблоко, яблочный фреш'
                            },
                            {
                                id: 3,
                                title: 'Овощной микс',
                                composition: 'свекла, сельдерей, яблоко, имбирь, амарант, морковь'
                            },
                            {
                                id: 4,
                                title: 'Манго-Апельсин',
                                composition: 'манго, апельсиновый фреш, брокколи, цветная капуста, морковь, сироп топинамбура'
                            },
                            {
                                id: 5,
                                title: 'Ягодный микс',
                                composition: 'смородина, малина, клубника, семена чиа, рисовое молоко, мята'
                            }
                        ]
                    },
                    {
                        id: 1,
                        title: 'Вторник / пятница',
                        imgUrl: '/img/detox/vtpt.jpg',
                        price: 7500,
                        items: [
                            {
                                id: 0,
                                title: 'Огуречная вода',
                                composition: 'вода, огурец, лимон, мед, мята'
                            },
                            {
                                id: 1,
                                title: 'Груша-киви',
                                composition: 'груша, киви, петрушка'
                            },
                            {
                                id: 2,
                                title: 'Экзотик микс',
                                composition: 'манго, яблоко, алельсиновый фреш, яблочный фреш'
                            },
                            {
                                id: 3,
                                title: 'Цитрусовый',
                                composition: 'апельсин, грейпфрут, банан'
                            },
                            {
                                id: 4,
                                title: 'Кэроб-банан',
                                composition: 'кэроб, банан, кешью, финики, вода'
                            },
                            {
                                id: 5,
                                title: 'Ягодно-овсяной смузи',
                                composition: 'молоко овсяное, малина, груша, банан, овсяные хлопья'
                            }
                        ]
                    },
                    {
                        id: 2,
                        title: 'Среда / суббота',
                        imgUrl: '/img/detox/srsb.jpg',
                        price: 7500,
                        items: [
                            {
                                id: 0,
                                title: 'Ягоды–Лайм',
                                composition: 'малина, клубника, смородина, киви, мята, сироп топинамбура'
                            },
                            {
                                id: 1,
                                title: 'Морковь–Яблоко',
                                composition: 'морковь, яблоко, сельдерей, имбирь'
                            },
                            {
                                id: 2,
                                title: 'Киви-Ананас',
                                composition: 'ананас, киви, яблоко'
                            },
                            {
                                id: 3,
                                title: 'Авокадо микс',
                                composition: 'авокадо, сельдерей, банан, мед, клубника'
                            },
                            {
                                id: 4,
                                title: 'Облепиха–Манго',
                                composition: 'облепиха, яблоко, манго, молоко миндальное'
                            },
                            {
                                id: 5,
                                title: 'Банан-орех',
                                composition: 'банан, голубика, груша, миндальное молоко,орехи миндаль'
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
