<template>
  <header class="bg-gray-900 fixed w-full z-30">
    <div class="flex items-center justify-between px-3 py-2 max-w-6xl mx-auto">
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
            <a v-scroll-to="'#about'" class="px-2 py-1 mr-2 text-white text-lg rounded hover:bg-brand-green cursor-pointer">Что это?</a>
            <a v-scroll-to="'#how-it-works'" class="px-2 py-1 mr-2 text-white text-lg rounded hover:bg-brand-green cursor-pointer">Как это работает?</a>
            <a v-scroll-to="'#programs'" class="px-2 py-1 mr-2 text-white text-lg rounded hover:bg-brand-green cursor-pointer">Программы</a>
            <a v-scroll-to="'#products'" class="px-2 py-1 mr-2 text-white text-lg rounded hover:bg-brand-green cursor-pointer">Eat&Chill</a>
            <!--<a v-scroll-to="'#sample'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">Пример рациона</a>-->
            <a v-scroll-to="'#instagram'" class="px-2 py-1 mr-2 text-white text-lg rounded hover:bg-brand-green cursor-pointer">Отзывы</a>
            <a v-scroll-to="'#faq'" class="px-2 py-1 mr-2 text-white text-lg rounded hover:bg-brand-green cursor-pointer">FAQ</a>
            <a v-scroll-to="'#contact'" class="px-2 py-1 mr-2 text-white text-lg rounded hover:bg-brand-green cursor-pointer">Контакты</a>
        </nav>

        <button @click="isVisible = true" class="relative outline-none focus:outline-none">
            <img src="/img/icons/shopping-bag.svg" class="h-8 w-8">
            <div class="w-5 h-5 rounded-full bg-red-600 absolute top-0 right-0 flex items-center justify-center">
                <span class="text-xs font-semibold text-white">{{ $store.state.cartCount }}</span>
            </div>
        </button>

    </div>
    <nav v-show="isOpen" class="px-4 md:px-6 lg:px-10 py-4 absolute z-30 bg-gray-900 w-3/4 md:w-1/3 h-screen">
      <a v-scroll-to="'#about'" class="px-2 py-1 block text-white md:text-xl font-semibold rounded hover:bg-brand-green cursor-pointer">Что это?</a>
      <a v-scroll-to="'#how-it-works'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green cursor-pointer">Как это работает?</a>
      <a v-scroll-to="'#programs'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green cursor-pointer">Программы</a>
      <a v-scroll-to="'#products'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green cursor-pointer">Eat&Chill</a>
      <!--<a v-scroll-to="'#sample'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">Пример рациона</a>-->
      <a v-scroll-to="'#instagram'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green cursor-pointer">Отзывы</a>
      <a v-scroll-to="'#faq'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green cursor-pointer">FAQ</a>
      <a v-scroll-to="'#contact'" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green cursor-pointer">Контакты</a>
    </nav>
      <cart :show="isVisible" @close="isVisible = false"
            @showSuccess="showSuccess = true"
            @showFail="showFail = true"></cart>
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
            showFail: false
        }
    },
    mounted(){
        console.log('Navbar mounted');
    }
}
</script>
