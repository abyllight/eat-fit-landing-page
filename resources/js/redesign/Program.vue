<template>
 <div>
      <div class="max-w-6xl mx-auto px-4">
          <h1 class="text-xl lg:text-2xl text-center font-semibold mb-4">Программы и цены</h1>
          <h4 class="max-w-lg mx-auto text-center mb-8">Стоимость рационов зависит от калорийности, <br>количества дней и линейки меню</h4>
            <div class="max-w-sm mx-auto flex justify-center mb-2">
                <button v-for="type in types"
                    :key="type.id"
                    @click.stop="activeType=type.id"
                    class="px-5 py-2 rounded focus:outline-none text-xs uppercase font-semibold"
                    :class="[type.id === activeType ? active : non_active, type.id === 0 ? 'mr-2 md:mr-3' : '']"
                    >
                    {{ type.title }}
                </button>
            </div>
            <div class="flex flex-wrap items-start justify-center xl:justify-start">
                <div
                    :key="program.id"
                    v-for="program in programs[activeType].data"
                    class="mt-5 w-80 md:w-88 mx-auto xl:mx-2 bg-brand-blue-light rounded-lg shadow-lg relative"
                >
                    <div class="flex relative">
                        <img
                            :src="program.imageUrl"
                            :alt="program.title"
                            class="w-24 h-40 md:w-32 md:h-48 flex-shrink-0 object-cover object-center -ml-2 lg:-ml-4">
                        <div class="w-full py-2 pr-3">
                            <div class="flex items-center justify-between text-gray-900 mb-1">
                                <p class="text-3xl md:text-3xl font-black">{{ program.title }}</p>
                                <p class="text-lg italic mt-1 lg:mt-4">от <span class="font-semibold">{{ program.price }}₸</span></p>
                            </div>
                            <p class="mb-2 text-gray-800 font-light text-sm hidden sm:block">~ {{ program.kcal }} ккал</p>
                            <p class="text-gray-800 font-semibold leading-tight tracking-tight mb-3">{{ program.shortDescription }}</p>

                            <div class="flex items-center absolute bottom-0 mb-4">
                                <button
                                    @click="showModal(program.id)"
                                    class="px-3 md:px-4 rounded focus:outline-none text-tiny uppercase font-semibold bg-brand-yellow shadow hover:bg-brand-yellow-hover">
                                    Стоимость
                                </button>
                                <button
                                    @click="showDetailsModal(program.id)"
                                    class="ml-2 px-3 md:px-4 text-tiny uppercase font-semibold hover:bg-gray-400 rounded focus:outline-none">
                                    Подробнее
                                </button>
                            </div>
                        </div>
                        <span v-show="program.isPopular"
                              class="bg-red-600 px-2 lg:py-1 uppercase text-xs rounded-bl-lg rounded-tr-lg text-white absolute top-0 right-0 z-20">
                            Топ продаж
                        </span>
                    </div>
                    <div v-show="program.bio"
                         class="text-tiny font-medium bg-white px-2 leading-tight tracking-tight sm:px-4 py-2 lg:py-3 flex items-center rounded-b-lg">
                        {{ program.bio }}
                    </div>
                </div>
                <div class="mt-5 w-80 md:w-88 mx-auto xl:mx-2 bg-brand-blue-light rounded-lg shadow-lg">
                    <div class="p-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Индивидуальное меню</h3>
                            <p class="mb-4 text-sm">
                                Линейка персонального меню разрабатывается индивидуально по запросу клиента с учетом анамнеза и личных предпочтений
                            </p>
                            <button
                                @click="showPersonalModal"
                                class="px-3 md:px-4 text-tiny uppercase font-semibold rounded shadow bg-brand-yellow hover:bg-brand-yellow-active focus:outline-none">
                                Стоимость
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-5 w-80 md:w-88 mx-auto xl:mx-2 bg-brand-blue-light rounded-lg shadow-lg">
                    <div class="p-6">
                        <div>
                            <h3 class="text-lg font-semibold leading-tight mb-3">Не знаете свою суточную <br> норму калорий и БЖУ?</h3>
                            <p class="mb-5 text-sm">
                                Воспользуйтесь калькулятором, который поможет подобрать нужный рацион под ваши параметры и цели.
                            </p>
                            <div class="flex items-center justify-center">
                                <img src="/img/icons/calculator.png" width="48" class="mr-4" alt="Калькулятор">
                                <button
                                    @click="showCalculator"
                                    class="px-3 md:px-4 text-tiny uppercase font-semibold rounded shadow bg-brand-yellow hover:bg-brand-yellow-active focus:outline-none">
                                    Рассчитать
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
      </div>
     <order-modal :isVisible = "isVisible"
                  :data = "data"
                  :isPersonal = "isPersonal"
                  @close="closeModal"
                  @showSuccess="showSuccess = true"
                  @showFail="showFail = true">
     </order-modal>
     <details-modal :isDetailsVisible = "isDetailsVisible" :data = "data" @close="closeModal"></details-modal>
     <calculator :isCalcVisible = "isCalcVisible" @close="closeCalcModal"></calculator>
     <success-modal :showSuccess="showSuccess" @close="closeModal"></success-modal>
     <fail-modal :showFail="showFail" @close="closeModal"></fail-modal>
 </div>
</template>
<style>
    button{
        padding-top: 0.4rem;
        padding-bottom: 0.4rem;
    }
</style>
<script>
    import OrderModal from "./OrderModal";
    import DetailsModal from "./DetailsModal";
    import SuccessModal from "./SuccessModal";
    import FailModal from "./FailModal";
    import progs from '../data';
export default {
    name: 'program',
    components: {
        OrderModal,
        DetailsModal,
        SuccessModal,
        FailModal
    },
    data(){
        return{
            types: [
                {
                    id: 0,
                    title: 'для женщин'
                },
                {
                    id: 1,
                    title: 'для мужчин'
                }
            ],
            isVisible: false,
            isCalcVisible: false,
            isResultVisible: false,
            showSuccess: false,
            showFail: false,
            data: [],
            title: '',
            activeType: 0,
            active: 'bg-brand-yellow shadow-lg',
            non_active: 'bg-brand-non-active hover:bg-gray-300',
            isDetailsVisible: false,
            isPersonal: false,
            programs: progs
        }
    },
    methods: {
        showModal(id){
            this.isVisible = true;
            this.data = this.programs[this.activeType].data[id];
        },
        showDetailsModal(id){
            this.isDetailsVisible = true;
            this.data = this.programs[this.activeType].data[id];
        },
        showPersonalModal(){
            this.isVisible = true;
            this.isPersonal = true;
        },
        closeModal(){
            this.isVisible = false
            this.isDetailsVisible = false
            this.showSuccess = false
            this.showFail = false
            this.isPersonal = false
            this.data = []
        },
        showCalculator(){
            this.isCalcVisible = true;
        },
        closeCalcModal(){
            this.isCalcVisible = false;
        },
        closeResultModal(){
            this.isResultVisible = false;
        }
    }
}
</script>

