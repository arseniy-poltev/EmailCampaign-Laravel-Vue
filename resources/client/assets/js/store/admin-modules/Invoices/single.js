function initialState() {
    return {
        item: null,
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
}

const actions = {

    fetchData({ commit, dispatch }, id) {
        commit('setLoading', true)
        return new Promise((resolve, reject) => {
            axios.get('/api/v1/invoices/' + id)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        });
    },


    resetState({ commit }) {
        commit('resetState')
    },

}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}