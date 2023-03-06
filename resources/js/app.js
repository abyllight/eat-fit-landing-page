window.Vue   = require('vue').default;
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

import Vuelidate from "vuelidate/src";
import Vuex from 'vuex';
import store from './store';

Vue.use(Vuelidate);
Vue.use(Vuex);

Vue.component('navbar', require('./redesign/Navbar.vue').default);
Vue.component('ad', require('./redesign/Ad.vue').default);
Vue.component('program', require('./redesign/Program.vue').default);
Vue.component('calculator', require('./redesign/CalculatorModal.vue').default)
Vue.component('trial', require('./redesign/TrialSection.vue').default);
Vue.component('instagram', require('./redesign/Instagram.vue').default);
Vue.component('faq', require('./redesign/Faq.vue').default);
Vue.component('detox', require('./redesign/Detox.vue').default);
Vue.component('sample-menu', require('./redesign/SampleMenu.vue').default);
Vue.component('team', require('./redesign/TeamSection.vue').default);
Vue.component('product-list', require('./redesign/ProductsList.vue').default);
Vue.component('cart', require('./redesign/Cart.vue').default);
Vue.component('basket', require('./redesign/Basket.vue').default);
Vue.component('checkout', require('./redesign/Checkout.vue').default);

new Vue({
    el: '#navbar',
    store: new Vuex.Store(store)
});

new Vue({
    el: '#ad',
    store: new Vuex.Store(store)
});

new Vue({
    el: '#cart',
    store: new Vuex.Store(store)
});
