function initialState() {
    return {
        item: {
            id: null,
            name: null,
            postal_code: null,
            country_id: null,
            country_code: null,
            country_name: null,
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



            axios.post('/api/v1/cities', params)
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



            axios.post('/api/v1/cities/' + state.item.id, params)
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
        axios.get('/api/v1/cities/' + id)
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
    setPostalCode({ commit }, value) {
        commit('setPostalCode', value);
    },
    setCountryId({ commit }, value) {
        commit('setCountryId', value);
    }

}

const mutations = {
    setItem(state, item) {
        state.item = item
    },

    setName(state, value) {
        state.item.name = value;
    },
    setPostalCode(state, value) {
        state.item.postal_code = value;
    },

    setLoading(state, loading) {
        state.loading = loading
    },
    resetState(state) {
        state = Object.assign(state, initialState())
    },
    setCountryId(state, value) {
        state.item.country_id = value;
    }
}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}