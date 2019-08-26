function initialState() {
    return {
        item: {
            id: null,
            name: null,
            sender_name: null,
            message: null,
            comment: null,
            reason: null,
            user: null,
            status: null,
            created_at: null,
            updated_at: null,
        },
        saveAsDraft: true,
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    loading: state => state.loading,
    saveAsDraft: state => state.saveAsDraft
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

            params.set('isDraft', flag ? 1 : 0);

            axios.post('/api/v1/campaigns', params)
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
    updateData({ commit, state, dispatch }, flag) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')

            // for (let fieldName in state.item) {
            //     let fieldValue = state.item[fieldName];
            //     if (typeof fieldValue !== 'object') {
            //         params.set(fieldName, fieldValue);
            //     } else {
            //         if (fieldValue && typeof fieldValue[0] !== 'object') {
            //             params.set(fieldName, fieldValue);
            //         } else {
            //             for (let index in fieldValue) {
            //                 params.set(fieldName + '[' + index + ']', fieldValue[index]);
            //             }
            //         }
            //     }
            // }

            //params.set('isDraft', flag ? 1 : 0);
            params.set('status', flag ? 1 : 0);
            if (state.item.reason) {
                params.set('reason', state.item.reason);
            }

            axios.post('/api/v1/campaigns/' + state.item.id, params)
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
        axios.get('/api/v1/campaigns/' + id)
            .then(response => {
                commit('setItem', response.data.data)
            })
            .finally(() => {
                commit('setLoading', false)
            })

    },
    setName({ commit }, value) {
        commit('setName', value);
    },
    setSenderName({ commit }, value) {
        commit('setSenderName', value);
    },
    setMessage({ commit }, value) {
        commit('setMessage', value);
    },
    setComment({ commit }, value) {
        commit('setComment', value);
    },
    setReason({ commit }, value) {
        commit('setReason', value);
    },


    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setName(state, value) {
        state.item.name = value;
    },
    setSenderName(state, value) {
        state.item.sender_name = value;
    },
    setMessage(state, value) {
        state.item.message = value;
    },
    setComment(state, value) {
        state.item.comment = value;
    },
    setReason(state, value) {
        state.item.reason = value;
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