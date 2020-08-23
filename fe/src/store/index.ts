import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: window.sessionStorage.getItem('token'),
    account: window.sessionStorage.getItem('account')
  },
  mutations: {
    LOGIN: (state, data) => {
      state.token = data
      window.sessionStorage.setItem('token', data)
    },
    LOGOUT: (state) => {
      state.token = null
      state.account = null
      window.sessionStorage.removeItem('token')
      window.sessionStorage.removeItem('account')
    },
    ACCOUNT: (state, data) => {
      state.account = data
      window.sessionStorage.setItem('account', data)
    }
  },
  actions: {
    UserLogin ({ commit }, data) {
      commit('LOGIN', data)
    },
    UserLogout ({ commit }) {
      commit('LOGOUT')
    },
    UserAccount ({ commit }, data) {
      commit('ACCOUNT', data)
    }
  },
  getters: {
    token: state => state.token,
    account: state => state.account
  }
})
