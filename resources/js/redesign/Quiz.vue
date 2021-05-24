<template>
    <div id="#sample" class="bg-gray-200 py-12">
        <div class="max-w-6xl mx-auto px-3">
            <h3 class="text-center font-bold text-3xl mb-12 leading-tight">Проверь себя</h3>
            <div class="max-w-xl bg-white rounded shadow-md mx-auto px-5 py-8">
                <div v-show="!hide_start_button" class="text-center">
                    <p class="font-semibold text-gray-800 text-lg mb-6">{{ questions.length * 5 }} вопросов</p>
                    <p class="mb-10 text-gray-900">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>
                    <button @click="hide_start_button = false" class="w-32 px-5 py-3 rounded bg-pink-700 hover:bg-pink-800 focus:outline-none text-sm text-white uppercase font-semibold">
                        Начать
                    </button>
                </div>

                <div v-show="hide_start_button" class="text-center">
                    <p class="font-semibold text-gray-800 text-lg mb-3">{{index+1}}/{{ questions.length * 5 }}</p>
                    <div class="text-lg text-black font-medium max-w-md mx-auto leading-tight mb-8">{{ questions[index].question }}</div>
                    <div v-for="variant in questions[index].variants">
                        <div class="border-t py-3 px-5 flex items-start cursor-pointer"
                             :class="[{'border-b': variant.id === 3}, answered && choice === variant.id && choice === questions[index].correct_answer ? 'bg-green-200' : answered && choice === variant.id && choice !== questions[index].correct_answer ? 'bg-red-200' : '']"
                             @click="!answered ? check(variant.id) : ''">

                            <img
                                :src="!answered ? '/img/icons/dry-clean.svg' : answered && variant.id === questions[index].correct_answer ? '/img/icons/checked.svg' : '/img/icons/close_3.svg'"
                                 class="mr-4">

                            <div>
                                <p class="text-left text-lg"
                                   :class="[answered && variant.id === questions[index].correct_answer ? 'text-green-700' : answered && variant.id !== questions[index].correct_answer ? 'text-red-700' : '']">{{variant.text }}</p>
                                <p v-if="answered && choice === variant.id"
                                   class="text-left text-sm mt-2"> {{ questions[index].answer }} </p>
                            </div>

                        </div>
                    </div>

                    <button
                        v-if="answered"
                        class="w-56 mt-10 px-5 py-3 rounded bg-pink-700 hover:bg-pink-800 focus:outline-none text-sm text-white uppercase font-semibold"
                        @click="next()">
                        Следующий вопрос
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
</style>

<script>
import { Carousel, Slide } from 'vue-carousel'
export default {
    name: 'quiz',
    components: {
        Carousel,
        Slide
    },
    data(){
        return{
            hide_start_button: true,
            index: 0,
            answered: false,
            choice: 0,
            questions: [
                {
                    id:0,
                    question: 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout?',
                    answer: 'answer',
                    correct_answer: 2,
                    variants: [
                        {
                            id:0,
                            text: 'Variant 1.1'
                        },
                        {
                            id:1,
                            text: 'Variant 1.2'
                        },
                        {
                            id:2,
                            text: 'Variant 1.3'
                        },
                        {
                            id:3,
                            text: 'Variant 1.4'
                        }
                    ]
                },
                {
                    id:0,
                    question: 'Question 2?',
                    answer: 'answer',
                    correct_answer: 0,
                    variants: [
                        {
                            id:0,
                            text: 'Variant 2.1'
                        },
                        {
                            id:1,
                            text: 'Variant 2.2'
                        },
                        {
                            id:2,
                            text: 'Variant 2.3'
                        },
                        {
                            id:3,
                            text: 'Variant 2.4'
                        }
                    ]
                }
            ]
        }
    },
    methods: {
        check(v_id) {

            this.answered = true
            this.choice = v_id
            if (v_id === this.questions[this.index].correct_answer) {
                console.log('correct')
            }else {
                console.log('incorrect')
            }
        },
        next() {
            this.answered = false
            this.index++
        }
    }
}
</script>
