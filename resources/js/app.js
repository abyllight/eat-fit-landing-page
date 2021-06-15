import Vue from "vue";

window.Vue   = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vuelidate from "vuelidate/src";
import Vuex from 'vuex';
import store from './store';

Vue.use(Vuelidate);
Vue.use(Vuex);

Vue.component('navbar', require('./redesign/Navbar.vue').default);
Vue.component('program', require('./redesign/Program.vue').default);
Vue.component('calculator', require('./redesign/CalculatorModal.vue').default);
Vue.component('result', require('./redesign/ResultModal.vue').default);
Vue.component('order-modal', require('./redesign/OrderModal.vue').default);
Vue.component('details-modal', require('./redesign/DetailsModal.vue').default);
Vue.component('success-modal', require('./redesign/SuccessModal.vue').default);
Vue.component('fail-modal', require('./redesign/FailModal.vue').default);
Vue.component('trial', require('./redesign/TrialSection.vue').default);
Vue.component('instagram', require('./redesign/Instagram.vue').default);
Vue.component('faq', require('./redesign/Faq.vue').default);
Vue.component('cart', require('./redesign/Cart.vue').default);
Vue.component('detox', require('./redesign/Detox.vue').default);
Vue.component('detox-modal', require('./redesign/DetoxModal.vue').default);
Vue.component('detox-details-modal', require('./redesign/DetoxDetailsModal.vue').default);
Vue.component('sample-menu', require('./redesign/SampleMenu.vue').default);
Vue.component('team', require('./redesign/TeamSection.vue').default);
