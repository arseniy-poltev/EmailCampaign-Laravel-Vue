function initialState() {
    return {
        unReadMsgCount: 0
    }
}

const getters = {
    unReadMsgCount: state => state.unReadMsgCount
}

const actions = {
    updateData({ commit }, value) {
        commit('setData', value);
    },

    resetState({ commit }) {
        commit('resetState')
    }
}

const mutations = {

    resetState(state) {
        state = Object.assign(state, initialState())
    },
    setData(state, value) {
        state.unReadMsgCount = value;
    }

}

export default {
    namespaced: true,
    state: initialState,
    getters,
    actions,
    mutations
}