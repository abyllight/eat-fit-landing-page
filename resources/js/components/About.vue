<template>
    <div id="#about" class="bg-gray-200 py-8">
        <div class="max-w-6xl mx-auto px-3">
            <div class="max-w-xl mx-auto mb-10">
                <h3 class="text-center font-bold text-3xl lg:text-4xl mb-3">Что это?</h3>
                <p class="text-center font-light text-xl lg:text-2xl mb-8">
                    <span class="text-brand-green font-medium">Eat&Fit™</span> — сервис доставки здорового питания.
                    Ежедневно команда профессионалов разрабатывает для
                    Вас рацион из 7-ми блюд из кухонь 26-ти стран мира,
                    упаковывает в одноразовые контейнеры, собирает в набор
                    с приборами и питьевой водой и доставляет до дверей Вашего дома.
                </p>
                <p class="text-center font-bold text-xl lg:text-2xl max-w-md mx-auto">
                    Никакого мытья грязной посуды,
                    изнурительного придумывания блюд и
                    очередей в магазинах 😉
                </p>
            </div>
            <div class="flex flex-col lg:flex-row justify-center">
                <div class="flex flex-col md:flex-row items-center md:justify-center">
                    <div class="w-64 h-64 md:w-72 md:h-72 bg-white p-6 flex flex-col justify-center">
                        <h4 class="font-bold text-xl mb-2 leading-tight">Создано профессионалами</h4>
                        <p class="text-gray-700 text-base">Меню разработано ТОПовыми шеф-поварами в содействии с диетологами, нутрициологами, согласно мировым стандартам и нормам</p>
                    </div>
                    <div>
                        <img src="/img/chef.jpg" class="w-64 h-64 md:w-72 md:h-72 object-cover object-center" alt="Шеф-повар EAT&FIT">
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center md:justify-center">
                    <div class="w-64 h-64 md:w-72 md:h-72 bg-white p-6 flex flex-col justify-center">
                        <h4 class="font-bold text-xl mb-2 leading-tight">Ночное производство</h4>
                        <p class="text-gray-700 text-base">Полезная еда = свежая еда. Рационы попадают на стол к клиентам сразу после приготовления</p>
                    </div>
                    <div>
                        <img src="/img/kitchen.jpg" class="w-64 h-64 md:w-72 md:h-72 object-cover object-center" alt="Кухня EAT&FIT">
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row justify-center">
                <div class="flex flex-col md:flex-row items-center md:justify-center">
                    <div>
                        <img src="/img/cook.jpg" class="w-64 h-64 md:w-72 md:h-72 object-cover object-center" alt="Cook&Chill">
                    </div>
                    <div class="w-64 h-64 md:w-72 md:h-72 bg-white p-6 flex flex-col justify-center">
                        <h4 class="font-bold text-xl mb-2 leading-tight">Передовые технологии</h4>
                        <p class="text-gray-700 text-base">Sous-vide, cook&chill — дорогостоящие технологии позволяют «запечатать» свежесть блюд</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center md:justify-center">
                    <div>
                        <img src="/img/cert.jpg" class="w-64 h-64 md:w-72 md:h-72 object-cover object-center" alt="Торговая марка EAT&FIT">
                    </div>
                    <div class="w-64 h-64 md:w-72 md:h-72 bg-white p-6 flex flex-col justify-center">
                        <h4 class="font-bold text-xl mb-2 leading-tight">Сертифицированное производство</h4>
                        <p class="text-gray-700 text-base">Свидетельство и заключение СЭС, зарегистрированная торговая марка EAT&FIT™ — гарантия качества и безопасности</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
</style>

<script>
export default {
    name: 'about',
}
</script>
