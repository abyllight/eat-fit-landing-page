<template>
        <div class="max-w-6xl mx-auto px-4">
            <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8 lg:mb-12 px-5">
                Ответы на часто задаваемые вопросы
            </h1>
            <div class="max-w-lg mx-auto flex justify-center mb-8">
                <div class="flex flex-no-wrap overflow-x-auto scrollClass">
                    <button v-for="theme in themes"
                            :key="theme.id"
                            @click.stop="activeTheme = theme.id"
                            class="w-72 px-6 py-2 mr-4 rounded focus:outline-none text-xs uppercase font-semibold"
                            :class="[theme.id === activeTheme ? active : non_active]"
                    >
                        {{ theme.title }}
                    </button>
                </div>
            </div>
            <div class="max-w-3xl mx-auto">
                <div v-for="faq in themes[activeTheme].faqs" class="pb-2 pt-2">
                    <div class="w-full flex justify-between items-center border-b pb-4">
                        <a
                            @click="faq.isVisible = !faq.isVisible"
                            class="font-medium text-gray-800 hover:text-brand-yellow-active cursor-pointer leading-tight">{{ faq.question }}</a>
                        <span
                            @click="faq.isVisible = !faq.isVisible"
                            class="font-semibold text-gray-800 text-lg hover:text-brand-yellow-active cursor-pointer">{{ faq.isVisible ? '-' : '+' }}</span>
                    </div>
                    <div v-show="faq.isVisible" class="py-3 border-b">
                        <p class="font-light text-gray-800 text-sm" v-html="faq.answer"></p>
                    </div>
                </div>
            </div>
        </div>
</template>
<style scoped>
    .scrollClass{
        /*max-width: 480px;*/
        /*margin: 0 auto;*/
        -webkit-overflow-scrolling: touch; /* [3] */
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
    .scrollClass::-webkit-scrollbar{
        display: none;
    }
</style>
<script>
    export default {
        name: "Faq",
        data(){
            return{
                activeTheme: 0,
                active: 'bg-brand-yellow shadow-lg',
                non_active: 'bg-white hover:bg-gray-200',
                themes: [
                    {
                        id: 0,
                        title: 'Питание 🥗',
                        faqs: [
                            {
                                id: 0,
                                question: 'Как подобрать калорийность рациона?',
                                answer: 'Сделать это наверняка довольно сложно, даже если вы пройдете фитнес-тест на определение базового метаболизма, все равно день ото дня уровень энергозатрат будет колебаться. Мы можем предложить вам одну из наших программ, а далее будем отслеживать результаты и оценивать их. В случае чего всегда можно откорректировать рацион в плюс или минус.' +
                                    '<p class="mt-1.5">Подобрать нужную для вас калорийность можно на сайте с помощью калькулятора или написав менеджеру по номеру +7 776 6906090 📲.</br>',
                                isVisible: false
                            },
                            {
                                id: 1,
                                question: 'На сколько дней можно заказать питание и какие результаты я получу? 🥳',
                                answer: 'Заказать питание можно на любое количество дней. Для достижения результата мы предлагаем полный 28-дневный курс питания на 4 недели с бесплатной доставкой. Вы получаете рацион из 6 блюд на 5 приемов пищи, то есть, завтрак, второй завтрак, обед (первое, второе блюдо), полдник и ужин.\n' +
                                    '<p class="mt-1.5">Каждый человек индивидуален, и результаты зависят от вашего графика дня и образа жизни, скорости обмена веществ, гормонального фона и других особенностей. Тем не менее средние результаты при снижении веса: 3-5кг. за курс. Если Вы будете следовать рекомендациям, то результаты не заставят себя ждать, и они выражаются не только в цифрах. Также можно отметить улучшение кожи, волос, ногтей и общего самочувствия ✨.</p>',
                                isVisible: false
                            },
                            {
                                id: 2,
                                question: 'Составляете ли вы индивидуальное меню и где можно посмотреть меню на каждый день? 👩🏼‍🍳',
                                answer: 'Меню делится на программы относительно общей калорийности и соотношения белков, жиров и углеводов. Одно из направлений нашего сервиса – создание базовой линейки – LITE, блюд разных стран и народов. То есть, каждый день вы будете получать диетический вариант меню, построенной на основе кухни определенной страны. К примеру, Италии, Франции или Японии. Однако если у вас имеются продукты-аллергены или какие-то другие ограничения, обязательно сообщите нам, мы исключим и заменим эти продукты на другие в рамках индивидуальной линейки SELECT.\n' +
                                    '<p class="mt-1.5">Меню базовой линейки – LITE можно посмотреть на нашей странице Instagram в актуальных историях по ссылке: <a href="http://surl.li/ppgox" target="_blank">http://surl.li/ppgox</a></p>',
                                isVisible: false
                            }
                        ]
                    },
                    {
                        id: 1,
                        title: 'Доставка 🚗',
                        faqs: [
                            {
                                id: 0,
                                question: 'В какие дни у вас есть доставка?',
                                answer: 'Доставка действует ежедневно с понедельника по субботу. Мы готовим все рационы ночью и доставляем утром в свежеприготовленном виде. Вы можете выбрать удобный для вас часовой период для доставки с 06.30 до 09.30 утра.',
                                isVisible: false
                            },
                            {
                                id: 1,
                                question: 'В какие районы города у вас есть доставка? 🗺',
                                answer: 'Доставка действует в черте города за исключением отдаленных районов. В случае отсутствия доставки по вашему адресу, Вы всегда можете указать альтернативный адрес.',
                                isVisible: false
                            },
                            {
                                id: 2,
                                question: 'Можно ли изменить адрес и время доставки?',
                                answer: 'Конечно! Вы можете изменить адрес и время доставки до 20.00 часов. Достаточно написать или позвонить к нам по номеру +7 776 6906090 📲.',
                                isVisible: false
                            }
                        ]
                    },
                    {
                        id: 2,
                        title: 'Оплата 💰',
                        faqs: [
                            {
                                id: 0,
                                question: 'Какие скидки у вас есть?',
                                answer: 'У нас действует система скидок, где чем больше дней вы заказываете, тем меньше цена за день. А если вы планируете заказывать питание не только для себя, то, мы с удовольствием подарим для вас бонусные дни питания. За актуальными акциями обращайтесь к менеджерам по номеру +7 776 6906090 📲.',
                                isVisible: false
                            },
                            {
                                id: 1,
                                question: 'Как производится оплата?',
                                answer: 'Вы можете оплатить наличными в первый день доставки, с помощью POS терминала или мы отправим для вас счет на оплату в приложении Kaspi 💳',
                                isVisible: false
                            },
                            {
                                id: 2,
                                question: 'Можно ли оплатить 2 курса питания сразу?',
                                answer: 'Конечно, так вы сможете прийти не только к своему результатам, но и сохранить их как можно дольше 💪🏻',
                                isVisible: false
                            }
                        ]
                    }
                ]
            }
        }
    }
</script>
