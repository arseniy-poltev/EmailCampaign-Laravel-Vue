function initialState() {
    return {
        item: {
            id: null,
            name: null,
            email: null,
            phone: null,
            country: null,
            address: null,
            vat_number: null,
        },
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
}

const actions = {
    storeData({ commit, state, dispatch }, flag) {

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

            axios.post('/change-profile', params)
                .then(response => {
                    //commit('resetState')
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

    fetchData({ commit, state, dispatch }) {
        commit('setLoading', true)
        return new Promise((resolve, reject) => {
            axios.get('/get-profile')
                .then(response => {
                    commit('setItem', response.data.data)
                    resolve()
                })
                .finally(() => {
                    commit('setLoading', false)
                })
        });
    },

    setName({ commit }, value) {
        commit('setName', value);
    },
    setEmail({ commit }, value) {
        commit('setEmail', value);
    },
    setPhone({ commit }, value) {
        commit('setPhone', value);
    },
    setCountry({ commit }, value) {
        commit('setCountry', value);
    },
    setAddress({ commit }, value) {
        commit('setAddress', value);
    },
    setVATNumber({ commit }, value) {
        commit('setVATNumber', value);
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setName(state, value) {
        state.item.name = value;
    },
    setEmail(state, value) {
        state.item.email = value;
    },
    setPhone(state, value) {
        state.item.phone = value;
    },
    setCountry(state, value) {
        state.item.country = value;
    },
    setAddress(state, value) {
        state.item.address = value;
    },
    setVATNumber(state, value) {
        state.item.vat_number = value;
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