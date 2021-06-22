let cart = window.localStorage.getItem('cart');
let totalCount = window.localStorage.getItem('totalCount');

let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        totalCount: totalCount ?? 0,
        total: 0
    },
    getters: {
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
        DECREMENT_TOTAL_COUNT(state) {
            state.totalCount = parseInt(state.totalCount) - 1
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
            state.cartCount = 0
            this.commit('saveCart');
        },
        RESET_TOTAL_COUNT(state) {
            state.totalCount = 0
        },
        SAVE_CART(state){
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('totalCount', state.totalCount);
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
        }
    }
};

export default store
