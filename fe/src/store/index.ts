import Vue from 'vue'
import Vuex from 'vuex'
import Cookies from 'js-cookie'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: Cookies.get('token')
  },
  mutations: {
    LOGIN: (state, token) => {
      state.token = token
      Cookies.set('token', token)
    },
    LOGOUT: (state) => {
      state.token = null
      state.account = null
      Cookies.remove('token')
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
