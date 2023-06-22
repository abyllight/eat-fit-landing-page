<template>
    <div v-if="$store.state.ad === 1" class="h-screen w-full fixed top-0 left-0 z-30 bg-overlay flex items-center justify-center px-3 py-2">
        <div class="w-full max-w-md rounded shadow-xl relative">
            <div>
                <img src="/img/banner.png" class="mx-auto">
            </div>

            <img @click="closeAd" src="/img/icons/close.svg" class="w-10 cursor-pointer absolute z-50 top-0 -right-10"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "Ad",
    methods: {
        closeAd() {
            this.$store.dispatch('setAd', 2)
        }
    }
}
</script>
