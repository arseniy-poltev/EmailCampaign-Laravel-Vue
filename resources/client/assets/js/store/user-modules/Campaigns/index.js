function initialState() {
    return {
        allData: [],
        rows: [],
        relationships: {

        },
        summary: [],
        type: 'all',
        query: {},
        loading: false
    }
}
const typeOf = o => Object.prototype.toString.call(o).slice(8, -1).toLowerCase()
const getters = {

    data: state => {
        let rows = state.rows;

        if (state.query.sort) {
            rows = _.orderBy(state.rows, state.query.sort, state.query.order)
        }
        ['name', 'status'].forEach(field => {
            switch (typeOf(state.query[field])) {
                case 'array':
                    rows = rows.filter(row => state.query[field].includes(row[field]))
                    break
                case 'string':
                    rows = rows.filter(row => row[field].toLowerCase().includes(state.query[field].toLowerCase()))
                    break
                default:
                    // nothing to do
                    break
            }
        })

        return rows.slice(state.query.offset, state.query.offset + state.query.limit)
    },
    total: state => state.rows.length,
    loading: state => state.loading,
    relationships: state => state.relationships,
    type: state => state.type,
    summary: state => state.summary
}

const actions = {
    fetchData({ commit, state }, type) {
        commit('setLoading', true)
        commit('setType', type);
        axios.get('/api/v2/campaigns?type=' + type)
            .then(response => {
                commit('setAll', response.data.data)
            })
            .catch(error => {
                message = error.response.data.message || error.message
                commit('setError', message)
                console.log(message)
            })
            .finally(() => {
                commit('setLoading', false)
            })
    },
    fetchSummary({ commit }) {
        axios.get('/api/v2/campaignsSummary')
            .then(response => {
                commit('setSummary', response.data.data)
            })
            .catch(error => {
                message = error.response.data.message || error.message
                commit('setError', message)
                console.log(message)
            })
            .finally(() => {
                //commit('setLoading', false)
            })
    },

    destroyData({ commit, state }, id) {
        axios.delete('/api/v2/campaigns/' + id)
            .then(response => {
                commit('setAll', state.rows.filter((item) => {
                    return item.id != id
                }))
            })
            .catch(error => {
                message = error.response.data.message || error.message
                commit('setError', message)
                console.log(message)
            })
    },
    updateData({ commit }, item) {
        console.log(item);
        commit('updateData', item);
    },
    setQuery({ commit }, value) {
        commit('setQuery', purify(value))
    },
    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {
    setAll(state, items) {
        state.rows = items
    },
    setSummary(state, value) {
        state.summary = value;
    },
    updateData(state, item) {
        var flag = false;
        for (var i in state.rows) {
            if (state.rows[i].id == item.id) {
                state.rows[i].status = item.status;
                flag = true;
                break;
            }
        }
        if (!flag) {
            //insert a new row
            state.rows.unshift(item);
        }
    },
    setType(state, value) {
        state.type = value
    },
    setLoading(state, loading) {
        state.loading = loading
    },
    setQuery(state, query) {
        state.query = query
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