import axios from 'axios'
import store from '@/store'

const baseConfig = {
  headers: {
    timeout: 5000,
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
  }
}

export const ajaxClient = axios.create({
  ...baseConfig,
  baseURL: '/api/'
})

ajaxClient.interceptors.request.use(
  config => {
    if (store.state.token) {
      config.headers.Authorization = `Bearer ${store.state.token}`
    }
    return config
  }
)

ajaxClient.interceptors.response.use(
  response => {
    return response
  },
  error => {
    if (error.response) {
      switch (error.response.status) {
        case 401:
          // router.replace({
          //   path: '/login'
          //   //  query: { redirect: router.currentRoute.fullPath }
          // })
      }
    }
    return Promise.reject(error.response)
  }
)

export default ajaxClient
