<template>
    <div v-show="showSuccess" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full sm:w-1/2 lg:max-w-md bg-brand-green rounded overflow-hidden shadow-xl relative">
            <div class="bg-brand-green px-10">
                <div class="mt-8 mb-6 text-center">
                    <img src="/img/icons/check.svg" class="w-10 h-10 md:w-12 md:h-12 mx-auto mb-6">
                    <h3 class="text-2xl leading-6 text-gray-100 font-light mb-10">
                        Ваша заявка принята
                    </h3>
                    <!--<p class="mb-8 text-gray-100 text-base">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Consequatur amet labor
                    </p>-->
                    <button @click="$emit('close')" class="bg-white px-3 py-2 rounded text-xs uppercase font-semibold text-gray-700 shadow hover:bg-gray-700 hover:text-white focus:outline-none">Вернуться назад</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SuccessModal",
        props: ['showSuccess']
    }
</script>

<style scoped>

</style>
