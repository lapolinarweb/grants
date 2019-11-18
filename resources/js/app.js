import GrantsIndex from './components/grants/index';
import VueGtm from 'vue-gtm';
import './vendors/vue-sweetalert2'
import './vendors/vee-validate'

Vue.use(VueGtm, {
    id: 'GTM-WQK7NS3',
    enabled: true,
    debug: true,
    loadScript: true
});
new Vue({
    el: '#app',
    components: {
        GrantsIndex
    },
});
