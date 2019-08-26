    function initialState() {
        return {
            item: null,

            loading: false,
            payFlag: false,
        }
    }

    const getters = {
        item: state => state.item,
        loading: state => state.loading,
        payFlag: state => state.payFlag,
    }

    const actions = {
        fetchData({ commit, state, dispatch }, id) {
            commit('setLoading', true)
            return new Promise((resolve, reject) => {
                axios.get('/api/v2/campaigns/' + id + '/invoice')
                    .then(response => {
                        commit('setItem', response.data.data)
                        resolve()
                    })
                    .catch(error => {
                        let message = error.response.data.message || error.message
                        let errors = error.response.data.errors

                        reject(message)
                    })
                    .finally(() => {
                        commit('setLoading', false)
                    })
            });
        },
        stripePayment({ commit, state }, stripeToken) {

            commit('setPayFlag', true)
            return new Promise((resolve, reject) => {
                let params = new FormData();
                params.set('invoice_id', state.item.invoice.id)
                params.set('stripeToken', JSON.stringify(stripeToken))


                axios.post('/api/v2/campaigns/stripePay', params)
                    .then(response => {
                        console.log(response)

                        resolve(response)
                    })
                    .catch(error => {
                        let message = error.response.data.message || error.message
                        let errors = error.response.data.errors

                        reject(message)
                    })
                    .finally(() => {
                        commit('setPayFlag', false)
                    })
            })

        },


        resetState({ commit }) {
            commit('resetState')
        },
        setPayFlag({ commit }, flag) {
            commit('setPayFlag', flag);
        }
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
        },
        setPayFlag(state, flag) {
            state.payFlag = flag;
        }
    }

    export default {
        namespaced: true,
        state: initialState,
        getters,
        actions,
        mutations
    }