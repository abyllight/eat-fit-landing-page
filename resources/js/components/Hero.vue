<template>
  <div class="w-full h-screen small">

      <div class="container mx-auto h-screen px-3 py-24 flex flex-col items-center md:justify-center">
          <div>
              <h1 class="font-light text-3xl md:text-5xl leading-tight uppercase mb-8 text-center">
                  Доставка <br class="md:hidden"> 5-ти разового
                  <br><span class="font-bold text-brand-green">здорового питания</span>
                  <br>по городу Нур-Султан
              </h1>
          </div>


          <a class="px-5 py-3 rounded shadow-lg bg-brand-green hover:bg-brand-green-hover text-sm text-white uppercase tracking-wider font-semibold cursor-pointer"
             v-scroll-to="'#programs'">
              смотреть программы
          </a>
      </div>
  </div>
</template>
<style scoped>
    .small{
        background: url('/img/bgbg.jpg') no-repeat center;
        background-size: cover;
    }

    @media (min-width: 640px) {
        .small{
            background: url('/img/tablet.jpg') no-repeat center;
            background-size: cover;
        }
    }

    @media (min-width: 1280px) {
        .small{
            background: url('/img/large.jpg') no-repeat center;
            background-size: cover;
        }
    }
</style>
<script>
export default {
    name: 'Hero'
}
</script>
