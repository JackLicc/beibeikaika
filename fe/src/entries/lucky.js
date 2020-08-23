import Vue from 'vue'
import Lucky from '@/components/lucky/Index.vue'

const node = document.querySelector('#lucky')
const number = node.dataset.lucky

new Vue({
    render: function(createElement) {
        return createElement(Lucky, {
            props: {
                num: number
            }
      })
    }
}).$mount('#lucky');