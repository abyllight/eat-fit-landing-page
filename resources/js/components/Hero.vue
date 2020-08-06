<template>
  <div class="w-full h-screen small flex items-center justify-center">

      <div class="absolute z-10 top-0 px-3 py-32 h-full flex flex-col justify-between">
          <div>
              <h1 class="font-thin text-white text-2xl md:text-4xl leading-tight uppercase mb-8 text-center">
                  <span class="font-bold text-brand-green-hover">Здоровое питание</span>
                  <br>с доставкой по городу<br> Астана
              </h1>
          </div>

          <div class="text-center">
              <a class="px-6 py-4 rounded shadow-lg bg-brand-green hover:bg-brand-green-hover text-sm text-white uppercase tracking-wider font-semibold cursor-pointer"
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
