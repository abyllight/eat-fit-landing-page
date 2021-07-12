let cart = window.localStorage.getItem('cart');
let totalCount = window.localStorage.getItem('totalCount');
let user = window.localStorage.getItem('go_user');

let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        user: user ? JSON.parse(user) : {},
        totalCount: totalCount ?? 0,
        total: 0,
        wholesale: 0
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
        }
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
        SAVE_USER(state, item) {
            state.user = item
            window.localStorage.setItem('go_user', JSON.stringify(state.user));
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
        }
    }
};

export default store
