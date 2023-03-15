<template>
    <div class="fixed w-full z-30 top-0 bg-brand-blue">
        <div class="py-2 max-w-6xl mx-auto px-5">
            <div class="flex items-center justify-between">
                <button
                    type="button"
                    @click="isOpen = !isOpen"
                    class="cursor-pointer focus:outline-none outline-none h-10 w-10 lg:hidden"
                >
                    <svg
                         viewBox="0 0 24 24"
                         class="fill-current text-brand-green hover:text-lime-400"
                    >
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
                    </svg>
                </button>

                <div class="flex items-center">
                    <a href="/#">
                        <img class="h-10 w-10 lg:mr-5" src="/img/logo.png" alt="Logo">
                    </a>

                    <nav class="hidden xl:block">
                        <a v-for="item in menu"
                           :key="item.id"
                           class="px-3 py-1 text-white text-sm rounded hover:text-brand-green cursor-pointer"
                           :href="item.link">
                            {{ item.name }}
                        </a>
                    </nav>
                </div>

                <div class="flex items-center">
                    <a
                        href="https://wa.me/77000906090?text=Здравствуйте, проконсультируйте меня пожалуйста. "
                        target="_blank">
                        <img class="h-8" src="/img/icons/whatsapp.svg" alt="Whatsapp">
                    </a>
                    <a
                        href="tel:+77000906090"
                        class="text-white text-lg font-medium hidden ml-4 xl:block">
                        +7 (700) 090 60 90
                    </a>
                    <a href="/cart" class="hidden xl:block ml-4">
                        <div class="relative w-10">
                            <img src="/img/icons/cart_white.svg" alt="cart" class="w-7">
                            <div class="rounded-full bg-yellow-300 w-5 h-5 absolute -top-1.5 right-1 flex justify-center items-center text-xs font-semibold">
                                {{ this.$store.state.totalCount }}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <transition name="show">
                <nav
                    v-show="isOpen"
                    class="absolute top-0 left-0 z-10 bg-brand-blue w-3/4 md:w-1/3 h-screen px-5 py-3"
                >
                    <button
                        type="button"
                        @click="isOpen = !isOpen"
                        class="cursor-pointer focus:outline-none outline-none h-10 w-10 lg:hidden"
                    >
                        <svg viewBox="0 0 24 24"
                             class="fill-current text-brand-green hover:text-lime-400">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/>
                        </svg>
                    </button>
                    <a
                        href="#"
                        class="mt-2 block px-2 py-2 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer"
                        @click="isOpen=false">
                        Главная
                    </a>
                    <a v-for="item in menu"
                       :key="item.id"
                       class="mt-2 block px-2 py-2 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer"
                       :href="item.link"
                       @click="isOpen=false">
                        {{ item.name }}
                    </a>
                </nav>
            </transition>
            <div
                v-show="isOpen"
                @click="isOpen=false"
                class="w-full h-screen bg-black z-0 opacity-50 absolute top-0 bottom-0">
            </div>
        </div>
    </div>
</template>
<style scoped>
.show-enter-active,
.show-leave-enter {
    transform: translateX(0%);
    transition: all .3s linear;
}
.show-enter,
.show-leave-to {
    transform: translateX(-100%);
    transition: all .3s linear;
}
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
                    link: '/#about'
                },
                {
                    id: 1,
                    name: 'Программы',
                    link: '/#programs'
                },
                {
                    id: 2,
                    name: 'Пример меню',
                    link: '/#sample'
                },
                {
                    id: 3,
                    name: 'EatFitGo',
                    link: 'go'
                },
                {
                    id: 4,
                    name: 'Детокс',
                    link: 'detox'
                },
                {
                    id: 5,
                    name: 'Отзывы',
                    link: '/#reviews'
                },
                {
                    id: 6,
                    name: 'FAQ',
                    link: '/#faq'
                },
                {
                    id: 7,
                    name: 'Контакты',
                    link: '/#contacts'
                }
            ]
        }
    },
    mounted() {
        let ad = this.$store.state.ad
        let self = this

        if (ad === 0) {
            setTimeout(function () {
                self.$store.dispatch('setAd', 1)
            }, 30000)
        }
    },
}
</script>
