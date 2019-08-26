function initialState() {
    return {
        item: {
            id: null,
            name: null,
            code: null,
            initial_price: null,
            extra_price: null,
            currency_id: null,
            currency: null,
            map_file: null,
            map_file_url: null,
            activated: null,
        },
        currencies: [],
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    currencies: state => state.currencies

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



            axios.post('/api/v1/countries', params)
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



            axios.post('/api/v1/countries/' + state.item.id, params)
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
        return new Promise((resolve, reject) => {
            axios.get('/api/v1/countries/' + id)
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        });
    },
    fetchCurrencyData({ commit, state }) {
        commit('setLoading', true)
        return new Promise((resolve, reject) => {
            axios.get('/api/v1/currencies')
                .then(response => {
                    commit('setCurrencies', response.data.data)
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
    setInitialPrice({ commit }, value) {
        commit('setInitialPrice', value);
    },
    setExtraPrice({ commit }, value) {
        commit('setExtraPrice', value);
    },
    setCurrency({ commit }, value) {
        commit('setCurrency', value);
    },
    setMapFile({ commit, state }, value) {
        commit('setMapFile', value)
    },
    setActivateFlag({ commit }, value) {
        commit('setActivateFlag', value);
    },
    setCountryInfo({ commit }, value) {
        commit('setCountryInfo', value);
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setCurrencies(state, value) {
        state.currencies = value;
    },
    setCurrency(state, value) {
        state.item.currency_id = value;
    },
    setCountryInfo(state, info) {
        if (info == null) {
            state.item.name = state.item.code = null;
        } else {
            state.item.name = info.name;
            state.item.code = info.code;
        }
    },
    setActivateFlag(state, value) {
        state.item.activated = value;
    },
    setExtraPrice(state, value) {
        state.item.extra_price = value;
    },
    setInitialPrice(state, value) {
        state.item.initial_price = value;
    },

    setMapFile(state, value) {
        state.item.map_file = value;
        if (value == null) {
            state.item.map_file_url = null;
        } else {
            state.item.map_file_url = value.name;
        }
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