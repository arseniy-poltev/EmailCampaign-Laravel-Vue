function initialState() {
    return {
        item: {
            id: null,
            name: null,
            sender_name: null,
            message: null,
            comment: null,
            reason: null,
            status: null,
            filter: null,
            count_customers: null,
            schedule_time: null,
            timezone: null,
            interval_cnt: null,
            interval_time: null,
            created_at: null,
            updated_at: null,

        },
        activated_cont: [],
        mapData: [],

        totalPrice: null,
        saveAsDraft: true,
        loading: false,
    }
}

const getters = {
    item: state => state.item,
    activeCont: state => state.activated_cont,
    mapData: state => state.mapData,

    loading: state => state.loading,
    saveAsDraft: state => state.saveAsDraft,
    flagStart: state => state.flagStart,
    totalPrice: state => state.totalPrice,
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

            axios.post('/api/v2/campaigns', params)
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
    getTargetUsersCnt({ commit, state, dispatch }, param) {
        dispatch('Alert/resetState', null, { root: true })
        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('param', JSON.stringify(param));
            axios.post('/api/v2/campaigns/getTarget', params)
                .then(response => {
                    resolve(response.data)
                })
                .catch(error => {
                    let message = error.response.data.message || error.message
                    let errors = error.response.data.errors
                    dispatch('Alert/setAlert', { message: message, errors: errors, color: 'danger' }, { root: true })
                    reject(error)
                })
                .finally(() => {})
        })
    },
    updateData({ commit, state, dispatch }, flag) {
        commit('setLoading', true)
        dispatch('Alert/resetState', null, { root: true })

        return new Promise((resolve, reject) => {
            let params = new FormData();
            params.set('_method', 'PUT')
            if (state.item.interval_cnt == null) {
                state.item.interval_cnt = 0;
                state.item.interval_time = 0;
            }

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

            axios.post('/api/v2/campaigns/' + state.item.id, params)
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
    getActiveCont({ commit }) {
        commit('setLoading', true);
        return new Promise((resolve, reject) => {

            axios.get('/api/v2/countries/activeCountries')
                .then(response => {
                    commit('setCountryInfo', response.data.data)
                    resolve(response.data.data.extraFilters)
                })
                .finally(() => {
                    commit('setLoading', false)
                })

        });
    },
    fetchData({ commit, state, dispatch }, id) {
        commit('setLoading', true)
        return new Promise((resolve, reject) => {
            if (id == null || id == undefined || id == state.item.id) {

                commit('setLoading', false)
                resolve()

            } else {
                axios.get('/api/v2/campaigns/' + id)
                    .then(response => {
                        commit('setItem', response.data.data)
                        resolve()
                    })
                    .finally(() => {
                        commit('setLoading', false)
                    })
            }
        });
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
    setFilter({ commit }, value) {
        commit('setFilter', value);
    },
    setStartTime({ commit }, value) {
        commit('setStartTime', value);
    },
    setCountCustomer({ commit }, value) {
        commit('setCountCustomer', value);
    },
    setTimezone({ commit }, value) {
        commit('setTimezone', value);
    },
    setTotalPrice({ commit }, value) {
        commit('setTotalPrice', value);
    },
    setIntervalCnt({ commit }, value) {
        commit('setIntervalCnt', value);
    },
    setIntervalTime({ commit }, value) {
        commit('setIntervalTime', value);
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setItem(state, item) {
        state.item = item
    },
    setCountryInfo(state, value) {
        state.activated_cont = value.active;
        state.mapData = value.map;
        // state.extraFilters = value.extraFilters;
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
    setCountCustomer(state, value) {
        state.item.count_customers = value;
    },
    setFilter(state, value) {
        state.item.filter = value;
        console.log(state.item.filter);
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setTimezone(state, value) {
        state.item.timezone = value;
    },
    setStartTime(state, value) {
        state.item.schedule_time = value;
    },
    setTotalPrice(state, value) {
        state.totalPrice = value;
    },
    setIntervalCnt(state, value) {
        if (value == null || value == 0) {
            state.item.interval_cnt = null;
        } else {
            state.item.interval_cnt = Number(value);
        }

    },
    setIntervalTime(state, value) {
        if (value == null || value == 0) {
            state.item.interval_time = null;
        } else {
            state.item.interval_time = Number(value);
        }

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