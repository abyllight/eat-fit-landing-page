<template>
 <div>
      <div class="max-w-6xl mx-auto px-4">
          <h1 class="text-xl lg:text-2xl text-center font-semibold mb-4">Программы и цены</h1>
          <h4 class="max-w-lg mx-auto text-center mb-8">Стоимость рационов зависит от калорийности, <br>количества дней и линейки меню</h4>
            <div class="max-w-sm mx-auto flex justify-center mb-2">
                <button v-for="type in types"
                    :key="type.id"
                    @click.stop="activeType=type.id"
                    class="px-5 py-3 rounded focus:outline-none text-xs uppercase font-semibold"
                    :class="[type.id === activeType ? active : non_active, type.id === 0 ? 'mr-2 md:mr-3' : '']"
                    >
                    {{ type.title }}
                </button>
            </div>
            <div class="flex flex-wrap items-start justify-center xl:justify-start">
                <div
                    :key="program.id"
                    v-for="program in programs[activeType].data"
                    class="mt-8 w-80 md:w-88 mx-auto xl:mx-2 bg-brand-blue-light rounded-lg shadow-lg relative"
                >
                    <div class="flex relative">
                        <img
                            :src="program.imageUrl"
                            :alt="program.title"
                            class="w-28 flex-shrink-0 object-cover object-center"
                        >
                        <div class="w-full pt-2 pl-1 pr-5">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-3xl font-bold">{{ program.title }}</p>
                                <p class="font-light text-sm text-gray-700 mt-1">{{ program.kcal }} ккал</p>
                            </div>
                            <p class="font-medium leading-tight tracking-tight">{{ program.shortDescription }}</p>

                            <div class="flex items-center absolute bottom-0 mb-4">
                                <button
                                    @click="showModal(program.id)"
                                    class="px-3 md:px-4.5 py-2 rounded outline-none focus:outline-none text-xs uppercase font-semibold bg-gray-700 text-white shadow hover:bg-gray-600">
                                    Стоимость
                                </button>
                                <p class="text-base ml-2 md:ml-3">от <span class="font-medium">{{ program.price }}₸</span></p>
                            </div>
                        </div>
                        <span v-show="program.isPopular"
                              class="bg-red-600 px-2 lg:py-1 uppercase text-tiny rounded-bl-lg rounded-tr-lg text-white absolute top-0 right-0 z-20">
                            Топ продаж
                        </span>
                    </div>
                    <div v-show="program.bio"
                         class="text-tiny font-medium bg-white px-2 leading-tight tracking-tight sm:px-4 py-2 lg:py-3 flex items-center rounded-b-lg">
                        {{ program.bio }}
                    </div>
                </div>
                <div class="mt-8 w-80 md:w-88 mx-auto xl:mx-2 bg-brand-blue-light rounded-lg shadow-lg">
                    <div class="px-6 py-5">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Индивидуальное меню</h3>
                            <p class="mb-4 text-sm">
                                Линейка персонального меню разрабатывается индивидуально по запросу клиента с учетом анамнеза и личных предпочтений
                            </p>
                            <button
                                @click="showPersonalModal"
                                class="px-3 md:px-4.5 py-2 rounded outline-none focus:outline-none text-xs uppercase font-semibold bg-yellow-200 shadow hover:bg-yellow-100">
                                Стоимость
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-8 w-80 md:w-88 mx-auto xl:mx-2 bg-brand-blue-light rounded-lg shadow-lg">
                    <div class="px-6 py-5">
                        <div>
                            <h3 class="text-lg font-semibold leading-tight mb-2">Не знаете свою суточную <br> норму калорий и БЖУ?</h3>
                            <p class="mb-5 text-sm">
                                Воспользуйтесь калькулятором, который поможет подобрать нужный рацион под ваши параметры и цели.
                            </p>
                            <div class="flex items-center justify-center">
                                <img src="/img/icons/calculator.png" width="48" class="mr-4" alt="Калькулятор">
                                <button
                                    @click="showCalculator"
                                    class="px-3 md:px-4.5 py-2 rounded outline-none focus:outline-none text-xs uppercase font-semibold bg-yellow-200 shadow hover:bg-yellow-100">
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
     <calculator :isCalcVisible = "isCalcVisible" @close="isCalcVisible=false"></calculator>
 </div>
</template>
<script>
import OrderModal from "./OrderModal";
import CalculatorModal from "./CalculatorModal";
import progs from '../data';
export default {
    name: 'program',
    components: {
        OrderModal,
        CalculatorModal
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
            non_active: 'bg-gray-300 hover:bg-gray-200',
            isDetailsVisible: false,
            isPersonal: false,
            programs: progs
        }
    },
    methods: {
        showModal(id){
            this.data = this.programs[this.activeType].data[id];
            this.isVisible = true;
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
            this.isCalcVisible = false
            this.data = []
        },
        showCalculator(){
            this.isCalcVisible = true;
        },
        closeResultModal(){
            this.isResultVisible = false;
        }
    }
}
</script>

