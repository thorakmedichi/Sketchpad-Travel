import Vue from 'vue'
import location from './components/location.vue'
import Material from 'vue-material'

Vue.use(Material)

new Vue({
    el: '#location',
    template: '<location/>',
    components: {
        location
    }
});