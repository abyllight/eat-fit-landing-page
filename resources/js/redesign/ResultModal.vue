<template>
    <div v-show="isVisible" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-4 py-2">
        <div class="w-full md:max-w-md rounded overflow-hidden shadow-xl relative">
            <div class="bg-brand-blue-light px-4 py-8 sm:p-6">
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
                        @click="$emit('recalculate')"
                        class="px-8 py-2 mb-4 md:mb-0 md:mr-4 w-full md:w-auto rounded focus:outline-none text-xs font-semibold border border-brand-yellow hover:border-brand-yellow-active shadow">
                        Рассчитать заново
                    </button>
                    <button
                        @click="isOrderVisible = true"
                        class="px-8 py-2 rounded focus:outline-none w-full md:w-auto text-xs font-semibold bg-brand-yellow hover:bg-brand-yellow-active shadow">
                        Заказать
                    </button>
                </div>
            </div>

            <button @click="$emit('close')" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-700 focus:text-gray-600 focus:outline-none">
                <svg class="h-8 w-8 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
        <order-modal :isVisible = "isOrderVisible"
                     :data = "data"
                     :isPersonal = "false"
                     @close="closeModal"
                     @showSuccess="showSuccess = true"
                     @showFail="showFail = true">
        </order-modal>
        <success-modal :showSuccess="showSuccess" @close="closeModal"></success-modal>
        <fail-modal :showFail="showFail" @close="closeModal"></fail-modal>
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
import OrderModal from "./OrderModal";
import SuccessModal from "./SuccessModal";
import FailModal from "./FailModal";
export default {
    name: 'ResultModal',
    components: {OrderModal,SuccessModal, FailModal},
    props: ['isVisible', 'data'],
    data(){
        return{
            types: [
                {
                    id: 0,
                    title: 'Мужчина'
                },
                {
                    id: 1,
                    title: 'Женщина'
                }
            ],
            aims: [
                {
                    id: 0,
                    title: 'Похудение'
                },
                {
                    id: 1,
                    title: 'Набор массы'
                },
                {
                    id: 2,
                    title: 'Баланс'
                }
            ],
            isOrderVisible: false,
            activeType: 0,
            activeAim: 0,
            active: 'bg-brand-yellow shadow-lg',
            non_active: 'bg-white hover:bg-gray-300',
            showSuccess: false,
            showFail: false,
        }
    },
    methods: {
        closeModal(){
            this.isOrderVisible = false
            this.showSuccess = false
            this.showFail = false
            this.$emit('close')
        }
    }
}
</script>
