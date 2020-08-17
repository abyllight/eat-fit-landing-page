window.Vue = require('vue');
window.axios = require('axios');
import Vuelidate from "vuelidate/src";
import Vuex from 'vuex';
import store from './store';
import vueScrollto from 'vue-scrollto';

Vue.use(Vuelidate);
Vue.use(Vuex);
Vue.use(vueScrollto);

Vue.component('app', require('./components/App.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('footer-section', require('./components/FooterSection.vue').default);
Vue.component('hero', require('./components/Hero.vue').default);
Vue.component('about', require('./components/About.vue').default);
Vue.component('how-it-works', require('./components/HowItWorks.vue').default);
Vue.component('program', require('./components/Program.vue').default);
Vue.component('program-card', require('./components/ProgramCard.vue').default);
Vue.component('order-modal', require('./components/OrderModal.vue').default);
Vue.component('details-modal', require('./components/DetailsModal.vue').default);
Vue.component('success-modal', require('./components/SuccessModal.vue').default);
Vue.component('fail-modal', require('./components/FailModal.vue').default);
Vue.component('instagram', require('./components/Instagram.vue').default);
Vue.component('faq', require('./components/Faq.vue').default);
Vue.component('contact', require('./components/Contact.vue').default);
Vue.component('product-modal', require('./components/ProductModal.vue').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('detox', require('./components/Detox.vue').default);
Vue.component('detox-modal', require('./components/DetoxModal.vue').default);
Vue.component('detox-details-modal', require('./components/DetoxDetailsModal.vue').default);
Vue.component('detox-section', require('./components/DetoxSection.vue').default);
Vue.component('products-list', require('./components/ProductsList.vue').default);


const app = new Vue({
    el: '#app',
    store: new Vuex.Store(store)
});
