let cart = window.localStorage.getItem('cart');
let cartCount = window.localStorage.getItem('cartCount');

let store = {
    state: {
        cart: cart ? JSON.parse(cart) : [],
        cartCount: cartCount ? parseInt(cartCount) : 0,
        total: 0
    },
    mutations: {
        addToCart(state, item){
            let found = state.cart.find(product => product.id === item.id)

            if(found){

            }else {
                state.cart.push(item)
                state.cartCount++
            }
            this.commit('saveCart');
        },
        removeFromCart(state, item) {
            let index = state.cart.indexOf(item);

            if (index > -1) {
                let product = state.cart[index];
                state.cartCount -= 1;

                state.cart.splice(index, 1);
                this.commit('saveCart');
            }
        },
        decrement(state, item){
            let found = state.cart.find(product => product.id === item.id)
            found.q -= 1
            if (found.q === 1){
                found.total = found.price
            }else if (found.q === 2){
                found.total = (found.price - 400) * found.q
            }else {
                found.total = found.total - (found.price - 800)
            }
            this.commit('saveCart');
        },
        increment(state, item){
            let found = state.cart.find(product => product.id === item.id)
            found.q += 1
            if (found.q === 1){
                found.total = found.price
            }else if (found.q === 2){
                found.total = (found.price - 400) * found.q
            }else {
                found.total = (found.price - 800) * found.q
            }
            this.commit('saveCart');
        },
        clearCart(state){
            state.cart = []
            state.cartCount = 0
            this.commit('saveCart');
        },
        saveCart(state){
            window.localStorage.setItem('cart', JSON.stringify(state.cart));
            window.localStorage.setItem('cartCount', state.cartCount);
        }
    }
};

export default store
