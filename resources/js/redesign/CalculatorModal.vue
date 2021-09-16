<template>
    <div class="relative">
        <transition
            enter-active-class="ease-in duration-300"
            enter-class="opacity-0"
            leave-active-class="ease-out duration-100"
        >
            <div
                v-if="isCalcVisible"
                class="h-screen w-full fixed inset-0 z-20 bg-gray-900 opacity-75 cursor-pointer"
                @click="closeModal">
            </div>
        </transition>
        <transition
            enter-active-class="ease-in duration-300"
            enter-class="opacity-0 transform translate-y-full md:translate-y-0 md:scale-100"
            leave-active-class="ease-out duration-100"
        >
            <div
                v-if="isCalcVisible"
                class="fixed overflow-hidden inset-0 top-16 lg:top-10 md:bottom-auto mx-auto z-30 bg-brand-blue-light rounded-t-lg md:rounded-b-lg max-w-md p-6"
            >
                <div v-if="!hasResult">
                    <h3 class="text-lg text-center font-semibold mb-8">
                        Параметры тела
                    </h3>

                    <div class="flex justify-center mb-6">
                        <button v-for="type in types"
                                :key="type.id"
                                @click.stop="activeType=type.id"
                                class="px-5 py-3 rounded outline-none focus:outline-none text-xs font-medium"
                                :class="[type.id === activeType ? active : non_active, type.id === 0 ? 'mr-2 md:mr-3' : '']"
                        >
                            {{ type.title }}
                        </button>
                    </div>

                    <form>
                        <div class="flex flex-col md:flex-row md:justify-between text-xs">
                            <select class="px-5 py-3 rounded mb-4 md:mb-0" v-model="age" :class="!checkAge ? errorStyle : ''">
                                <option value="0">Возраст</option>
                                <option v-for="i in 90" :value="i + 15">{{i + 15}}</option>
                            </select>

                            <select class="px-5 py-3 rounded mb-4 md:mb-0" v-model="weight" :class="!checkWeight ? errorStyle : ''">
                                <option value="0">Вес</option>
                                <option v-for="i in 100" :value="i + 40">{{i + 40}} кг</option>
                            </select>

                            <select class="px-5 py-3 rounded" v-model="height" :class="!checkHeight ? errorStyle : ''">
                                <option value="0">Рост</option>
                                <option v-for="i in 150" :value="i + 100">{{i + 100}} см</option>
                            </select>
                        </div>
                        <p v-show="!checkAge || !checkWeight || !checkHeight" class="text-xs text-red-600 mt-2">Выберите значение</p>
                        <div class="mt-4">
                            <p class="text-base font-medium mb-3">Уровень активности:</p>
                            <select class="px-5 py-3 rounded text-xs" v-model="activity" :class="!checkActivity ? errorStyle : ''">
                                <option value="0">Выберите активность</option>
                                <option value="1">1 - почти нет активности</option>
                                <option value="2">2 - умеренные нагрузки</option>
                                <option value="3">3 - тренировки 3-5 раз в неделю</option>
                                <option value="4">4 - интенсивные нагрузки</option>
                                <option value="5">5 - профессиональные спортсмены</option>
                            </select>
                        </div>
                        <p v-show="!checkActivity" class="text-xs text-red-600 mt-2">Выберите значение</p>
                        <div class="mb-8 mt-4">
                            <p class="text-base font-medium mb-3">Ваша цель:</p>
                            <div class="flex justify-between">
                                <div v-for="aim in aims"
                                     :key="aim.id"
                                     @click.stop="activeAim=aim.id"
                                     class="px-2 md:px-5 py-3 rounded focus:outline-none text-xs font-medium cursor-pointer"
                                     :class="[aim.id === activeAim ? active : non_active]"
                                >
                                    {{ aim.title }}
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button
                                type="submit"
                                @click.prevent="calculate"
                                class="px-8 py-3 rounded focus:outline-none text-xs font-semibold bg-brand-yellow hover:bg-brand-yellow-active shadow-lg">
                                Рассчитать
                            </button>
                        </div>
                    </form>
                </div>

                <div v-else>
                    <h3 class="text-lg text-center leading-6 font-bold mb-4">
                        Рекомендация рациона
                    </h3>
                    <p class="text-sm md:text-base mb-6">
                        Необходимая норма калорий и нутриентный состав
                        дневного рациона для достижения цели: <span class="font-semibold">{{ data.kcal }} ккал</span>
                    </p>

                    <div class="bg-white flex justify-around text-center rounded-lg max-w-sm mx-auto py-6 mb-4">
                        <div>
                            <span class="font-semibold">{{data.protein ? data.protein.weight : ''}} гр</span>
                            <p class="text-sm">Белки</p>
                        </div>
                        <div>
                            <span class="font-semibold">{{data.protein ? data.fat.weight : ''}} гр</span>
                            <p class="text-sm">Жиры</p>
                        </div>
                        <div>
                            <span class="font-semibold">{{data.protein ? data.carbohydrate.weight : ''}} гр</span>
                            <p class="text-sm">Углеводы</p>
                        </div>
                    </div>

                    <p class="text-center mb-1">Рекомендуемая программа питания:</p>
                    <p class="text-lg font-semibold text-center mx-auto mb-8">{{ data.title }} ({{ data.kcal }} ккал)</p>
                    <div class="text-center">
                        <button
                            @click="hasResult=false"
                            class="px-8 py-3 mb-4 md:mb-0 md:mr-4 w-full md:w-auto rounded focus:outline-none text-xs font-semibold border border-brand-yellow hover:border-brand-yellow-active shadow">
                            Рассчитать заново
                        </button>
                        <button
                            @click="showProgram"
                            class="px-8 py-3 rounded focus:outline-none w-full md:w-auto text-xs font-semibold bg-brand-yellow hover:bg-brand-yellow-active shadow">
                            Заказать
                        </button>
                    </div>
                </div>

                <button @click="closeModal" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-700 focus:text-gray-600 focus:outline-none">
                    <svg class="h-8 w-8 fill-current" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                    </svg>
                </button>
            </div>
        </transition>

        <order-modal :isVisible = "isVisible"
                     :data = "data"
                     :isPersonal = "false"
                     @close="closeModal"
                     @showSuccess="showSuccess = true"
                     @showFail="showFail = true">
        </order-modal>
    </div>
</template>
<style scoped>
    select{
        font-weight: 500;
    }
    option{
        font-weight: 500;
    }
</style>
<script>
import progs from '../data';
import OrderModal from "./OrderModal";
export default {
    name: 'CalculatorModal',
    props: ['isCalcVisible'],
    components: {
        OrderModal
    },
    data(){
        return{
            types: [
                {
                    id: 0,
                    title: 'Женщина'
                },
                {
                    id: 1,
                    title: 'Мужчина'
                }
            ],
            data: [],
            aims: [
                {
                    id: 0,
                    title: 'Снижение веса'
                },
                {
                    id: 1,
                    title: 'Баланс'
                },
                {
                    id: 2,
                    title: 'Набор массы'
                }
            ],
            activeType: 0,
            activeAim: 0,
            activity: 0,
            errorStyle: 'border border-red-600',
            age: 0,
            height: 0,
            weight: 0,
            hasAge: true,
            hasActivity: true,
            hasHeight: true,
            hasWeight: true,
            active: 'bg-brand-yellow shadow-lg',
            non_active: 'bg-white hover:bg-gray-300',
            programs: progs,
            hasResult: false,
            isVisible: false
        }
    },
    methods: {
        closeModal(){
            this.hasResult = false
            this.age = 0
            this.activeType = 0
            this.activeAim = 0
            this.height = 0
            this.weight = 0
            this.activity = 0
            this.aim = 0
            this.$emit('close')
        },
        recalculate(){
            this.hasResult = false
            this.data = []
        },
        calculate() {
            if (!this.validate()) return;

            let result = 0;

            switch (this.activeAim) {
                case 0:
                    result = this.activity <= 3 ? 0 : 1
                    break;
                default:
                    result = this.activity <= 3 ? 1 : 2
                    break;
            }

            result = this.activeType === 0 ? result + 1 : result

            this.data = this.programs[this.activeType].data[result]

            this.hasResult = true
        },
        showProgram(){
            this.isVisible = true
            this.closeModal()
        },
        validate() {

            if (this.age === 0 || this.age === '0') {
                this.hasAge = false
            }
            if (this.weight === 0 || this.weight === '0'){
                this.hasWeight = false
            }
            if(this.height === 0 || this.height === '0') {
                this.hasHeight = false
            }
            if (this.activity === 0 || this.activity === '0') {
                this.hasActivity = false
            }

            return this.checkAge && this.checkActivity && this.checkHeight && this.checkWeight;
        }
    },
    computed: {
        checkAge() {
            return this.hasAge || this.age > 0
        },
        checkHeight() {
            return this.hasHeight || this.height > 0
        },
        checkWeight() {
            return this.hasWeight || this.weight > 0
        },
        checkActivity() {
            return this.hasActivity || this.activity > 0
        }
    }
}
</script>
