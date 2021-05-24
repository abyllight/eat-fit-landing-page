<template>
      <div class="max-w-6xl mx-auto px-4">
          <h1 class="text-xl lg:text-2xl text-center font-semibold mb-8 px-4">
              Наша команда
          </h1>
          <div class="max-w-6xl mx-auto flex justify-center mb-8">
              <div class="flex flex-wrap justify-center">
                  <div v-for="image in images"
                       :key="image.id"
                       class="w-72 m-3 relative cursor-pointer">
                      <img :src="image.src" class="object-cover object-center rounded-xl">
                      <div class="opacity-100 xl:opacity-0 xl:hover:opacity-100">
                          <div class="w-full h-full absolute bg-black opacity-25 xl:opacity-50 top-0 rounded-xl">
                          </div>
                          <div class="absolute top-0 py-4 px-6">
                              <p class="text-white font-medium text-sm">{{ image.title }}</p>
                          </div>
                          <div class="absolute bottom-0 py-4 px-6">
                              <p class="text-white font-medium text-sm">{{ image.description }}</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
</template>
<style scoped>
.scrollClass{
    /*max-width: 480px;*/
    /*margin: 0 auto;*/
    -webkit-overflow-scrolling: touch; /* [3] */
    -ms-overflow-style: -ms-autohiding-scrollbar;
}
.scrollClass::-webkit-scrollbar{
    display: none;
}
</style>
<script>
export default {
    name: "Team",
    data(){
        return{
            images: [
                {
                    id: 0,
                    src: '/img/team/1.jpg',
                    title: 'Амир – СЕО',
                    description: 'Выпускник Мех-мата МГУ Многократный призёр по регби, бодибилдингу и фитнесу'
                },
                {
                    id: 1,
                    src: '/img/team/2.jpg',
                    title: 'Настя – Отдел заботы и поддержки',
                    description: 'Ваш персональный сервис-менеджер — найдет ключ к вашему сердцу'
                },
                {
                    id: 2,
                    src: '/img/team/3.jpg',
                    title: 'Виталий – Отдел логистики и доставки',
                    description: 'Знает город лучше, чем 2GIS: все его закоулки и кратчайшие пути'
                },
                {
                    id: 3,
                    src: '/img/team/4.jpg',
                    title: 'Артём – Бренд-шеф',
                    description: 'Променял леса Украины на Казахские степи, борщ — на бесбармак, сало — на казы'
                },
                {
                    id: 4,
                    src: '/img/team/5.jpg',
                    title: 'Алэн – Шеф-повар',
                    description: 'Любит чистоту и порядок, а когда он в деле - Mr Proper отдыхает!'
                },
                {
                    id: 5,
                    src: '/img/team/6.jpg',
                    title: 'Чингис – Шеф-повар',
                    description: 'Знает все секретные рецепты Золотой орды и империи Чингисхана'
                }
            ]
        }
    }
}
</script>
