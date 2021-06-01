<template>
    <div class="py-1 lg:py-2 max-w-6xl mx-auto px-5 mx-auto">
        <div class="flex items-center justify-between">
            <button
                @click="isOpen = !isOpen"
                type="button"
                class="block text-brand-green lg:hidden"
            >
                <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                    <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                    <path v-if="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                </svg>
            </button>

            <a href="/#hero">
                <img class="h-10" src="/img/logo.png" alt="Logo">
            </a>

            <nav class="hidden lg:block">
                <a v-for="item in menu"
                   :key="item.id"
                   class="px-2 py-1 mr-2 text-white text-sm rounded hover:text-brand-green cursor-pointer"
                   :href="'/#' + item.link">
                    {{ item.name }}
                </a>
            </nav>

            <div class="flex items-center">
                <a
                    href="https://wa.me/77000906090?text=Здравствуйте, проконсультируйте меня пожалуйста. Меня зовут "
                   target="_blank"
                >
                    <img class="h-8" src="/img/icons/whatsapp.svg" alt="Whatsapp">
                </a>
                <a
                    href="tel:+77000906090"
                    class="text-white text-lg font-medium hidden ml-4 lg:block">
                    +7 (700) 090 60 90
                </a>
            </div>
        </div>
    <nav
        v-show="isOpen"
        class="absolute top-0 left-0 z-10 bg-brand-blue w-3/4 md:w-1/3 h-screen px-5 py-1"
    >
        <button @click="isOpen = !isOpen" type="button" class="block text-brand-green hover:text-brand-green-hover focus:text-brand-green focus:outline-none lg:hidden">
            <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
            </svg>
        </button>
        <a v-for="item in menu"
           :key="item.id"
           class="mt-2 block px-2 py-1 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer"
           :href="'/#' + item.link"
           @click="isOpen=false">
            {{ item.name }}
        </a>
    </nav>
        <div v-show="isOpen" @click="isOpen=false" class="w-full h-screen bg-black z-0 opacity-50 absolute top-0 bottom-0">

        </div>
    </div>
</template>
<style>

</style>
<script>

export default {
    data(){
        return{
            isOpen: false,
            menu: [
                {
                    id: 0,
                    name: 'О нас',
                    link: 'about'
                },
                {
                    id: 1,
                    name: 'Программы',
                    link: 'programs'
                },
                {
                    id: 2,
                    name: 'Пример меню',
                    link: 'sample'
                },
                {
                    id: 3,
                    name: 'Детокс',
                    link: 'detox'
                },
                {
                    id: 4,
                    name: 'Отзывы',
                    link: 'reviews'
                },
                {
                    id: 5,
                    name: 'FAQ',
                    link: 'faq'
                },
                {
                    id: 6,
                    name: 'Контакты',
                    link: 'contacts'
                }

            ]
        }
    }
}
</script>
