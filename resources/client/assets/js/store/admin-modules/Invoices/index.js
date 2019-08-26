function initialState() {
    return {
        allData: [],
        rows: [],
        relationships: {

        },
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
}

const actions = {
    fetchData({ commit, state }) {
        commit('setLoading', true)
        axios.get('/api/v1/invoices')
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