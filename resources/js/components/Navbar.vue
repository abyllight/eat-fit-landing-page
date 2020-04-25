<template>
  <header class="bg-gray-900 fixed w-full z-30">
    <div class="flex items-center justify-between px-3 py-2 max-w-6xl mx-auto">
        <button @click="isOpen = !isOpen" type="button" class="block text-brand-green hover:text-brand-green-hover focus:text-brand-green focus:outline-none">
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
        <a href="/" class="relative">
            <img src="/img/icons/shopping-bag.svg" class="h-8 w-8">
            <div class="w-4 h-4 rounded-full bg-red-600 absolute top-0 right-0 flex items-center justify-center">
                <span class="text-xs font-semibold text-white">10</span>
            </div>
        </a>
      <!--<div class="hidden lg:flex">
        <a href="#" class="ml-4 rounded px-2 py-1 text-white font-medium rounded hover:bg-brand-green">Что это?</a>
        <a href="#" class="ml-3 rounded px-2 py-1 text-white font-medium rounded hover:bg-brand-green">Как это работает?</a>
        <a href="#" class="ml-3 rounded px-2 py-1 text-white font-medium rounded hover:bg-brand-green">Программы</a>
        <a href="#" class="ml-3 rounded px-2 py-1 text-white font-medium rounded hover:bg-brand-green">Пример рациона</a>
        <a href="#" class="ml-3 rounded px-2 py-1 text-white font-medium rounded hover:bg-brand-green">Отзывы</a>
        <a href="#" class="ml-3 rounded px-2 py-1 text-white font-medium rounded hover:bg-brand-green">FAQ</a>
        <a href="#" class="ml-3 rounded px-2 py-1 text-white font-medium rounded hover:bg-brand-green">Контакты</a>
      </div>-->

    </div>
    <nav v-show="isOpen" class="px-4 md:px-6 lg:px-10 pt-4 pb-4 absolute z-20 bg-gray-900 w-3/4 md:w-1/3 h-screen">
      <a href="#about" class="px-2 py-1 block text-white md:text-xl font-semibold rounded hover:bg-brand-green">Что это?</a>
      <a href="#how-it-works" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">Как это работает?</a>
      <a href="#programs" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">Программы</a>
      <a href="#" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">Пример рациона</a>
      <a href="#" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">Отзывы</a>
      <a href="#" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">FAQ</a>
      <a href="#" class="mt-2 block px-2 py-1 text-white md:text-xl font-semibold rounded hover:bg-brand-green">Контакты</a>
    </nav>
  </header>
</template>
<style>

</style>
<script>
export default {
    data(){
        return{
            isOpen: false,
        }
    },
    mounted(){
        console.log('Navbar mounted');
    }
}
</script>
