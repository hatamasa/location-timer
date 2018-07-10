import Vue from 'vue';
import VueRouter from 'vue-router';

require('./bootstrap');

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('navbar', require('./components/Layouts/Navbar.vue'));

const routes = [
    { path: '/', components: require('./components/Test/Index.vue')},
    { path: '/hello', components: require('./components/Test/Hello.vue')}
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    router
}).$mount('#app');
