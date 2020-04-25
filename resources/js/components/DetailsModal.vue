<template>
    <div v-show="isDetailsVisible" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="max-w-sm bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 py-6 sm:p-6">
                <h3 class="text-center text-2xl md:text-3xl leading-6 font-black text-gray-800 mb-6">
                    Рацион "{{ data.title }}"
                </h3>
                <p class="font-semibold text-gray-800 mb-3 leading-tight md:text-lg">Этот рацион предназначен для:</p>

                <p v-for="aim in data.aims" :key="aim.id" class="leading-tight text-gray-700 mb-2">- {{ aim.description }}</p>

                <p class="text-sm italic leading-tight text-red-500 mb-3">{{ data.extra }}</p>

                <div class="flex items-center justify-between lg:justify-start">
                    <div class="lg:mr-10">
                        <p class="font-semibold text-gray-800 -mb-1">Белки</p>
                        <p class="text-gray-700 font-semibold text-sm">({{ data.protein ? data.protein.weight : '' }}г)</p>
                        <span class="font-bold text-brand-green text-3xl">{{ data.protein ? data.protein.percentage : '' }}%</span>
                    </div>
                    <div class="lg:mr-10">
                        <p class="font-semibold text-gray-800 -mb-1">Жиры</p>
                        <p class="text-gray-700 font-semibold text-sm">({{ data.fat ? data.fat.weight : '' }}г)</p>
                        <span class="font-bold text-brand-green text-3xl">{{ data.fat ? data.fat.percentage : '' }}%</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800 -mb-1">Углеводы</p>
                        <p class="text-gray-700 font-semibold text-sm">({{ data.carbohydrate ? data.carbohydrate.weight : '' }}г)</p>
                        <span class="font-bold text-brand-green text-3xl">{{ data.carbohydrate ? data.carbohydrate.percentage : '' }}%</span>
                    </div>
                </div>
            </div>

            <button @click="$emit('close')" type="button" class="absolute top-0 right-0 mr-4 mt-2 block text-gray-500 hover:text-gray-400 focus:text-blue-500 focus:outline-none">
                <svg class="h-8 w-8 fill-current" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'detailsModal',
    props: ['data', 'isDetailsVisible'],
    data(){
        return{
            accent: 'text-gray-900'
        }
    }
}
</script>
