<template>
  <div class="bg-cover bg-center w-full h-screen bg-gray-900 flex items-center justify-center" style="background-image: url('/img/hero.jpg')">
      <div class="absolute z-10 px-3">
        <h1 class="mb-10 text-white text-3xl sm:text-4xl lg:text-5xl text-center leading-tight font-bold">Доставка 5-ти разового
            <br><span class="text-brand-green">здорового питания</span>
            <br>
            по городу Нур-Султан
        </h1>
        <div class="text-center">
          <a v-scroll-to="'#programs'" class="inline-block px-5 py-3 rounded shadow-lg bg-brand-green hover:bg-brand-green-hover text-sm text-white uppercase tracking-wider font-semibold cursor-pointer">
          смотреть программы</a>
        </div>
      </div>
      <div class="w-full h-screen absolute bg-black z-0 opacity-63">
      </div>
  </div>
</template>
<style>

</style>
<script>
export default {
    mounted(){
        console.log('Hero mounted');
    }
}
</script>
