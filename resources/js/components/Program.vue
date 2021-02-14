<template>
 <div class="py-8">
      <div class="max-w-6xl mx-auto px-3">
          <h3 class="text-center font-bold text-3xl mb-3">Программы и цены</h3>
          <p class="max-w-xl mx-auto text-center font-light text-xl mb-8">Стоимость рационов зависит от калорийности, количества дней и линейки меню</p>
            <div class="max-w-sm mx-auto flex justify-center mb-10">
                <button v-for="type in types"
                    :key="type.id"
                    @click.stop="activeType=type.id"
                    :class="[type.id === activeType ? active : '', type.id === 0 ? 'mr-1 md:mr-3' : '']"
                    class="px-5 py-3 rounded bg-gray-600 hover:bg-gray-500 focus:outline-none text-sm text-white uppercase tracking-wider font-semibold"
                    >
                    {{ type.title }}
                </button>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="mt-5 w-88 mx-auto px-4 md:w-1/2 md:mx-0 lg:w-1/3" v-for="program in programs[activeType].data" :key="program.id">
                    <div class="rounded-lg shadow md:shadow-lg overflow-hidden">
                        <div class="flex relative bg-gray-200">
                            <img class="w-24 h-40 md:w-32 md:h-48 flex-shrink-0 object-cover object-center" :src="program.imageUrl">
                            <div class="w-full relative pr-3 pt-1 md:pt-3 md:pr-4">
                                <div class="flex items-center justify-between mb-2  md:-mb-2">
                                    <p class="text-3xl md:text-4xl font-black text-gray-800">{{ program.title }}</p>
                                    <p class="text-gray-700 text-xl font-light italic mt-2 md:mt-1">от <span class="font-semibold">{{ program.price }}₸</span></p>
                                </div>
                                <p class="mb-3 text-gray-600 font-light hidden md:block">≈ {{ program.kcal }} ккал</p>
                                <p class="text-gray-700 font-semibold leading-4 text-base mb-3">{{ program.shortDescription }}</p>
                                <div class="flex items-center absolute bottom-0 mb-3">
                                    <button @click="showModal(program.id)" class="px-3 md:px-5 text-xs text-white uppercase font-semibold rounded shadow bg-brand-green hover:bg-brand-green-hover focus:outline-none">
                                        Стоимость
                                    </button>
                                    <button @click="showDetailsModal(program.id)" class="ml-2 px-3 text-xs text-gray-800 uppercase font-semibold hover:bg-gray-500 rounded focus:outline-none">
                                        Подробнее
                                    </button>
                                </div>
                            </div>
                            <span v-show="program.isPopular" class="bg-red-600 px-2 md:py-1 uppercase text-xs font-semibold text-white absolute top-0 right-0 z-20">Лидер продаж</span>
                        </div>
                        <div v-show="program.bio" class="bg-white px-2 sm:px-4 py-2 flex items-center">
                            <a v-if="program.instagram" :href="program.instagramLink" target="_blank">
                                <img src="/img/icons/instagram.svg" class="hidden sm:block w-5 h-5 mr-2" :alt="program.instagram">
                            </a>
                            <div>
                                <p :class="{ '-mb-1': program.instagram }" class="text-xs font-medium leading-tight mt-1">{{ program.bio }}</p>
                                <a v-if="program.instagram" :href="program.instagramLink" target="_blank" class="text-xs leading-tight text-gray-500">{{ program.instagram }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 w-88 mx-auto px-4 md:mx-0 md:w-1/2 lg:w-1/3">
                    <div class="relative rounded-lg shadow-lg overflow-hidden px-4 py-3" style="background-image: url('/img/programs/personal.jpg'); background-size: cover;">
                        <div class="h-full w-full relative z-20 top-0 left-0 bottom-0 right-0">
                            <h3 class="text-2xl font-semibold text-gray-100 leading-tight mb-3">Индивидуальное меню</h3>
                            <p class="text-base text-white font-light leading-tight mb-5">
                                Линейка персонального меню разрабатывается индивидуально
                                по запросу клиента с учетом анамнеза и личных предпочтений
                            </p>
                            <button @click="showPersonalModal" class="px-3 py-2 mr-1 md:mr-2 text-xs uppercase font-semibold bg-white hover:bg-gray-300 rounded focus:outline-none">
                                Стоимость
                            </button>
                        </div>
                        <div class="h-full w-full z-10 absolute top-0 left-0 bg-gray-900 opacity-63">
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
            showSuccess: false,
            showFail: false,
            data: [],
            title: '',
            activeType: 0,
            active: 'bg-brand-green hover:bg-brand-green-hover shadow-lg',
            isDetailsVisible: false,
            isPersonal: false,
            programs:[
                {
                    id:0,
                    data:[
                        {
                            id: 0,
                            imageUrl: '/img/programs/xs.png',
                            title: 'XS',
                            kcal: '900',
                            price: 5500,
                            iPrice: 6500,
                            shortDescription: 'Интенсивное снижение веса',
                            isPopular: false,
                            instagramLink: 'https://instagram.com/anarochka_juju/',
                            bio: 'Анара - мама троих детей, предприниматель',
                            instagram: '@anarochka_juju',
                            aims: [
                                {
                                    id: 0,
                                    description: 'Интенсивного снижения веса (7-14 дней), например, при подготовке к мероприятиям'
                                }
                            ],
                            extra: 'Настоятельно рекомендуем проконсультироваться с нашим специалистом перед заказом!',
                            protein: {
                                weight: '65-75',
                                percentage: 33
                            },
                            fat: {
                                weight: '35-45',
                                percentage: 43
                            },
                            carbohydrate: {
                                weight: '45-55',
                                percentage: 24
                            }
                        },
                        {
                            id: 1,
                            imageUrl: '/img/programs/s.png',
                            title: 'S',
                            kcal: '1200',
                            price: 5500,
                            iPrice: 7000,
                            shortDescription: 'Комфортное снижение веса',
                            isPopular: true,
                            instagramLink: 'https://www.instagram.com/amina_khakim/',
                            bio: 'Амина - мама двоих детей, стилист',
                            instagram: '@amina_khakim',
                            aims: [
                                {
                                    id: 0,
                                    description: 'Комфортного снижения веса при отсутствии тренировок'
                                }
                            ],
                            extra: null,
                            protein: {
                                weight: '65-75',
                                percentage: 33
                            },
                            fat: {
                                weight: '35-45',
                                percentage: 43
                            },
                            carbohydrate: {
                                weight: '45-55',
                                percentage: 24
                            }
                        },
                        {
                            id: 2,
                            imageUrl: '/img/programs/m.png',
                            title: 'M',
                            kcal: '1500',
                            price: 6000,
                            iPrice: 7500,
                            shortDescription: 'Снижение веса/Поддержание формы',
                            isPopular: false,
                            instagramLink: 'https://www.instagram.com/savi_fit/',
                            bio: 'Валерия - фитнес-тренер групповых программ',
                            instagram: '@savi_fit',
                            aims: [
                                {
                                    id: 0,
                                    description: 'Снижения веса при интенсивных тренировках'
                                },
                                {
                                    id: 1,
                                    description: 'Поддержания формы при отсутствии тренировок'
                                }
                            ],
                            extra: null,
                            protein: {
                                weight: '85-95',
                                percentage: 33
                            },
                            fat: {
                                weight: '40-50',
                                percentage: 37
                            },
                            carbohydrate: {
                                weight: '75-85',
                                percentage: 30
                            }
                        },
                        {
                            id: 3,
                            imageUrl: '/img/programs/l.png',
                            title: 'L',
                            kcal: '1900',
                            price: 6500,
                            iPrice: 8000,
                            shortDescription: 'Набор массы/Спортивный',
                            isPopular: false,
                            instagramLink: 'https://www.instagram.com/anna.trener/',
                            bio: 'Анна - фитнес-тренер, нутрициолог',
                            instagram: '@anna.trener',
                            aims: [
                                {
                                    id: 0,
                                    description: 'Набора массы'
                                }
                            ],
                            extra: null,
                            protein: {
                                weight: '140-150',
                                percentage: 30
                            },
                            fat: {
                                weight: '65-75',
                                percentage: 33
                            },
                            carbohydrate: {
                                weight: '170-180',
                                percentage: 37
                            }
                        }
                    ]
                },
                {
                    id:1,
                    data:[
                        {
                            id: 0,
                            imageUrl: '/img/programs/men_m.png',
                            title: 'M',
                            kcal: '1500',
                            price: 6000,
                            iPrice:7500,
                            shortDescription: 'Комфортное снижение веса',
                            isPopular: true,
                            instagramLink: null,
                            bio: 'Берик - ведущий специалист в национальной компании',
                            instagram: null,
                            aims: [
                                {
                                    id: 0,
                                    description: 'Комфортного снижения веса при отсутствии физической активности'
                                }
                            ],
                            extra: null,
                            protein: {
                                weight: '85-95',
                                percentage: 33
                            },
                            fat: {
                                weight: '40-50',
                                percentage: 37
                            },
                            carbohydrate: {
                                weight: '75-85',
                                percentage: 30
                            }
                        },
                        {
                            id: 1,
                            imageUrl: '/img/programs/men_l.png',
                            title: 'L',
                            kcal: '1900',
                            price: 6500,
                            iPrice:8000,
                            shortDescription: 'Снижение веса/Поддержания формы',
                            isPopular: false,
                            instagramLink: null,
                            bio: 'Арман - предприниматель, регулярно играет в теннис',
                            instagram: null,
                            aims: [
                                {
                                    id: 0,
                                    description: 'Комфортного снижения веса при наличии тренировок и активного образа жизни'
                                },
                                {
                                    id: 1,
                                    description: 'Поддержания формы при отсутствии тренировок и физической активности'
                                }
                            ],
                            extra: null,
                            protein: {
                                weight: '140-150',
                                percentage: 30
                            },
                            fat: {
                                weight: '65-75',
                                percentage: 33
                            },
                            carbohydrate: {
                                weight: '170-180',
                                percentage: 37
                            }
                        },
                        {
                            id: 2,
                            imageUrl: '/img/programs/men_xl.png',
                            title: 'XL',
                            kcal: '2500',
                            price: 7000,
                            iPrice:8500,
                            shortDescription: 'Набор массы/Поддержание формы',
                            isPopular: false,
                            instagramLink: null,
                            bio: 'Александр - модель с фотостоков, тренируется в фитнес-клубе',
                            instagram: null,
                            aims: [
                                {
                                    id: 0,
                                    description: 'Набора массы'
                                },
                                {
                                    id: 1,
                                    description: 'Поддержания формы при высокой физической активности'
                                }
                            ],
                            extra: null,
                            protein: {
                                weight: '180-200',
                                percentage: 30
                            },
                            fat: {
                                weight: '75-95',
                                percentage: 30
                            },
                            carbohydrate: {
                                weight: '240-260',
                                percentage: 40
                            }
                        }
                    ]
                }
            ]
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
        }
    }
}
</script>

