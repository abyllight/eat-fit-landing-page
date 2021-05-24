import Vue from "vue";

window.Vue   = require('vue');
window.axios = require('axios');
import Vuelidate from "vuelidate/src";
import Vuex from 'vuex';
import store from './store';
import progs from './data';

Vue.use(Vuelidate);
Vue.use(Vuex);

/*Vue.component('app', require('./components/App.vue').default);
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
Vue.component('sample-menu', require('./components/SampleMenu.vue').default);
Vue.component('quiz', require('./components/Quiz.vue').default);
Vue.component('team', require('./components/TeamSection.vue').default);*/

Vue.component('navbar', require('./redesign/Navbar.vue').default);
Vue.component('hero', require('./redesign/Hero.vue').default);
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

new Vue({
    el: '#navbar'
});

new Vue({
    el: '#programs'
});

new Vue({
    el: '#sample'
});

new Vue({
    el: '#trial'
});

new Vue({
    el: '#reviews'
});

new Vue({
    el: '#faq'
});

new Vue({
    el: '#contacts'
});

new Vue({
    el: '#detox'
});

new Vue({
    el: '#team'
});
