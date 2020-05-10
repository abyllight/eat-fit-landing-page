<template>
  <header class="fixed w-full z-30 shadow" :class="[scrollPosition > 200 ? 'bg-gray-900' : 'bg-transparent']">
    <div class="flex items-center justify-between py-1 lg:py-2 px-3 container mx-auto">
        <button @click="isOpen = !isOpen" type="button" class="block text-brand-green hover:text-brand-green-hover focus:text-brand-green focus:outline-none lg:hidden">
            <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                <path v-if="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
            </svg>
        </button>
          <div>
              <a href="/">
                <img class="h-10" src="/img/logo.png" alt="EAT&FIT">
              </a>
          </div>
        <nav class="hidden lg:block">
            <a class="px-2 py-1 mr-2 rounded text-white hover:bg-brand-green hover:text-white cursor-pointer" v-scroll-to="'#about'">Что это?</a>
            <a class="px-2 py-1 mr-2 rounded text-white hover:bg-brand-green hover:text-white cursor-pointer" v-scroll-to="'#how-it-works'">Как это работает?</a>
            <a class="px-2 py-1 mr-2 rounded text-white hover:bg-brand-green hover:text-white cursor-pointer" v-scroll-to="'#programs'">Программы</a>
            <a class="px-2 py-1 mr-2 rounded text-white hover:bg-brand-green hover:text-white cursor-pointer" v-scroll-to="'#products'">Eat&Chill</a>
            <a class="px-2 py-1 mr-2 rounded text-white hover:bg-brand-green hover:text-white cursor-pointer" v-scroll-to="'#instagram'">Отзывы</a>
            <a class="px-2 py-1 mr-2 rounded text-white hover:bg-brand-green hover:text-white cursor-pointer" v-scroll-to="'#faq'">FAQ</a>
            <a class="px-2 py-1 mr-2 rounded text-white hover:bg-brand-green hover:text-white cursor-pointer" v-scroll-to="'#contact'">Контакты</a>
        </nav>

        <button @click="isVisible = true" class="relative outline-none focus:outline-none">
            <img src="/img/icons/shopping-bag.svg" width="30">
            <div class="w-5 h-5 rounded-full bg-red-600 absolute top-0 right-0 -mr-2 flex items-center justify-center">
                <span class="text-xs font-semibold text-white">{{ $store.state.cartCount }}</span>
            </div>
        </button>

    </div>
    <nav v-show="isOpen" class="absolute top-0 bg-gray-900 w-3/4 md:w-1/3 h-screen px-3 py-10">
        <button @click="isOpen = !isOpen" type="button" class="block text-brand-green hover:text-brand-green-hover focus:text-brand-green focus:outline-none lg:hidden">
            <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24">
                <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
            </svg>
        </button>
      <a class="px-2 py-1 block text-white md:text-xl rounded hover:bg-brand-green cursor-pointer" v-scroll-to="'#about'" @click.prevent="isOpen=false">Что это?</a>
      <a class="mt-2 block px-2 py-1 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer" v-scroll-to="'#how-it-works'" @click.prevent="isOpen=false">Как это работает?</a>
      <a class="mt-2 block px-2 py-1 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer" v-scroll-to="'#programs'" @click.prevent="isOpen=false">Программы</a>
      <a class="mt-2 block px-2 py-1 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer" v-scroll-to="'#products'" @click.prevent="isOpen=false">Eat&Chill</a>
      <a class="mt-2 block px-2 py-1 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer" v-scroll-to="'#instagram'" @click.prevent="isOpen=false">Отзывы</a>
      <a class="mt-2 block px-2 py-1 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer" v-scroll-to="'#faq'" @click.prevent="isOpen=false">FAQ</a>
      <a class="mt-2 block px-2 py-1 text-white md:text-xl rounded hover:bg-brand-green cursor-pointer" v-scroll-to="'#contact'" @click.prevent="isOpen=false">Контакты</a>
    </nav>

      <cart :show="isVisible" @close="isVisible = false"
            @showSuccess="showSuccess = true"
            @showFail="showFail = true">
      </cart>
      <success-modal :showSuccess="showSuccess" @close="showSuccess = false"></success-modal>
      <fail-modal :showFail="showFail" @close="showFail = false"></fail-modal>
  </header>
</template>
<style>

</style>
<script>
    import Cart from "./Cart";
    import SuccessModal from "./SuccessModal";
    import FailModal from "./FailModal";
export default {
    components: {
        Cart,
        SuccessModal,
        FailModal
    },
    data(){
        return{
            isOpen: false,
            isVisible: false,
            showSuccess: false,
            showFail: false,
            scrollPosition: 0
        }
    },
    methods: {
        updateScroll() {
            this.scrollPosition = window.scrollY
        }
    },
    mounted() {
        window.addEventListener('scroll',  this.updateScroll)
    },
    destroy() {
        window.removeEventListener('scroll', this.updateScroll)
    }
}
</script>
