let cart = window.localStorage.getItem('cart');
let cutlery = window.localStorage.getItem('cutlery');
let totalCount = window.localStorage.getItem('totalCount');
let user = window.localStorage.getItem('go_user');
let city = window.localStorage.getItem('go_city');
let ad = window.localStorage.getItem('e_ad');
if (!ad) {
    ad = 0
}

let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cutlery: cutlery ? JSON.parse(cutlery) : {
            id: 0,
            title: 'Приборы',
            image: '/products/tools.jpg',
            price: 50,
            q: 1,
            total: 50
        },
        user: user ? JSON.parse(user) : {},
        totalCount: totalCount ?? 0,
        total: 0,
        wholesale: 0,
        city: city ? JSON.parse(city) : 1,
        ad: ad
    },
    getters: {
        getTotal: state => {
            return state.cart.reduce((sum, item) => sum + (item.q * item.price), 0)
        },
        getWholesale: state => {
            return state.cart.reduce((sum, item) => sum + (item.q * item.wholesale), 0)
        },
        getTotalCount: state => {
            return state.cart.reduce((sum, item) => sum + item.q, 0)
        },
        getItemTotal: state => id => {
            let found = state.cart.find(product => product.id === id)
            return found ? found.total : 0
        },
        getItemCount: state => id => {
            let found = state.cart.find(product => product.id === id)
            return found ? found.q : 1
        },
        hasItem: state => id => {
            return state.cart.some(product => product.id === id)
        },
        getCity: state => {
            return state.city
        },
        getAd: state => {
            return state.ad
        },
    },
    mutations: {
        PUSH(state, item){
            state.cart.push(item)
        },
        INCREMENT_TOTAL_COUNT(state) {
            state.totalCount = parseInt(state.totalCount) + 1
        },
        DECREMENT_TOTAL_COUNT(state, n) {
            if (n) {
                state.totalCount = parseInt(state.totalCount) - n
            }else {
                state.totalCount = parseInt(state.totalCount) - 1
            }
        },
        REMOVE_FROM_CART(state, id) {
            let index = state.cart.findIndex(item => item.id === id);

            if (index > -1) {
                state.cart.splice(index, 1);
            }
        },
        DECREMENT(state, id){
            let found = state.cart.find(product => product.id === id)
            found.q -= 1
            found.total = found.q * found.price
        },
        INCREMENT(state, id){
            let found = state.cart.find(product => product.id === id)
            found.q += 1
            found.total = found.q * found.price
        },
        DECREMENT_CUTLERY(state){
            state.cutlery.q -= 1
            state.cutlery.total = state.cutlery.q * state.cutlery.price
        },
        INCREMENT_CUTLERY(state){
            state.cutlery.q += 1
            state.cutlery.total = state.cutlery.q * state.cutlery.price
        },
        CLEAR_CART(state){
            state.cart = []
            state.totalCount = 0
        },
        RESET_TOTAL_COUNT(state) {
            state.totalCount = 0
        },
        SAVE_CART(state){
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('totalCount', state.totalCount);
        },
        SAVE_CUTLERY(state){
            window.localStorage.setItem('cutlery', JSON.stringify(state.cutlery));
        },
        CLEAR_CUTLERY(state){
            state.cutlery = {
                id: 0,
                title: 'Приборы',
                image: '/products/tools.jpg',
                price: 50,
                q: 1,
                total: 50
            }
        },
        SAVE_USER(state, item) {
            state.user = item
            window.localStorage.setItem('go_user', JSON.stringify(state.user));
        },
        SET_CITY(state, val) {
            state.city = val
            window.localStorage.setItem('go_city', JSON.stringify(state.city));
        },
        SET_AD(state, val) {
            state.ad = val
            window.localStorage.setItem('e_ad', JSON.stringify(state.ad));
        }
    },
    actions: {
        addToCart({state, commit}, item) {
            commit('PUSH', item)
            commit('INCREMENT_TOTAL_COUNT')
            commit('SAVE_CART')
        },
        increment({state, commit}, id) {
            commit('INCREMENT', id)
            commit('INCREMENT_TOTAL_COUNT')
            commit('SAVE_CART')
        },
        decrement({state, commit}, id) {
            let count = this.getters.getItemCount(id)

            if (count > 1) {
                commit('DECREMENT', id)
            }else {
                commit('REMOVE_FROM_CART', id)
            }

            commit('DECREMENT_TOTAL_COUNT')
            commit('SAVE_CART')
        },
        removeFromCart({state, commit}, item) {
            commit('REMOVE_FROM_CART', item.id)
            commit('DECREMENT_TOTAL_COUNT', item.q)
            commit('SAVE_CART')
        },
        clearCart({commit}) {
            commit('CLEAR_CART')
            commit('SAVE_CART')
        },
        saveUser({commit}, item){
            commit('SAVE_USER', item)
        },
        incCutlery({commit}) {
            commit('INCREMENT_CUTLERY')
            commit('SAVE_CUTLERY')
        },
        decCutlery({commit}) {
            if (this.state.cutlery.q < 1) {
                return
            }
            commit('DECREMENT_CUTLERY')
            commit('SAVE_CUTLERY')
        },
        clearCutlery({commit}) {
            commit('CLEAR_CUTLERY')
            commit('SAVE_CUTLERY')
        },
        setCity({commit}, val) {
            commit('SET_CITY', val)
        },
        setAd({commit}, val) {
            commit('SET_AD', val)
        }
    }
};

export default store
