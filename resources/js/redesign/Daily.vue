<template>
  <div>
    <div class="max-w-7xl mx-auto px-4">
      <div>
        <div class="text-left mx-auto mb-16 md:w-2/3 text-gray-700">
          <h1 class="text-xl lg:text-2xl text-left font-semibold mb-3">
            Daily
          </h1>
          <p class="font-light mb-3">Daily - это отличный способ обеспечить себя питанием на день
            и сконцентрироваться на действительно важных целях вашей жизни. Ежедневно меню включает
            <b class="font-bold">3 приема пищи: завтрак, обед и ужин.</b> Питание рассчитано на <b class="font-bold">800-900 калорий</b>, чтобы
            Вы могли добавить перекусы или бизнес-встречи без вреда для фигуры и здоровья.
          </p>
          <p class="font-light mb-8">Стоимость рациона с бесплатной доставкой - <b class="font-bold">5000 тг.</b></p>

          <a
             class="px-5 py-2.5 text-xs uppercase font-semibold
             cursor-pointer rounded shadow bg-yellow-300 hover:bg-yellow-400 focus:outline-none"
             @click="isVisible = true"
          >
            Попробовать
          </a>
        </div>
        <p class="font-light mb-1 text-sm italic">пример меню</p>

        <div class="w-full flex flex-col items-center xl:flex-row gap-10 text-gray-700">
          <div class="flex flex-col md:flex-row shadow-lg md:h-90 md:w-2/3 bg-brand-blue-light">
            <img src="/img/daily/chech.jpg"
                 alt="Меню Чехия"
                 class="object-cover object-center rounded-t md:rounded-l md:rounded-t-none md:h-90"
            >

            <div class="flex flex-col justify-center rounded-r p-4">
              <h3 class="mb-4">Чехия</h3>

              <div class="mb-4">
                <h4 class="font-bold text-xs uppercase">Завтрак</h4>
                <span class="text-sm">Рисовая каша с филированным апельсином</span>
              </div>

              <div class="mb-4">
                <h4 class="font-bold text-xs uppercase">Обед</h4>
                <p class="text-sm">Курица с тмином, барбарисом и сырный соус</p>
                <span class="text-sm"><b class="font-medium">Гарнир:</b> перловка</span>
              </div>

              <div>
                <h4 class="font-bold text-xs uppercase">Ужин</h4>
                <p class="text-sm">Свичкова на сметане</p>
                <p class="text-sm"><b class="font-medium">Гарнир:</b> картофельные дольки</p>
                <p class="text-sm"><b class="font-medium">Салат:</b> бейби морковь, брокколи,цветная капуста на пару</p>
              </div>
            </div>
          </div>

          <div class="flex flex-col md:flex-row shadow-lg md:h-90 md:w-2/3 bg-lime-100">
            <img src="/img/daily/rum.jpg"
                 alt="Меню Румыния"
                 class="object-cover object-center rounded-t md:rounded-l md:rounded-t-none md:h-90"
            >

            <div class="flex flex-col justify-center p-4 rounded-r">
              <h3 class="mb-4">Румыния</h3>
              <div class="mb-4">
                <h4 class="font-bold text-xs uppercase">Завтрак</h4>
                <span class="text-sm text-gray-700">Мультизлаковая каша с малиновым вареньем и кокосовой стружкой</span>
              </div>

              <div class="mb-4">
                <h4 class="font-bold text-xs uppercase">Обед</h4>
                <p class="text-sm">Курица по-румынски</p>
                <span class="text-sm"><b class="font-medium">Гарнир:</b> горохово-картофельное пюре</span>
              </div>

              <div>
                <h4 class="font-bold text-xs uppercase">Ужин</h4>
                <p class="text-sm">Микс рыбы с пряными травами (кета,судак)</p>
                <p class="text-sm"><b class="font-medium">Гарнир:</b> маш с кукурузой</p>
                <p class="text-sm"><b class="font-medium">Салат:</b> запеченная тыква с цукини</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <daily-modal :isVisible = "isVisible"
                 @close="closeModal"
                 @showSuccess="showSuccess = true"
                 @showFail="showFail = true">
    </daily-modal>
  </div>
</template>

<script>
import DailyModal from "./DailyModal.vue";

export default {
  name: "Daily",
  components: {DailyModal},
  data: () => ({
    isVisible: false,
    showSuccess: false,
    showFail: false,
  }),
  methods: {
    closeModal(){
      this.isVisible = false
      this.showSuccess = false
      this.showFail = false
    },
  }
}
</script>
