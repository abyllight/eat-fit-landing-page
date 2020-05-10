<template>
  <div class="w-full h-screen small flex items-center justify-center">

      <div class="absolute z-10 px-3">
          <div>
              <h1 class="font-light text-white text-3xl md:text-5xl leading-tight uppercase mb-8 text-center">
                  Доставка <br class="md:hidden"> 5-ти разового
                  <br><span class="font-bold text-brand-green-hover">здорового питания</span>
                  <br>по городу Нур-Султан
              </h1>
          </div>

          <div class="text-center">
              <a class="px-5 py-3 rounded shadow-lg bg-brand-green hover:bg-brand-green-hover text-sm text-white uppercase tracking-wider font-semibold cursor-pointer"
                 v-scroll-to="'#programs'">
                  смотреть программы
              </a>
          </div>
      </div>
      <div class="w-full h-screen absolute bg-black z-0 opacity-50">
      </div>
  </div>
</template>
<style scoped>
    .small{
        background: url('/img/smsm.jpg') no-repeat center;
        background-size: cover;
    }

    @media (min-width: 1280px) {
        .small{
            background: url('/img/lglg.jpg') no-repeat center;
            background-size: cover;
        }
    }
</style>
<script>
export default {
    name: 'Hero'
}
</script>
