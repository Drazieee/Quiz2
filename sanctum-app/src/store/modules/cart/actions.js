import Vuex from 'vuex'
export const store = new Vuex.Store({
    actions: {
        checkoutItem({ commit }) {
            commit('checkoutItem');
        }
    }
})