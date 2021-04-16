

require('./bootstrap');
import Vue from 'vue';
import Swal from 'sweetalert2'
import VueRouter from 'vue-router';
import routes from './routes';
import { Form, HasError, AlertError } from 'vform'

Vue.use(VueRouter)

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Vue = require('vue');
window.swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,  
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  
  


window.toast = toast;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('staff-component', require('./components/StaffComponent.vue').default);
Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);
Vue.component('seed-component', require('./components/SeedComponent.vue').default);
Vue.component('seedbed-component', require('./components/SeedbedComponent.vue').default);
Vue.component('plot-component', require('./components/PlotComponent.vue').default);
Vue.component('fertilizer-component', require('./components/FertilizerComponent.vue').default);
Vue.component('pesticide-component', require('./components/PesticideComponent.vue').default);
Vue.component('task-component', require('./components/TaskComponent.vue').default);
Vue.component('product-component', require('./components/ProductInventoryComponent.vue').default);
Vue.component('main-dashboard', require('./components/MainDashboardComponent.vue').default);
Vue.component('seed-sowing', require('./components/Dasboard_child/SeedSowing.vue').default);
Vue.component('seed-plot-sowing', require('./components/Dasboard_child/PlotMonitoring.vue').default);
const app = new Vue({
    el: '#app',
});
