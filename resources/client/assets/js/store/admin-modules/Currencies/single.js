function initialState() {
    return {
        item: {
            id: null,
            name: null,
            code: null,
            symbol: null,
        },


        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,


}

const actions = {
    storeData({ commit, state, dispatch }) {

        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }



            axios.post('/api/v1/currencies', params)
                .then(response => {
                    commit('resetState')
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

                    dispatch(
                        'Alert/setAlert', { message: message, errors: errors, color: 'danger' }, { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    updateData({ commit, state, dispatch }) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')

            for (let fieldName in state.item) {
                let fieldValue = state.item[fieldName];
                if (typeof fieldValue !== 'object') {
                    params.set(fieldName, fieldValue);
                } else {
                    if (fieldValue && typeof fieldValue[0] !== 'object') {
                        params.set(fieldName, fieldValue);
                    } else {
                        for (let index in fieldValue) {
                            params.set(fieldName + '[' + index + ']', fieldValue[index]);
                        }
                    }
                }
            }



            axios.post('/api/v1/currencies/' + state.item.id, params)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors

                    dispatch(
                        'Alert/setAlert', { message: message, errors: errors, color: 'danger' }, { root: true })

                    reject(error)
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        })
    },
    fetchData({ commit, dispatch }, id) {
        commit('setLoading', true)
        axios.get('/api/v1/currencies/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
            .finally(() => {
                commit('setLoading', false)
            })

    },


    resetState({ commit }) {
        commit('resetState')
    },
    setName({ commit }, value) {
        commit('setName', value);
    },
    setCode({ commit }, value) {
        commit('setCode', value);
    },
    setSymbol({ commit }, value) {
        commit('setSymbol', value);
    },

}

const mutations = {
    setItem(state, item) {
        state.item = item
    },

    setName(state, value) {
        state.item.name = value;
    },
    setCode(state, value) {
        state.item.code = value;
    },
    setSymbol(state, value) {
        state.item.symbol = value;
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