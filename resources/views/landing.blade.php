@extends('layout.app')
@section('content')
    <!-- Hero section -->
    <section id="hero">
        <hero></hero>
    </section>

    <!-- About section -->
    <section id="about" class="py-16">
        <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8 lg:mb-12">
            О компании в цифрах
        </h1>
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row lg:w-3/4 lg:mx-auto justify-around mb-5">
                <div class="flex-col items-center md:w-72 mb-6">
                    <div class="flex justify-content-center items-center">
                        <span class="text-brand-green font-medium text-5xl mr-3">8+</span>
                        <p class="font-semibold leading-tight text-lg">лет <br> на рынке</p>
                    </div>
                    <p class="text-sm">Удерживаем лидерские позиции, <br>и задаем темп рынку</p>
                </div>
                <div class="flex-col items-center md:w-72">
                    <div class="flex justify-content-center items-center">
                        <span class="text-brand-green font-medium text-5xl mr-3">10000+</span>
                        <p class="font-semibold leading-tight text-lg">довольных <br> клиентов</p>
                    </div>
                    <p class="text-sm">Столько людей мы накормили за все время работы</p>
                </div>
            </div>
            <div class="lg:w-3/4 lg:mx-auto flex flex-col md:flex-row justify-around">
                <div class="flex-col items-center md:w-72 mb-5">
                    <div class="flex justify-content-center items-center">
                        <span class="text-brand-green font-medium text-5xl mr-3">4.8</span>
                        <p class="font-semibold leading-tight text-lg">рейтинг</p>
                    </div>
                    <p class="text-sm">Согласно отзывам Google и 2GIS</p>
                </div>
                <div class="flex-col items-center md:w-72">
                    <div class="flex justify-content-center items-center">
                        <span class="text-brand-green font-medium text-5xl mr-3">300+</span>
                        <p class="font-semibold leading-tight text-lg">ежедневных <br> доставок</p>
                    </div>
                    <p class="text-sm">Более 20 пунктуальных курьеров ежедневно доставляют здоровое питание</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features section -->
    <section id="features" class="py-16 bg-brand-blue-light">
        <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8 lg:mb-16">
            Наши преимущества
        </h1>

        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row lg:items-center container">
                <div class="flex flex-col md:flex-row md:items-center mb-8 md:w-3/4 md:mx-auto">
                    <img src="/img/chef.jpg"
                         class="w-full md:w-48 xl:w-56 h-56 rounded-xl object-cover object-top mb-3"
                         alt="Шеф-повар EAT&FIT">
                    <div class="flex flex-col md:px-8">
                        <h4 class="font-medium text-lg mb-3">Создано <br> профессионалами</h4>
                        <p class="text-sm">Меню разработано ТОПовыми шеф-поварами в содействии
                            с нутрициологами и диетологами, согласно мировым стандартам и нормам</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:items-center mb-8 md:w-3/4 md:mx-auto">
                    <img src="/img/night.jpg"
                         class="w-full md:w-48 xl:w-56 h-56 rounded-xl object-cover object-center mb-3"
                         alt="Полезная еда">
                    <div class="flex flex-col md:px-8">
                        <h4 class="font-medium text-lg mb-3">Ночное <br> производство</h4>
                        <p class="text-sm">Полезная еда = свежая еда.
                            Готовые рационы попадают
                            на стол к клиентам сразу
                            после приготовления.</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row lg:items-center container">
                <div class="flex flex-col md:flex-row md:items-center mb-8 md:w-3/4 md:mx-auto">
                    <img src="/img/cook.jpg"
                         class="w-full md:w-48 xl:w-56 h-56 rounded-xl object-cover object-center mb-3"
                         alt="Sous-vide, cook&chill">
                    <div class="flex flex-col md:px-8">
                        <h4 class="font-medium text-lg mb-3">Передовые методы приготовления</h4>
                        <p class="text-sm">Sous-vide, cook&chill — дорогостоящие технологии позволяют «запечатать»
                            свежесть блюд</p>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row md:items-center mb-8 md:w-3/4 md:mx-auto">
                    <img src="/img/cert.jpg"
                         class="w-full md:w-48 xl:w-56 h-56 object-cover object-center rounded-xl mb-3"
                         alt="Торговая марка EAT&FIT">
                    <div class="flex flex-col md:px-8">
                        <h4 class="font-medium text-lg mb-3">Сертифицированное производство</h4>
                        <p class="text-sm">Свидетельство и заключение СЭС, зарегистрированная торговая марка EAT&FIT™ — гарантия качества и безопасности</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service section -->
    <section id="service" class="py-16">
        <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8 lg:mb-16 px-4">
            Приобретая EAT&FIT, вы получаете качество и сервис
        </h1>

        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center md:text-left flex flex-col lg:flex-row mb-10">
                <div class="flex flex-col md:flex-row mb-10">
                    <div class="mb-10 md:w-1/2">
                        <img src="/img/icons/moto.png" class="h-24 mb-4 mx-auto md:mx-0" alt="Доставка еды">
                        <div class="mx-auto px-6">
                            <h4 class="font-medium mb-3">
                                Доставляем еду <br> к вашему завтраку
                            </h4>
                            <p class="text-sm">
                                Свежий рацион на день в удобное для вас время с 6:30 до 9:30 утра
                            </p>
                        </div>
                    </div>

                    <div class="md:w-1/2">
                        <img src="/img/icons/service.png" class="h-24 mb-4 mx-auto md:mx-0" alt="Высокая оценка">
                        <div class="mx-auto px-6">
                            <h4 class="font-medium mb-3">
                                Высокая оценка <br> сервиса
                            </h4>
                            <p class="text-sm mb-2">
                                Мы регулярно собираем обратную связь и работаем над улучшением
                            </p>
                            <p class="text-sm">
                                Наша команда сделает все возможное, чтобы ваш путь к цели был комфортным
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row">
                    <div class="mb-10 md:w-1/2">
                        <img src="/img/icons/delivered.png" class="h-24 mb-4 mx-auto md:mx-0" alt="Свежие продукты">
                        <div class="mx-auto px-6">
                            <h4 class="font-medium mb-3">
                                Проверенные поставщики продуктов
                            </h4>
                            <p class="text-sm mb-2">
                                Крупные и зарекомендовавшие себя на рынке компании
                            </p>
                            <p class="text-sm">
                                Ежедневная поставка свежих продуктов и проверка качества
                            </p>
                        </div>
                    </div>

                    <div class="md:w-1/2">
                        <img src="/img/icons/cart.png" class="h-24 mb-4 mx-auto md:mx-0" alt="Отборные продукты питания">
                        <div class="mx-auto px-6">
                            <h4 class="font-medium mb-3">
                                Отборные продукты питания
                            </h4>
                            <p class="text-sm">
                                Мясо-молочная продукция, крупы, макароны и другая бакалея премиальных брендов
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full text-center">
                <a href="#trial"
                    class="border-brand-yellow rounded-lg cursor-pointer shadow-lg
                    text-center text-xs font-semibold uppercase py-3 md:py-4 tracking-wider focus:outline-none px-10
                    bg-gradient-to-b from-gr-yellow-start to-gr-yellow-end hover:from-brand-yellow-hover">
                    Оставить заявку
                </a>
            </div>
        </div>
    </section>

    <!-- Steps section -->
    <section id="steps" class="py-16 bg-brand-blue-light">
        <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8 lg:mb-16 px-4">
            4 шага к вашей стройности и продуктивности
        </h1>

        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col justify-center md:flex-row">
                <div class="flex flex-col text-center items-center mb-8 w-full">
                    <img src="/img/icons/step1.png" class="w-16 mx-auto mb-2" alt="Шаг 1">
                    <p class="text-sm">
                        Вы оставляете заявку
                    </p>
                </div>

                <div class="flex flex-col text-center items-center mb-8 w-full">
                    <img src="/img/icons/step2.png" class="w-12 mx-auto mb-3" alt="Шаг 2">
                    <p class="text-sm">
                        Созваниваемся и подбираем <br> программу питания
                    </p>
                </div>

                <div class="flex flex-col text-center items-center mb-8 w-full">
                    <img src="/img/icons/step3.png" class="w-12 mx-auto mb-3" alt="Шаг 3">
                    <p class="text-sm">
                        Мы готовим ночью и утром доставляем свежим
                    </p>
                </div>

                <div class="flex flex-col text-center items-center mb-8 w-full">
                    <img src="/img/icons/step4.png" class="w-12 mx-auto mb-3" alt="Шаг 4">
                    <p class="text-sm">
                        Вы легко достигаете <br> своей цели
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs -->
    <section id="programs" class="py-16">
        <program></program>
    </section>

    <!-- Section sample -->
    <section id="sample" class="py-16">
        <sample-menu></sample-menu>
    </section>

    <!-- Section trial -->
    <section id="trial" class="py-20 w-full bg-trial-lg bg-cover bg-no-repeat bg-center">
        <trial></trial>
    </section>

    <!-- Section daily -->
<!--    <section id="daily" class="py-16">
        <daily></daily>
    </section>-->

    <!-- Section detox -->
<!--    <section id="detox" class="py-16">
        <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8 lg:mb-16 px-4">
            Детокс
        </h1>

        <div class="max-w-5xl mx-auto px-4">
            <div class="md:flex md:items-center md:justify-center">
                <div class="mb-4">
                    <img src="/img/detox/detox.jpg"
                         alt="Детокс"
                         class="rounded shadow-lg object-cover object-center w-full h-72 md:w-64 md:h-auto lg:w-72 mx-auto md:mr-10">
                </div>

                <div class="md:w-1/2">
                    <p class="font-light mb-10">Это способ очищения организма от токсинов,
                        на основе смузи. Основной принцип — потребление овощей и фруктов в
                        жидком виде, но без исключения клетчатки, содержащейся в них.
                        Таким образом, всего за одну-две недели вы можете восстановить силы,
                        укрепить иммунитет, вернуть молодость коже и волосам.
                    </p>

                    <a href="/detox"
                       class="px-5 py-2 text-xs uppercase font-semibold
                       rounded shadow bg-yellow-300 hover:bg-yellow-400 focus:outline-none">
                        Подробнее
                    </a>
                </div>
            </div>
        </div>
    </section>-->

    <!-- Section reviews -->
    <section id="reviews" class="py-16">
        <instagram></instagram>
    </section>

    <!-- Section FAQ -->
    <section id="faq" class="py-16 bg-brand-blue-light">
        <faq></faq>
    </section>

    <!-- Section Team -->
    <section id="team" class="py-16">
        <team></team>
    </section>

    <!--  Section Cart  -->
    <section id="cart">
<!--        <basket></basket>-->
    </section>

    <!-- Section Contact -->
    <section id="contacts" class="pb-16">
        <h1 class="text-xl lg:text-2xl text-center font-semibold mb-4 px-4">
            Наши контакты
        </h1>
        <h4 class="max-w-lg mx-auto text-center mb-8">Пишите, звоните - мы на связи!</h4>

        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-center">
                <div class="hidden md:block w-1/2">
                    <img src="/img/teamlast.jpg" class="w-full rounded-lg shadow-xl">
                </div>
                <div class="bg-brand-blue-light rounded-lg shadow p-8 lg:px-16 md:ml-8">
                    <a
                        href="https://2gis.kz/nur_sultan/firm/70000001028666491?m=71.4883%2C51.166058%2F16"
                        target="_blank"
                        class="mb-8">
                        <img src="/img/icons/2gis.png" class="w-5 h-5 mb-2 md:mr-2" alt="Адрес 2gis">
                        <p class="font-semibold">Адрес</p>
                        <p class="text-xs">Нур-Султан, ул. Жансугурулы, 14/1а</p>
                    </a>
                    <div class="flex mt-8 mb-8">
                        <a
                            href="tel:+77766906090"
                            onclick="yaCounter56810422.reachGoal('clicknumber'); return true;"
                            class="mr-10 w-1/2">
                            <img src="/img/icons/phone-black.svg" class="w-5 h-5 mb-2" alt="Телефон">
                            <p class="font-semibold text">Телефон</p>
                            <p class="text-xs">+7 (776) 690 60 90</p>
                        </a>
                        <a
                            href="mailto:eat.and.fit@mail.ru"
                            target="_blank"
                            class="w-1/2">
                            <img src="/img/icons/email-24px.svg" class="w-5 h-5 mb-2" alt="Почта">
                            <p class="font-semibold text">Почта</p>
                            <p class="text-xs">eat.and.fit@mail.ru</p>
                        </a>
                    </div>

                    <div class="flex">
                        <a
                            href="https://wa.me/77766906090?text=Здравствуйте, проконсультируйте меня пожалуйста. "
                            target="_blank"
                            onclick="ym(56810422,'reachGoal','whatsapp'); return true;"
                            class="mr-10 w-1/2">
                            <img src="/img/icons/whatsapp.svg" class="w-5 h-5 mb-2" alt="Whatsapp">
                            <p class="font-semibold">Whatsapp</p>
                            <p class="text-xs">+7 (776) 690 60 90</p>
                        </a>
                        <a
                            href="http://instagram.com/eat.and.fit/"
                            target="_blank"
                            class="w-1/2">
                            <img src="/img/icons/instagram.svg" class="w-5 h-5 mb-2" alt="Instagram">
                            <p class="font-semibold">Instagram</p>
                            <p class="text-xs">eat.and.fit</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    new Vue({
    el: '#hero'
    });

    new Vue({
    el: '#programs'
    });

    new Vue({
    el: '#sample'
    });

    new Vue({
    el: '#trial'
    });

    new Vue({
    el: '#reviews'
    });

    new Vue({
    el: '#faq'
    });

    new Vue({
    el: '#contacts'
    });

    new Vue({
    el: '#detox'
    });

    new Vue({
    el: '#team'
    });
@endsection
