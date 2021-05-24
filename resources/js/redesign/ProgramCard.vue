<template>
    <div class="rounded-lg shadow-lg overflow-hidden">
        <div class="flex bg-gray-200">
            <img class="w-24 md:w-32 flex-shrink-0 object-cover object-center" :src="program.imageUrl">
            <div class="pr-4 py-4 w-full relative">
                <div class="flex items-center justify-between -mb-3">
                    <h3 class="text-3xl md:text-4xl font-black text-gray-800">{{ program.title }}</h3>
                    <p class="text-gray-600 font-light text-xl">≈ {{ program.kcal }} ккал</p>
                </div>
                <p class="text-gray-800 text-xl mb-3">от {{ program.price }} тг.</p>
                <p class="text-gray-700 font-semibold leading-tight mb-5">{{ program.shortDescription }}</p>
                <button @click="showModal()" class="px-3 md:px-5 py-2 rounded-lg shadow bg-green-600 hover:bg-green-500 text-xs text-white uppercase font-semibold">
                    заказать
                </button>
            </div>
        </div>
        <div v-show="program.instagram" class="bg-white px-2 sm:px-4 py-1 flex items-center">
            <a :href="program.instagramLink" target="_blank">
                <img src="/img/instagram.svg" class="hidden sm:block w-5 h-5 mr-2" :alt="program.instagram">
            </a>
            <div>
                <p class="text-xs leading-tight -mb-1 mt-1">{{ program.bio }}</p>
                <a :href="program.instagramLink" target="_blank" class="text-xs leading-tight text-gray-500">{{ program.instagram }}</a>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    props: ['program'],
    methods: {
        showModal(){
            this.$emit('show-modal', true)
        }
    }
}
</script>

<style>

</style>
