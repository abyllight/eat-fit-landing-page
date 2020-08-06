<template>
    <div v-show="show" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full md:max-w-md bg-white rounded overflow-hidden shadow-xl relative">
            <div class="bg-white px-3 py-6 sm:p-6">
                <h3 class="text-2xl leading-6 font-bold text-gray-800 mb-2">
                    {{ data.title }}
                </h3>

                <p v-for="aim in data.aims" :key="aim.id" class="leading-tight text-gray-700 mb-2">- {{ aim.description }}</p>
                <div v-for="(item, index) in data.items" :key="item.id" class="mb-2">
                    <p class="font-semibold text-green-800">{{index+1}}. {{ item.title }}</p>
                    <p class="leading-tight text-gray-600 text-sm">[{{ item.composition }}]</p>
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
    name: 'DetoxDetailsModal',
    props: ['data', 'show'],
    data(){
        return{
            accent: 'text-gray-900'
        }
    }
}
</script>
